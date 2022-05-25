<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewPersonalExcellence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('new_personal_behavioral_excellence', function (Blueprint $table) {
            $table->id(); 
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->bigInteger('user_id')->nullable();
			$table->longText('percentage_achieved_employee')->nullable();
			$table->longText('points_scored_employee')->nullable();
			$table->longText('percentage_achieved_manager')->nullable();
			$table->longText('points_scored_manager')->nullable();
			$table->float('total_score_employee')->nullable();
			$table->float('total_score_manager')->nullable();
			$table->float('total_percentage_employee')->nullable();
			$table->float('total_percentage_manager')->nullable();
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
        //
    }
}
