<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\CheckoutRequest;
use App\Http\Services\Checkout\CheckoutService;
use App\Http\Services\Product\Cart\CartService;
use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        return Inertia::render('Checkout/Index', [
            'data' => [
                'user' => UserService::getUser(auth()->user()->id),
                'countries' => CartService::getCountries(),
                'cart' => CartService::getCart(),
                'price' => CartService::getCartPrice(),
            ],
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $request = $request->validated();

        CheckoutService::store($request);

        Session::flash('checkout_success', true);

        return redirect()->route('checkout.success');
    }

    public function destroy($id)
    {
    }
}
