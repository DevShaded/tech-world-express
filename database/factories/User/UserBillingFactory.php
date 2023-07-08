<?php

namespace Database\Factories\User;

use App\Models\User;
use App\Models\User\UserBilling;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserBillingFactory extends Factory
{
    protected $model = UserBilling::class;

    public function definition(): array
    {
        return [
            'card_number' => $this->faker->creditCardNumber(),
            'card_name' => $this->faker->name(),
            'card_expiry' => $this->faker->creditCardExpirationDate(),
            'card_cvv' => $this->faker->numberBetween(100, 999),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
