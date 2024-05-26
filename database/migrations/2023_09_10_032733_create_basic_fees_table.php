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
        Schema::create('basic_fees', function (Blueprint $table) {
            $table->foreignId('major_id')->constrained('majors');
            $table->foreignId('academic_id')->constrained('academic_years');
            $table->double('basic_fee_amount');
            $table->primary(['major_id','academic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_fees');
    }
};
