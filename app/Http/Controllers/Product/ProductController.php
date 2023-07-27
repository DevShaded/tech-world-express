<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use Inertia\{Inertia, Response};

class ProductController extends Controller
{
    public function show(string $name, string $slug): Response
    {
        return Inertia::render('Categories/Product/Show', [
            'data' => [
                'product' => ProductService::getProduct($name, $slug) ?? null,
            ],
        ]);
    }
}
