<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class CreateEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('remaining_leave')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->text('leave_reason')->nullable();
            $table->bigInteger('leave_type_id')->nullable()->unsigned();
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('cascade');	
            $table->bigInteger('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');	
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
        Schema::dropIfExists('employee_leaves');
    }
}
