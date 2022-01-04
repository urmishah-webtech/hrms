<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resignations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employeeid')->nullable();
            $table->bigInteger('department')->nullable();
            $table->text('reason')->nullable();
            $table->date('noticedate')->nullable();
            $table->date('resignationdate')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('decisionby')->nullable();
            $table->string('2weeknotice')->nullable();
            $table->string('rehireable')->nullable();
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
        Schema::dropIfExists('resignations');
    }
}
