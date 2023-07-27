<?php

namespace App\Http\Resources\Product;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'information_id' => $this->information_id,
            'specification_id' => $this->specification_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'information' => $this->whenLoaded('information'),
            'category' => $this->whenLoaded('information.category'),
            'specifications' => $this->whenLoaded('specification'),
            'faqs' => $this->whenLoaded('faqs'),

            // get all reviews for this product recent first
            'reviews' => $this->whenLoaded('reviews', function () {
                return $this->reviews->sortByDesc('created_at');
            }),
        ];
    }
}
