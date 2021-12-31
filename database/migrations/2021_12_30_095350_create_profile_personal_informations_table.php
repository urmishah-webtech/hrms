<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePersonalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_personal_informations', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->string('passport_no')->nullable();
			$table->date('passport_expiry_date')->nullable();
            $table->string('tel')->nullable();
			$table->string('nationality')->nullable();
			$table->string('religion')->nullable();
			$table->string('marital_status')->nullable();
			$table->string('employment_of_spouse')->nullable();
			$table->integer('No_of_children')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
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
        Schema::dropIfExists('profile_personal_informations');
    }
}
