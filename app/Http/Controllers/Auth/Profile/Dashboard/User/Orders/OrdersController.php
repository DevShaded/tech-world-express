<?php

namespace App\Http\Controllers\Auth\Profile\Dashboard\User\Orders;

use App\Http\Controllers\Controller;
use App\Http\Services\User\Order\UserOrdersService;
use Inertia\Inertia;

class OrdersController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Dashboard/User/Orders/Index', [
            'data' => [
                'orders' => [
                    'all' => UserOrdersService::getUserOrders(auth()->user()->id),
                    'pending' => UserOrdersService::getPendingUserOrders(auth()->user()->id),
                    'processing' => UserOrdersService::getProcessingUserOrders(auth()->user()->id),
                    'shipped' => UserOrdersService::getShippedUserOrders(auth()->user()->id),
                    'completed' => UserOrdersService::getCompletedUserOrders(auth()->user()->id),
                    'cancelled' => UserOrdersService::getCancelledUserOrders(auth()->user()->id),
                ],
            ],
        ]);
    }

    public function show(string $status)
    {
        $status = match ($status) {
            'pending' => 'pending',
            'processing' => 'processing',
            'shipped' => 'shipped',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
            default => 'all',
        };

        return Inertia::render('Profile/Dashboard/User/Orders/Show', [
            'status' => $status,
            'data' => [
                'orders' => UserOrdersService::getUserOrderByStatus(auth()->user()->id, $status),
            ],
        ]);
    }
}
