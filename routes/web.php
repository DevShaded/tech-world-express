<?php

use App\Http\Controllers\Auth\Profile\Dashboard\User\Information\InformationController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Checkout\CheckoutSuccessController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Product\Cart\CartController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', IndexController::class)->name('index');

Route::resource('categories', CategoryController::class)
    ->except(['create', 'edit', 'update', 'destroy'])
    ->names(['categories.index', 'categories.show']);

Route::get('/categories/{name}/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::post('/product/review', ReviewController::class)->name('product.review');

Route::resource('/cart', CartController::class)
    ->except(['create', 'update', 'edit', 'show'])
    ->names(['cart.index', 'cart.store', 'cart.update', 'cart.destroy'])
    ->middleware('auth');

Route::resource('/checkout', CheckoutController::class)
    ->except(['create', 'edit', 'update', 'show'])
    ->names(['checkout.index', 'checkout.store', 'checkout.destroy'])
    ->middleware('auth');

Route::get('/checkout/success', CheckoutSuccessController::class)
    ->name('checkout.success')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::prefix('/user')->group(function () {
            Route::resource('/information', InformationController::class)
                ->except(['create', 'edit', 'update', 'show']);
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
