<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivestatusToPerformanceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_settings', function (Blueprint $table) {
            $table->tinyInteger('okr_active')->nullable()->default(0);
            $table->tinyInteger('compentency_active')->nullable()->default(0);
            $table->tinyInteger('smart_goals_active')->nullable()->default(0);

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
