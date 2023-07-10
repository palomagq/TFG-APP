<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAsignacionTablaEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('asignacion_rutina_ejercicios', function (Blueprint $table) {
            $table->integer('serie');
            $table->integer('repeticion');
            $table->float('distancia');
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
        Schema::table('asignacion_rutina_ejercicios', function($table) {
            $table->dropColumn('serie');
            $table->dropColumn('repeticion');
            $table->dropColumn('distancia');
        });
    }
}
