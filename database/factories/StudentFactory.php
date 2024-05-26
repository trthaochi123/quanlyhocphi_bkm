<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_name'=>$this->faker->name,
            'student_dob'=>$this->faker->date,
            'student_phone'=>$this->faker->e164PhoneNumber,
            'student_parent_phone'=>$this->faker->e164PhoneNumber,
            'province'=>$this->faker->city,
            'district'=>$this->faker->state,
            'street'=>$this->faker->streetAddress,
            'total_fee'=>$this->faker->randomNumber,
            'amount_each_time'=>$this->faker->randomNumber,
            'class_id'=>$this->faker->randomElement(DB::table('study_classes')->pluck('id')),
            'scholarship_id'=>$this->faker->randomElement(DB::table('scholarships')->pluck('id')),
            'payment_type_id'=>$this->faker->randomElement(DB::table('payment_types')->pluck('id')),

        ];
    }
}
