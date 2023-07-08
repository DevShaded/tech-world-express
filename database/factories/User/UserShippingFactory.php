<?php

namespace Database\Factories\User;

use App\Models\User;
use App\Models\User\UserShipping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserShippingFactory extends Factory
{
    protected $model = UserShipping::class;

    public function definition(): array
    {
        return [
            'shipping_address' => $this->faker->address(),
            'shipping_city' => $this->faker->city(),
            'shipping_state_province' => $this->faker->word(),
            'shipping_country' => $this->faker->country(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
