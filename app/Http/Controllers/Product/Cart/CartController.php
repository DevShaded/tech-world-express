<?php

namespace App\Http\Controllers\Product\Cart;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Cart/Index', [
            'data' => [
                'cart' => Cart::content(),
                'price' => [
                    'subtotal' => Cart::subtotal(),
                    'tax' => Cart::tax(),
                    'total' => Cart::total(),
                ],
                'randomProducts' => ProductService::getRandomProducts(),
            ]
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = ProductService::getProductWithoutCollection($request->get('categoryName'), $request->get('slug'));

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

        return redirect()->back();
    }

    public function destroy(string $rowId): RedirectResponse
    {
        $cart = Cart::content();

        if (!$cart->contains('rowId', $rowId)) {
            abort(404);
        }

        Cart::remove($rowId);

        return redirect()->back();
    }
}
