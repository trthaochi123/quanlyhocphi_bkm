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
        Schema::table('accountants', function (Blueprint $table) {
            DB::statement('ALTER TABLE accountants CHANGE accountant_username email varchar(100)');
            DB::statement('ALTER TABLE accountants CHANGE accountant_password password varchar(100)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accountants', function (Blueprint $table) {
            DB::statement('ALTER TABLE accountants CHANGE accountant_username email');
            DB::statement('ALTER TABLE accountants CHANGE accountant_password password');
        });
    }
};
