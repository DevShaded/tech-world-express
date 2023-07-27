<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\IndexController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
