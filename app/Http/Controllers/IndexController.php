<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Index', [
            'data' => [
                'products' => ProductService::getRandomProducts() ?? null,
            ],
        ]);
    }
}
