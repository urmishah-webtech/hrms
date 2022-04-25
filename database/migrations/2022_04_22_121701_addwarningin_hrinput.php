<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddwarninginHrinput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_first_verbal_warnings', function (Blueprint $table) {
           $table->string('hr_input')->nullable();
        });
		Schema::table('employee_second_verbal_warnings', function (Blueprint $table) {
           $table->string('hr_input')->nullable();
        });
		Schema::table('employee_third_verbal_warnings', function (Blueprint $table) {
           $table->string('hr_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
