<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductFaqs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFaqsFactory extends Factory
{
    protected $model = ProductFaqs::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
