<?php

namespace App\Http\Controllers\Product\Cart;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\Cart\CartService;
use App\Http\Services\Product\ProductService;
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
                'cart' => CartService::getCart(),
                'price' => CartService::getCartPrice(),
                'randomProducts' => ProductService::getRandomProducts(),
            ]
        ]);
    }

    public function store(Request $request)
    {
        $product = ProductService::getProductWithoutCollection($request->get('categoryName'), $request->get('slug'));

        CartService::addProductToCart($product[0]);

        return redirect()->back();
    }

    public function destroy(string $rowId): RedirectResponse
    {
        CartService::removeProductFromCart($rowId);

        return redirect()->back();
    }
}
