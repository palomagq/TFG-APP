<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDistanciaAsignacionRutinaEjerciciosTable extends Migration
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
            $table->dropColumn('distancia');

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
        Schema::table('asignacion_rutina_ejercicios', function (Blueprint $table) {
            $table->float('distancia');
        });
    }
}
