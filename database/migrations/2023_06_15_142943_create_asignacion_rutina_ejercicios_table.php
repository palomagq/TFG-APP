<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionRutinaEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_rutina_ejercicios', function (Blueprint $table) {
            $table->id('asignacion_rutina_ejercicios_id');
            $table->unsignedBigInteger('tabla_de_ejercicios_id'); //fk
            $table->unsignedBigInteger('ejercicio_id'); //fk
            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('tabla_de_ejercicios_id')->references('tabla_de_ejercicios_id')->on('tabla_de_ejercicios')->onDelete('cascade');
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
        Schema::dropIfExists('asignacion_rutina_ejercicios');
    }
}
