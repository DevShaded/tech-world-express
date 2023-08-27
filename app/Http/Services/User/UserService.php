<?php

namespace App\Http\Services\User;

use App\Enums\User\UserOrderStatusEnum;
use App\Models\User;
use App\Models\User\Country\Country;
use App\Models\User\UserBilling;
use App\Models\User\UserInformation;
use App\Models\User\UserOrder;
use App\Models\User\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public static function getUser(string $id): User
    {
        $user = Cache::get('user:' . $id);

        if (!$user) {
            $user = User::with('userInformation', 'userInformation.country', 'userBilling', 'userShipping')
                ->findOrFail($id);

            Cache::put('user:' . auth()->user()->id, $user, 3600);
        }

        return $user;
    }

    public static function getUserInformation(string $id)
    {
        $userInformation = Cache::get('userInformation:' . $id);

        if (!$userInformation) {
            $userInformation = User::with('userInformation', 'userInformation.country')
                ->findOrFail($id);

            Cache::put('userInformation:' . $id, $userInformation, 3600);
        }

        return $userInformation;
    }

    public static function getUserOrder(string $userId): UserOrder
    {
        $order = Cache::get('order:' . $userId);

        if (!$order) {
            $order = UserOrder::with('userOrderItems', 'userOrderItems.product', 'userOrderItems.product.information', 'userOrderItems.product.information.category', 'userOrderItems.product.information.productInformationPicture')
                ->where('user_id', $userId)
                ->where('status', UserOrderStatusEnum::Pending && UserOrderStatusEnum::Processing)
                ->latest()
                ->first();

            Cache::put('order:' . $userId, $order, 3600);
        }

        return $order;
    }

    public static function storeUserInformation(array $request): void
    {

        // get country id from country name
        $countryId = Cache::get('country:' . $request['country']);

        if (!$countryId) {
            $countryId = Country::where('name', $request['country'])->first()->id;
            Cache::put('country:' . $request['country'], $countryId, 3600);
        }

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
                'country_id' => $countryId,
                'state_province' => $request['state_province'],
                'zip_postal_code' => $request['zip_postal_code'],
                'phone' => $request['phone'],
            ]
        );

        Cache::forget('userInformation:' . $request['user_id']);
    }

    public static function storeUserBilling(array $request): void
    {
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
    }

    public static function storeUserShipping(array $request): void
    {
        User\UserShipping::updateOrCreate(
            [
                'user_id' => $request['user_id']
            ],
            [
                'shipping_address' => $request['address'],
                'shipping_city' => $request['city'],
                'shipping_state_province' => $request['state_province'],
                'shipping_country' => $request['country'],
            ]
        );
    }

    public static function storeUserOrder(array $request, array $cartPrice): void
    {
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
    }
}
