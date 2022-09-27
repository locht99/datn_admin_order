<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'partner_id' => rand(1,100),
            'username' => $this->faker->userName,
            'password' => Hash::make(12345678),
            'email' => $this->faker->email,
            'phone' => rand(10000,20000),
            'language' => $this->faker->languageCode,
            'uid' => rand(1000000,2000000)
        ];
    }
}
