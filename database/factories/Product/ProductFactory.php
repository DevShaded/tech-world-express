<?php

namespace Database\Factories\Product;

use App\Models\Product\Information\ProductInformation;
use App\Models\Product\Product;
use App\Models\Product\ProductSpecification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(2, true);

        return [
            'sku' => $this->faker->ean8(),
            'name' => $name,
            'slug' => \Str::slug($name),
            'information_id' => null,
            'specification_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
