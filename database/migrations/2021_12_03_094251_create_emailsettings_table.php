<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailsettings', function (Blueprint $table) {
            $table->id();
			$table->string('mailoption')->nullable();
			$table->string('email_from_address')->nullable();
            $table->string('email_from_name')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_password')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_security')->nullable();
            $table->string('smtp_domain')->nullable();
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
        Schema::dropIfExists('emailsettings');
    }
}
