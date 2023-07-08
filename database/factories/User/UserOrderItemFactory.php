<?php

namespace Database\Factories\User;

use App\Models\Product\Product;
use App\Models\User\UserOrder;
use App\Models\User\UserOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserOrderItemFactory extends Factory
{
    protected $model = UserOrderItem::class;

    public function definition(): array
    {
        return [
            'product_sku' => $this->faker->word(),
            'product_name' => $this->faker->name(),
            'product_price' => $this->faker->randomFloat('2', '', '8'),
            'quantity' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_order_id' => UserOrder::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
