<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWarningby extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_first_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('warning_by')->nullable()->unsigned();
		});
		Schema::table('employee_second_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('warning_by')->nullable()->unsigned();
		});
		Schema::table('employee_third_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('warning_by')->nullable()->unsigned();
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
