<?php

namespace Database\Factories\Product\Information;

use App\Models\Category\Category;
use App\Models\Product\Information\ProductInformation;
use App\Models\Product\Information\ProductInformationPicture;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductInformationFactory extends Factory
{
    protected $model = ProductInformation::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat('2', '', '8'),
            'product_information_picture_id' => null,
            'highlights' => $this->faker->word(),
            'stock' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_id' => Product::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
