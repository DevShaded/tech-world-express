<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductReviews;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductReviewsFactory extends Factory
{
    protected $model = ProductReviews::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'content' => $this->faker->text(),
            'rating' => $this->faker->numberBetween('0', '6'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
