<?php

namespace App\Http\Services\Checkout;

use App\Enums\User\UserOrderStatusEnum;
use App\Http\Services\Product\Cart\CartService;
use App\Models\User;
use App\Models\User\UserBilling;
use App\Models\User\UserInformation;
use App\Models\User\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CheckoutService
{
    public static function getUser(): User
    {
        $user = Cache::get('user:' . auth()->user()->id);

        if (!$user) {
            $user = User::with('userInformation', 'userInformation.country')->find(auth()->user()->id);
            Cache::put('user:' . auth()->user()->id, $user, 3600);
        }

        return $user;
    }

    public static function store(array $request): void
    {
        UserInformation::updateOrCreate(
            [
                'user_id' => $request['user_id'],
            ],
            [
                'user_id' => $request['user_id'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'company_name' => $request['company_name'],
                'address' => $request['address'],
                'address2' => $request['address2'],
                'city' => $request['city'],
                'country_id' => $request['country'],
                'state_province' => $request['state_province'],
                'zip_postal_code' => $request['zip_postal_code'],
                'phone' => $request['phone'],
            ]
        );

        UserBilling::updateOrCreate(
            [
                'user_id' => $request['user_id']
            ],
            [
                'card_number' => $request['card_number'],
                'card_name' => $request['card_name'],
                'card_expiry' => $request['card_expiry'],
                'card_cvv' => $request['card_cvv'],
            ]
        );

        $cartPrice = CartService::getCartPrice();

        $userOrder = User\UserOrder::create([
            'user_id' => $request['user_id'],
            'order_date' => Carbon::now(),
            'total_amount' => floatval($cartPrice['total']),
            'status' => UserOrderStatusEnum::Pending,
        ]);

        $contentList = $request['content_list'];

        foreach ($contentList as $content) {
            UserOrderItem::create([
                'user_order_id' => $userOrder->id,
                'product_id' => $content['options']['product']['id'],
                'product_sku' => $content['options']['product']['sku'],
                'product_name' => $content['name'],
                'product_price' => $content['price'],
                'quantity' => $content['qty'],
            ]);
        }

        CartService::clearCart();
    }
}
