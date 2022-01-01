<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToPerformanceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_settings', function (Blueprint $table) {
            $table->longText('competency_scale2_rating')->nullable();
            $table->longText('competency_scale3_rating')->nullable();
            $table->longText('smart_scale2_rating')->nullable();
            $table->longText('smart_scale3_rating')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_settings', function (Blueprint $table) {
            //
        });
    }
}
