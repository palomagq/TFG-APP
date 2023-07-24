<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('categoria_ejercicio', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');

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
        Schema::table('categoria_ejercicio', function($table) {
            $table->dropColumn('usuario_id');
        });
    }
}
