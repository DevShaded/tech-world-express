<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutSuccessController extends Controller
{
    public function __invoke(Request $request)
    {
        $checkoutSuccess = Session('checkout_success');

        if (!$checkoutSuccess) {
            return redirect()->route('checkout.index');
        }

        $user = UserService::getUser(auth()->user()->id);

        $order = UserService::getUserOrder(auth()->user()->id);

        return Inertia::render('Checkout/Success', [
            'data' => [
                'user' => $user,
                'order' => $order,
            ],
        ]);
    }
}
