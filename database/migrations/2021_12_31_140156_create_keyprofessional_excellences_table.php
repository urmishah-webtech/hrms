<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyprofessionalExcellencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyprofessional_excellences', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->longText('percentage_achieved_employee')->nullable();
			$table->longText('points_scored_employee')->nullable();
			$table->longText('percentage_achieved_manager')->nullable();
			$table->longText('points_scored_manager')->nullable();
			$table->longText('total_achieved_employee')->nullable();
			$table->longText('total_scored_employee')->nullable();
			$table->longText('total_achieved_manager')->nullable();
			$table->longText('total_scored_manager')->nullable();
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
        Schema::dropIfExists('keyprofessional_excellences');
    }
}
