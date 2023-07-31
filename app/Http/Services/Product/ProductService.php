<?php

namespace App\Http\Services\Product;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public static function getRandomProducts(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::with('information', 'information.category', 'information.productInformationPicture')
            ->inRandomOrder()
            ->limit(4)
            ->get());
    }

    public static function getProduct(string $name, string $slug): AnonymousResourceCollection
    {
        $product = Cache::get('categories:' . $name . ':product:' . $slug);

        if (!$product) {
            $product = Product::whereHas('information.category', function ($query) use ($name) {
                $query->where('name', $name);
            })->where('slug', $slug)
                ->with('information', 'information.productInformationPicture', 'information.category', 'specification', 'faqs', 'reviews', 'reviews.user')
                ->get();

            // if product is not found return 404
            if ($product->isEmpty()) {
                abort(404);
            }

            Cache::put('categories:' . $name . ':product:' . $slug, $product, 3600);
        }

        return ProductResource::collection($product);
    }

    public static function getProductWithoutCollection(string $name, string $slug)
    {
        $product = Cache::get('cart:' . ':categories:' . $name . ':product:' . $slug);

        if (!$product) {
            $product = Product::whereHas('information.category', function ($query) use ($name) {
                $query->where('name', $name);
            })->where('slug', $slug)
                ->with('information', 'information.productInformationPicture', 'information.category')
                ->get();

            // if product is not found return 404
            if ($product->isEmpty()) {
                abort(404);
            }

            Cache::put('cart:' . ':categories:' . $name . ':product:' . $slug, $product, 3600);
        }

        return $product;
    }
}

