<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 

class AddtoColmEmailsettingNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emailsettings', function (Blueprint $table) {
            $table->string('mailoption')->nullable()->change();
			$table->string('email_from_address')->nullable()->change();
            $table->string('email_from_name')->nullable()->change();
            $table->string('smtp_host')->nullable()->change();
            $table->string('smtp_user')->nullable()->change();
            $table->string('smtp_password')->nullable()->change();
            $table->integer('smtp_port')->nullable()->change();
            $table->string('smtp_security')->nullable()->change();
            $table->string('smtp_domain')->nullable()->change();           
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
