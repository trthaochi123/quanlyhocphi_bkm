<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_id'=>$this->faker->randomElement(DB::table('students')->pluck('id')),
            'payment_method_id'=>$this->faker->randomElement(DB::table('payment_methods')->pluck('id')),
            'accountant_id'=>$this->faker->randomElement(DB::table('accountants')->pluck('id')),
            'submitter_name'=>$this->faker->name,
            'submitter_phone'=>$this->faker->e164PhoneNumber,
            'payment_date_time'=>$this->faker->dateTime,
            'amount_of_money'=>$this->faker->randomNumber,
            'amount_owed'=>$this->faker->randomNumber,
            'note'=>$this->faker->text,
        ];
    }
}
