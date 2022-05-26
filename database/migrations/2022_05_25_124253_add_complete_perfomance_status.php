<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletePerfomanceStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
			$table->bigInteger('complete_professional_excellence')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_personal_excellence')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_special_initiative')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_appraisee_strength')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_other_general_comments')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_managers_use')->default(0)->comment("0=>incomplete, 1=>complete");
			$table->bigInteger('complete_identitie')->default(0)->comment("0=>incomplete, 1=>complete");
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
