<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BasicFee>
 */
class BasicFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'major_id'=>$this->faker->randomDigitNotNull,
            'academic_id'=>$this->faker->randomDigitNotNull,
            'basic_fee_amount'=>$this->faker->randomNumber,
        ];
    }
}
