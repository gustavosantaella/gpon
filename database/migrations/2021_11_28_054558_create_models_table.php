<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('name')->default('NOMBRE DEL EQUIPO O MODELO');
            $table->string('code')->unique();
            $table->foreignId('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->timestamps();

            $table->index('name');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
