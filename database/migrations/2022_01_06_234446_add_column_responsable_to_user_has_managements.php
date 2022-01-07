<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnResponsableToUserHasManagements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_has_managements', function (Blueprint $table) {
            $table->boolean('responsable')->default(false)->nullable()->comment('responsable de la unidad')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_has_managements', function (Blueprint $table) {
            $table->dropColumn('responsable');
        });
    }
}
