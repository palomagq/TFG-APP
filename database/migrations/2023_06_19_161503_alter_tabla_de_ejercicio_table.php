<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablaDeEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tabla_de_ejercicios', function($table) {
            $table->unsignedBigInteger('usuario_id');

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

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
        Schema::table('tabla_de_ejercicios', function($table) {
            $table->dropColumn('usuario_id');
        });
    }
}
