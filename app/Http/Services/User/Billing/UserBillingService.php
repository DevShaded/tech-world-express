<?php

namespace App\Http\Services\User\Billing;

use App\Http\Resources\User\Billing\UserBillingResource;
use App\Models\User\UserBilling;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class UserBillingService
{
    public static function getUserBilling(string $id): AnonymousResourceCollection
    {
        $userBilling = Cache::get('userBilling:' . $id);

        if (!$userBilling) {
            $userBilling = UserBilling::with('user')
                ->where('user_id', $id)
                ->get();

            Cache::put('userBilling:' . $id, $userBilling, 3600);
        }

        return UserBillingResource::collection($userBilling);
    }

    public static function updateUserBilling(array $data): void
    {
        $userBilling = UserBilling::where('user_id', $data['user_id'])->first();

        if (!$userBilling) {
            UserBilling::create($data);
        } else {
            $userBilling->update($data);
        }

        Cache::forget('userBilling:' . $data['user_id']);
    }

    public static function deleteUserBilling(string $id): void
    {
        UserBilling::where('id', $id)->delete();

        Cache::forget('userBilling:' . auth()->user()->id);
    }
}
