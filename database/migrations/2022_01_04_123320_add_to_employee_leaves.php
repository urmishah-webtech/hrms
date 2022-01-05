<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToEmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('1=pending,2=approved,3=disappoved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            //
        });
    }
}
