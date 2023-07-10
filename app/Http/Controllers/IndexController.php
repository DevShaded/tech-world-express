<?php

namespace App\Http\Controllers;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Index', [
            'data' => [
                'categories' => Category::all(),
                'products' => Product::with('information', 'information.category', 'information.productInformationPicture')
                    ->inRandomOrder()
                    ->limit(4)
                    ->get(),
            ],
        ]);
    }
}
