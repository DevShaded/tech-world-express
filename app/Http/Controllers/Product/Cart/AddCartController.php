<?php

namespace App\Http\Controllers\Product\Cart;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;

class AddCartController extends Controller
{
    public function __invoke(string $categoryName, string $slug): RedirectResponse
    {
        $product = ProductService::getProductWithoutCollection($categoryName, $slug);

        Cart::add([
            'id' => $product[0]->id,
            'name' => $product[0]->name,
            'qty' => 1,
            'price' => $product[0]->information->price,
            'weight' => 0,
            'options' => [
                'product' => $product[0],
            ]
        ]);

        return redirect()->route('cart.index');
    }
}
