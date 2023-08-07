<?php

namespace App\Http\Controllers\Checkout;

use App\Enums\User\UserOrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\UserOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutSuccessController extends Controller
{
    public function __invoke(Request $request)
    {
//        $checkoutSuccess = Session('checkout_success');
//
//        if (!$checkoutSuccess) {
//            return redirect()->route('checkout.index');
//        }

        $user = User::with('userInformation', 'userInformation.country', 'userBilling', 'userShipping')
            ->find(auth()->user()->id);

        $order = UserOrder::with('userOrderItems', 'userOrderItems.product', 'userOrderItems.product.information', 'userOrderItems.product.information.category', 'userOrderItems.product.information.productInformationPicture')
            ->where('user_id', auth()->user()->id)
            ->where('status', UserOrderStatusEnum::Pending && UserOrderStatusEnum::Processing)
            ->latest()
            ->first();

        return Inertia::render('Checkout/Success', [
            'data' => [
                'user' => $user,
                'order' => $order,
            ],
        ]);
    }
}
