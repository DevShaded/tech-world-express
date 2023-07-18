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
        $categories = Cache::get('categories');

        if (!$categories) {
            $categories = Category::all();

            Cache::put('categories', $categories, 3600);
        }

        return CategoryResource::collection($categories);
    }

    public static function getCategoryWithProducts(string $name): AnonymousResourceCollection
    {
        $products = Cache::get('products:' . $name);

        if (!$products) {
            $products = Product::whereHas('information.category', function ($query) use ($name) {
                $query->where('name', $name);
            })->with('information', 'information.productInformationPicture')->get();

            Cache::put('products:' . $name, $products, 3600);
        }

        return ProductResource::collection($products);
    }

    public static function getCategoryByName(string $name): Category
    {
        $category = Cache::get('category:' . $name);

        if (!$category) {
            $category = Category::where('name', $name)->first();

            Cache::put('category:' . $name, $category, 3600);
        }

        return $category;
    }
}
