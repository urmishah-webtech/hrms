<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesToEmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->dropForeign('employee_leaves_leave_type_id_foreign');
            //$table->dropColumn('leave_type_id');
           // $table->tinyInteger('leave_type_id')->comment('0=causal leave ,1= sick leave,2=hospitalisation,3=maternity,4=paternity,5=lop')->nullable();
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
