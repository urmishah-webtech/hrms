<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpidProfPersonalInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('profile_personal_informations', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropColumn('user_id'); 
			$table->bigInteger('emp_id')->nullable()->unsigned();
			$table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade'); 
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
