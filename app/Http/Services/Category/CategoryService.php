<?php

namespace App\Http\Services\Category;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public static function getAllCategories(): AnonymousResourceCollection
    {
        $categories = Cache::remember('categories', 3600, function () {
            return Category::all();
        });

        return CategoryResource::collection($categories);
    }

    public static function getCategoryWithProducts(string $name): AnonymousResourceCollection
    {
        $products = Cache::remember('products:' . $name, 3600, function () use ($name) {
            return Product::whereHas('information.category', function ($query) use ($name) {
                $query->where('name', $name);
            })->with('information', 'information.productInformationPicture')->get();
        });

        return ProductResource::collection($products);
    }

    public static function getCategoryByName(string $name): Category
    {
        return Category::where('name', $name)->first();
    }
}
