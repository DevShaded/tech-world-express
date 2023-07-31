<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\User\UserOrder;

class CheckoutSuccessController extends Controller
{
    public function __invoke()
    {
        return UserOrder::with('userOrderItems')->where('user_id', auth()->id())->get();
    }
}
