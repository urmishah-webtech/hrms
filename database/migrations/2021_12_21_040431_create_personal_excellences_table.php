<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalExcellencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_excellences', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->integer('plan_leave_employee')->nullable();
			$table->integer('time_cons_employee')->nullable();
			$table->integer('team_collaboration_employee')->nullable();
			$table->integer('professionalism_employee')->nullable();
			$table->integer('policy_employee')->nullable();
			$table->integer('initiatives_employee')->nullable();
			$table->integer('improvement_employee')->nullable();
			$table->integer('plan_leave_manager')->nullable();
			$table->integer('time_cons_manager')->nullable();
			$table->integer('team_collaboration_manager')->nullable();
			$table->integer('professionalism_manager')->nullable();
			$table->integer('policy_manager')->nullable();
			$table->integer('initiatives_manager')->nullable();			
			$table->integer('improvement_manager')->nullable();
			$table->integer('total_score_employee')->nullable();
			$table->integer('total_score_manager')->nullable();
			$table->integer('total_percentage_employee')->nullable();
			$table->integer('total_percentage_manager')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
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
        Schema::dropIfExists('personal_excellences');
    }
}
