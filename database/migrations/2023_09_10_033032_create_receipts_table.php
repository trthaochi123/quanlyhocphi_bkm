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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('accountant_id')->constrained('accountants');
            $table->string('submitter_name',100);
            $table->string('submitter_phone',20);
            $table->dateTime('payment_date_time');
            $table->double('amount_of_money');
            $table->double('amount_owed');
            $table->text('note');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};
