<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaDeEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_de_ejercicios', function (Blueprint $table) {
                $table->id('tabla_de_ejercicios_id');
                //$table->unsignedBigInteger('tipo_ejercicio_id');
                $table->string('nombre_rutina_ejercicio');
                $table->timestamps();
         });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabla_de_ejercicios');
    }
}
