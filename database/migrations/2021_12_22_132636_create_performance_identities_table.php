<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_identities', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->string('user_role')->nullable();
			$table->string('name')->nullable();
			$table->string('signature')->nullable();
			$table->date('date')->nullable();
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
        Schema::dropIfExists('performance_identities');
    }
}
