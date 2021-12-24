<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalExcellencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_excellences', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->integer('quality_employee')->nullable();
			$table->integer('tat_employee')->nullable();
			$table->integer('pms_new_ideas_employee')->nullable();
			$table->integer('team_productivity_employee')->nullable();
			$table->integer('knowledge_sharing_employee')->nullable();
			$table->integer('emails_calls_employee')->nullable();
			$table->integer('quality_manager')->nullable();
			$table->integer('tat_manager')->nullable();
			$table->integer('pms_new_ideas_manager')->nullable();
			$table->integer('team_productivity_manager')->nullable();
			$table->integer('knowledge_sharing_manager')->nullable();
			$table->integer('emails_calls_manager')->nullable();			
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
        Schema::dropIfExists('professional_excellences');
    }
}
