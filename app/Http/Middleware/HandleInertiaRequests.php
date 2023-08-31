<?php

namespace App\Http\Middleware;

use App\Http\Services\Category\CategoryService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cart = Cart::content();

        if (count($cart) < 1) {
            $cart = null;
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'categories' => CategoryService::getAllCategories() ?? null,
            'cart' => [
                'count' => Cart::content()->count(),
                'content' => $cart,
            ],
            'app' => [
                'url' => config('app.url'),
            ],
        ]);
    }
}
