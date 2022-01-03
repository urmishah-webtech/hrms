<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColsToLeaveTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            $table->integer('sick_days')->nullable();
            $table->integer('sick_active_status')->nullable();
            $table->integer('hospitalisation_days')->nullable();
            $table->integer('hospitalisation_active_status')->nullable(); 
            $table->integer('maternity_days')->nullable();
            $table->integer('maternity_active_status')->nullable(); 
            $table->integer('paternity_days')->nullable();
            $table->integer('paternity_active_status')->nullable(); 
            $table->integer('lop_days')->nullable();
            $table->integer('lop_carry_fwd')->nullable();
            $table->integer('lop_max')->nullable();
            $table->integer('lop_active_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            //
        });
    }
}
