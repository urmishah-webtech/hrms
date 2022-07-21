<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAllVerbalWarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_all_verbal_warnings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emp_id')->nullable()->unsigned();
			$table->string('employee_comments_first')->nullable();
			$table->string('managers_comments_first')->nullable();
			$table->string('admin_comments_first')->nullable();
			$table->string('areas_for_improvement_first')->nullable();
			$table->string('employee_comments_second')->nullable();
			$table->string('managers_comments_second')->nullable();
			$table->string('admin_comments_second')->nullable();
			$table->string('areas_for_improvement_second')->nullable();
			$table->string('employee_comments_third')->nullable();
			$table->string('managers_comments_third')->nullable();
			$table->string('admin_comments_third')->nullable();
			$table->string('areas_for_improvement_third')->nullable();
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
        Schema::dropIfExists('employee_all_verbal_warnings');
    }
}
