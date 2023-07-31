<?php

namespace App\Http\Services\Product\Cart;

use App\Models\Product\Product;
use App\Models\User\Country\Country;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;

class CartService
{
    public static function getCart(): object
    {
        return Cart::content();
    }

    public static function getCartPrice(): array
    {
        return [
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'total' => Cart::total(),
        ];
    }

    public static function addProductToCart(Product $product): void
    {
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->information->price,
            'weight' => 0,
            'options' => [
                'product' => $product,
            ]
        ]);
    }

    public static function removeProductFromCart(string $rowId): void
    {
        $cart = Cart::content();

        if (!$cart->contains('rowId', $rowId)) {
            abort(404);
        }

        Cart::remove($rowId);
    }

    public static function clearCart(): void
    {
        Cart::destroy();
    }

    public static function getCountries()
    {
        $countries = Cache::get('countries');

        if (!$countries) {
            $countries = Country::all();
            Cache::put('countries', $countries, 3600);
        }

        return $countries;
    }
}
