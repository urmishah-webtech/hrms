<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHrCompleteStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('keyprofessional_excellences', function (Blueprint $table) { 
			$table->bigInteger('complete_perfomance_by_hr')->default(0)->comment("0=>incomplete, 1=>complete");  
		});
		Schema::table('new_personal_behavioral_excellence', function (Blueprint $table) {
			$table->bigInteger('complete_perfomance_by_hr')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('special_initiatives', function (Blueprint $table) {
			$table->bigInteger('complete_perfomance_by_hr')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('appraisee_strengths', function (Blueprint $table) {
			$table->bigInteger('complete_perfomance_by_hr')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('other_general_comments', function (Blueprint $table) {
			$table->bigInteger('complete_perfomance_by_hr')->default(0)->comment("0=>incomplete, 1=>complete");
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
