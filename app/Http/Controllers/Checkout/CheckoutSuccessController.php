<?php

namespace App\Http\Controllers\Checkout;

use App\Enums\User\UserOrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User\UserOrder;
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

        $order = UserOrder::with('userOrderItems')
            ->where('user_id', auth()->user()->id)
            ->where('status', UserOrderStatusEnum::Pending && UserOrderStatusEnum::Processing)
            ->latest()
            ->first();

        return Inertia::render('Checkout/Success', [
            'data' => [
                'order' => $order,
            ],
        ]);
    }
}
