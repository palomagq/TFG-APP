<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolucionEjerciciosDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolucion_ejercicios_datos', function (Blueprint $table) {
            $table->id('evolucion_ejercicios_datos_id');
            $table->integer('serie');
            $table->integer('repeticion');
            $table->float('distancia');
            $table->float('peso');
            $table->unsignedBigInteger('ejercicio_id'); //fk
            $table->unsignedBigInteger('evolucion_ejercicios_id'); //fk

            $table->timestamps();

              //FOREIGN KEY
              $table->foreign('evolucion_ejercicios_id')->references('evolucion_ejercicios_id')->on('evolucion_ejercicios')->onDelete('cascade');
              $table->foreign('ejercicio_id')->references('ejercicio_id')->on('ejercicio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolucion_ejercicios_datos');
    }
}
