<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleidInemployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->bigInteger('role_id')->nullable()->unsigned();
			$table->bigInteger('manager_id')->nullable()->unsigned();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');	
			$table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');			
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
