<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasePlanificadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_planificada', function (Blueprint $table) {
            $table->id('clase_planificada_id');
            //$table->unsignedBigInteger('clase_id');
            $table->date('fecha_clase');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unsignedBigInteger('clases_id'); //fk
            $table->unsignedBigInteger('sala_id'); //fk

            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('clases_id')->references('clases_id')->on('clases')->onDelete('cascade');
            $table->foreign('sala_id')->references('sala_id')->on('sala')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clase_planificada');
    }
}
