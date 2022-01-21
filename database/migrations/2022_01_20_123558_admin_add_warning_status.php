<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminAddWarningStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_first_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('status')->default(1)->comment("0=>withdraw ,1=>warning");
		});
		Schema::table('employee_second_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('status')->default(1)->comment("0=>withdraw ,1=>warning");
		});
		Schema::table('employee_third_verbal_warnings', function (Blueprint $table) {
			$table->bigInteger('status')->default(1)->comment("0=>withdraw ,1=>warning");
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
