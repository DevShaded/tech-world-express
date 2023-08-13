<?php

namespace App\Http\Services\Checkout;

use App\Enums\User\UserOrderStatusEnum;
use App\Http\Services\Product\Cart\CartService;
use App\Http\Services\User\UserService;
use App\Models\User;
use App\Models\User\UserBilling;
use App\Models\User\UserInformation;
use App\Models\User\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CheckoutService
{
    public static function store(array $request): void
    {
        UserService::storeUserInformation($request);
        UserService::storeUserBilling($request);
        UserService::storeUserShipping($request);

        $cartPrice = CartService::getCartPrice();

        UserService::storeUserOrder($request, $cartPrice);

        CartService::clearCart();
    }
}
