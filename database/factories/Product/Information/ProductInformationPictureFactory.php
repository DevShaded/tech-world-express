<?php

namespace Database\Factories\Product\Information;

use App\Models\Product\Information\ProductInformation;
use App\Models\Product\Information\ProductInformationPicture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductInformationPictureFactory extends Factory
{
    protected $model = ProductInformationPicture::class;

    public function definition(): array
    {
        return [
            'image' => 'https://picsum.photos/seed/' . $this->faker->word . '/200/300',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_information_id' => ProductInformation::factory(),
        ];
    }
}
