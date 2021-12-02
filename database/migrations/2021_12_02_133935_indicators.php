<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Indicators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('designation_id')->unsigned();
            $table->tinyInteger('customer_experience')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
            $table->tinyInteger('integrity')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('marketing')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('professionalism')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('management')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
              $table->tinyInteger('teamwork')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('administration')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
            $table->tinyInteger('critical_thinking')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('presentation_skills')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
              $table->tinyInteger('conflict_management')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader"); 
             $table->tinyInteger('quality_of_work')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
              $table->tinyInteger('attendance')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
            $table->tinyInteger('efficiency')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
            $table->tinyInteger('ability _to_meet_deadline')->default(0)->comment("0=>none,1=>beginner
            ,2=>intermedidate,3=>advanced,4=>expert/leader");
            $table->tinyInteger('status')->default(0)->comment("0=>deactive,1=>active");
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');;
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
        //
    }
}
