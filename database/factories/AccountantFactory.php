<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accountant>
 */
class AccountantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'accountant_name'=>$this->faker->name,
            'accountant_phone'=>$this->faker->e164PhoneNumber,
            'province'=>$this->faker->city,
            'district'=>$this->faker->state,
            'street'=>$this->faker->streetAddress,
            'accountant_username'=>$this->faker->word,
            'accountant_password'=>bcrypt('123456')
        ];
    }
}
