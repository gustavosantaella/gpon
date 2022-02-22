<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanificationFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planification_files', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('planification_id')->unsigned()->unique();
            $table->foreign('planification_id')->references('id')->on('planifications')->onDelete('cascade');
            $table->string('file')->index();
        //    $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planification_files');
    }
}
