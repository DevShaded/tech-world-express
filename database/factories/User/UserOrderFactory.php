<?php

namespace Database\Factories\User;

use App\Models\User;
use App\Models\User\UserOrder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserOrderFactory extends Factory
{
    protected $model = UserOrder::class;

    public function definition(): array
    {
        return [
            'order_date' => $this->faker->dateTime('-1 year'),
            'total_amount' => $this->faker->randomFloat('2', '', '8'),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'completed', 'cancelled']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
