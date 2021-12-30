<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_emergency_contacts', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->nullable()->unsigned();
			$table->string('primary_name')->nullable();	
            $table->string('primary_relationship')->nullable();
			$table->string('primary_phone1')->nullable();
			$table->string('primary_phone2')->nullable();
			$table->string('secondary_name')->nullable();
			$table->string('secondary_relationship')->nullable();
			$table->string('secondary_phone1')->nullable();
			$table->string('secondary_phone2')->nullable();			
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
        Schema::dropIfExists('profile_emergency_contacts');
    }
}
