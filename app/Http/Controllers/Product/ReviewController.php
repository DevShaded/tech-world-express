<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductReviewRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductReviews;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    public function __invoke(ProductReviewRequest $request)
    {
        ProductReviews::create($request->validated());

        $slug = Product::where('id', $request['product_id'])->first()->slug;

        $product = Cache::get('categories:' . $request['category_name'] . ':product:' . $slug);

        if ($product) {
            Cache::forget('categories:' . $request['category_name'] . ':product:' . $slug);
        }

        return redirect()->back();
    }
}
