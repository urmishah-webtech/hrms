<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSecondVerbalWarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_second_verbal_warnings', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->string('employee_comments')->nullable();
			$table->string('managers_comments')->nullable();
			$table->string('admin_comments')->nullable();
			$table->string('areas_for_improvement')->nullable();			
			$table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_second_verbal_warnings');
    }
}
