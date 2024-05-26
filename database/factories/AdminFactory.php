<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'admin_name'=>$this->faker->name,
            'admin_phone'=>$this->faker->e164PhoneNumber,
            'province'=>$this->faker->city,
            'district'=>$this->faker->state,
            'street'=>$this->faker->streetAddress,
            'admin_username'=>$this->faker->word,
            'admin_password'=>bcrypt('123456')
        ];
    }
}
