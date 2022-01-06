<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->morphs('line');
            $table->longText('answer');
            $table->boolean('approve')->default(false);
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
        Schema::dropIfExists('answer_lines');
    }
}
