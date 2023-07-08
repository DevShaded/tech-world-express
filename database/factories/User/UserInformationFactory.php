<?php

namespace Database\Factories\User;

use App\Models\User;
use App\Models\User\UserInformation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserInformationFactory extends Factory
{
    protected $model = UserInformation::class;

    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state_province' => $this->faker->city(),
            'country' => $this->faker->country(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
