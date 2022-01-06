<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManagementConstructions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_constructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('management_id')->references('id')->on('managements')->onDelete('cascade');
            $table->foreignId('construction_id')->references('id')->on('constructions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('management_constructions');
    }
}
