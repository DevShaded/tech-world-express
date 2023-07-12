<?php

namespace App\Http\Services\Product;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService
{
    public static function getRandomProducts(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::with('information', 'information.category', 'information.productInformationPicture')
            ->inRandomOrder()
            ->limit(4)
            ->get());
    }
}
