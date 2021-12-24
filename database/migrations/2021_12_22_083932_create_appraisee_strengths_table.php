<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraiseeStrengthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisee_strengths', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->string('strengths')->nullable();
			$table->string('areas_improvement')->nullable();
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
        Schema::dropIfExists('appraisee_strengths');
    }
}
