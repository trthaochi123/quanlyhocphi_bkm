<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyClass>
 */
class StudyClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_name'=>$this->faker->name,
            'major_id'=>$this->faker->randomElement(DB::table('majors')->pluck('id')),
            'academic_id'=>$this->faker->randomElement(DB::table('academic_years')->pluck('id')),
        ];
    }
}
