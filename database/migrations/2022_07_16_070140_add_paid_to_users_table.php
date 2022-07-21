<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::table('employee_all_verbal_warnings', function (Blueprint $table) {
            $table->bigInteger('warning_by')->default(0);
            $table->bigInteger('status')->default(0)->comment("0=>withdraw, 1=>warning"); 
            $table->string('employee_documents_first')->nullable();
            $table->string('document_first')->nullable();
            $table->string('hr_input_first')->nullable();
            $table->string('employee_documents_second')->nullable();
            $table->string('document_second')->nullable();
            $table->string('hr_input_second')->nullable();
            $table->string('employee_documents_third')->nullable();
            $table->string('document_third')->nullable();
            $table->string('hr_input_third')->nullable();
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
