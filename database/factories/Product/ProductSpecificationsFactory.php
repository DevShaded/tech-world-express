<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductSpecifications;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductSpecificationsFactory extends Factory
{
    protected $model = ProductSpecifications::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'value' => $this->faker->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_id' => Product::factory(),
        ];
    }
}
