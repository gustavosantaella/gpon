<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planifications', function (Blueprint $table) {
		$table->bigIncrements('id');
		$table->foreignId('parish_id')->references('id')->on('parishes')->onDelete('cascade');
		$table->string('name');
		$table->enum('status',['INCOMPLETO','POR REVISAR','RECHAZADO','APROBADO'])->nullable()->default('INCOMPLETO');
		$table->longText('observation');
		$table->timestamps();
		$table->softDeletes();
	
		$table->unique(['parish_id','name']);	
		$table->index('name');
		$table->index('status');
		$table->index('observation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planifications');
    }
}
