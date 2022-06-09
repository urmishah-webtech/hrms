<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerfomanceDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keyprofessional_excellences', function (Blueprint $table) {
			$table->date('perfomance_date')->nullable();
			$table->bigInteger('complete_perfomance_by_emp')->default(0)->comment("0=>incomplete, 1=>complete"); 
			$table->bigInteger('complete_perfomance_by_manager')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('new_personal_behavioral_excellence', function (Blueprint $table) {
			$table->date('perfomance_date')->nullable();
			$table->bigInteger('complete_perfomance_by_emp')->default(0)->comment("0=>incomplete, 1=>complete"); 
			$table->bigInteger('complete_perfomance_by_manager')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('special_initiatives', function (Blueprint $table) {
			$table->date('perfomance_date')->nullable();
			$table->bigInteger('complete_perfomance_by_emp')->default(0)->comment("0=>incomplete, 1=>complete"); 
			$table->bigInteger('complete_perfomance_by_manager')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('appraisee_strengths', function (Blueprint $table) {
			$table->date('perfomance_date')->nullable();
			$table->bigInteger('complete_perfomance_by_emp')->default(0)->comment("0=>incomplete, 1=>complete"); 
			$table->bigInteger('complete_perfomance_by_manager')->default(0)->comment("0=>incomplete, 1=>complete");
		});
		Schema::table('other_general_comments', function (Blueprint $table) {
			$table->date('perfomance_date')->nullable();
			$table->bigInteger('complete_perfomance_by_emp')->default(0)->comment("0=>incomplete, 1=>complete"); 
			$table->bigInteger('complete_perfomance_by_manager')->default(0)->comment("0=>incomplete, 1=>complete");
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
