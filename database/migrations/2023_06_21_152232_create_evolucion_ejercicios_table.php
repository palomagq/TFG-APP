<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolucionEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolucion_ejercicios', function (Blueprint $table) {
            $table->id('evolucion_ejercicios_id');
            $table->date('fecha_registro');
            $table->unsignedBigInteger('tabla_de_ejercicios_id'); //fk
            $table->unsignedBigInteger('usuario_id'); //fk

            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('tabla_de_ejercicios_id')->references('tabla_de_ejercicios_id')->on('tabla_de_ejercicios')->onDelete('cascade');
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
        Schema::dropIfExists('evolucion_ejercicios');
    }
}
