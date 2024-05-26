<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name',100);
            $table->date('student_dob');
            $table->string('student_phone',20);
            $table->string('student_parent_phone',20);
            $table->string('province',100);
            $table->string('district',100);
            $table->string('street',100);
            $table->double('total_fee');
            $table->double('amount_each_time');
            $table->foreignId('class_id')->constrained('study_classes');
            $table->foreignId('scholarship_id')->constrained('scholarships');
            $table->foreignId('payment_type_id')->constrained('payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
