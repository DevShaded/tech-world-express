<?php

use App\Http\Controllers\Auth\Profile\Dashboard\User\Account\ProfileController;
use App\Http\Controllers\Auth\Profile\Dashboard\User\Billing\BillingController;
use App\Http\Controllers\Auth\Profile\Dashboard\User\Information\InformationController;
use App\Http\Controllers\Auth\Profile\Dashboard\User\Orders\OrdersController;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::prefix('/user')->group(function () {
            Route::get('/information', [InformationController::class, 'index'])->name('information.index');
            Route::patch('/information', [InformationController::class, 'update'])->name('information.update');

            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
            Route::get('/billing/edit', [BillingController::class, 'edit'])->name('billing.edit');
            Route::patch('/billing', [BillingController::class, 'update'])->name('billing.update');
            Route::delete('/billing/{id}', [BillingController::class, 'destroy'])->name('billing.destroy');

            Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
            Route::get('/orders/{status}', [OrdersController::class, 'show'])->name('orders.show');
        });
    });
});
