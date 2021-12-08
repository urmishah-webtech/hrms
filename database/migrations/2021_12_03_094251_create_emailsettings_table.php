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
			$table->string('mailoption');
			$table->string('email_from_address');
            $table->string('email_from_name');
            $table->string('smtp_host');
            $table->string('smtp_user');
            $table->string('smtp_password');
            $table->integer('smtp_port');
            $table->string('smtp_security');
            $table->string('smtp_domain');
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
