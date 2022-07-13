<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeEmpinformationtionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_empinformationtions', function (Blueprint $table) {
            $table->id();
			$table->integer('emp_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable(); 
            $table->string('phone_no')->nullable();
			$table->bigInteger('approve_status')->default(0)->comment("0=>Not Approve, 1=>Approve"); 
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
        Schema::dropIfExists('change_empinformationtions');
    }
}
