<?php

namespace App\Http\Services\User\Order;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserOrdersService
{
    public static function getUserOrders(string $id)
    {
        $userOrders = Cache::get('userOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->get();

            Cache::put('userOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }

    public static function getPendingUserOrders(string $id)
    {
        $userOrders = Cache::get('pendingUserOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->whereHas('userOrders', function ($query) {
                    $query->where('status', 'pending');
                })
                ->get();

            Cache::put('pendingUserOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }

    public static function getProcessingUserOrders(string $id)
    {
        $userOrders = Cache::get('processingUserOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->whereHas('userOrders', function ($query) {
                    $query->where('status', 'processing');
                })
                ->get();

            Cache::put('processingUserOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }

    public static function getShippedUserOrders(string $id)
    {
        $userOrders = Cache::get('shippedUserOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->whereHas('userOrders', function ($query) {
                    $query->where('status', 'shipped');
                })
                ->get();

            Cache::put('shippedUserOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }

    public static function getCompletedUserOrders(string $id)
    {
        $userOrders = Cache::get('completedUserOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->whereHas('userOrders', function ($query) {
                    $query->where('status', 'completed');
                })
                ->get();

            Cache::put('completedUserOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }

    public static function getCancelledUserOrders(string $id)
    {
        $userOrders = Cache::get('cancelledUserOrders:' . $id);

        if (!$userOrders) {
            $userOrders = User::with('userOrders', 'userOrders.userOrderItems', 'userOrders.userOrderItems.product', 'userOrders.userOrderItems.product.information', 'userOrders.userOrderItems.product.information.category', 'userOrders.userOrderItems.product.information.productInformationPicture')
                ->where('id', $id)
                ->whereHas('userOrders', function ($query) {
                    $query->where('status', 'cancelled');
                })
                ->get();

            Cache::put('cancelledUserOrders:' . $id, $userOrders, 3600);
        }

        return $userOrders;
    }
}
