<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacidadClaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacidad_clase', function (Blueprint $table) {
            $table->id('capacidad_clase_id');
            //$table->unsignedBigInteger('clase_id');
            $table->date('fecha_registro');
            $table->unsignedBigInteger('clase_planificada_id'); //fk
            $table->unsignedBigInteger('usuario_id'); //fk

            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('clase_planificada_id')->references('clase_planificada_id')->on('clase_planificada')->onDelete('cascade');
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
        Schema::dropIfExists('capacidad_clase');
    }
}
