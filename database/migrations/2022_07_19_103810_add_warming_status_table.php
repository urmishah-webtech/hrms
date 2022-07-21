<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarmingStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_all_verbal_warnings', function (Blueprint $table) {
            $table->bigInteger('warmingstatus')->default(0)->comment("1=>wamingone, 2=>warningsecond ,3=>warmingthree"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_all_verbal_warnings', function (Blueprint $table) {
            //
        });
    }
}
