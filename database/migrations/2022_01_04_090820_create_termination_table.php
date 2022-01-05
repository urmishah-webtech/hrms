<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termination', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->string('type');
            $table->date('termination_date');
            $table->text('reason');
            $table->date('notice_date');
            $table->bigInteger('terminated_by')->unsigned();
            $table->bigInteger('resignation_id')->nullable();
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
        Schema::dropIfExists('termination');
    }
}
