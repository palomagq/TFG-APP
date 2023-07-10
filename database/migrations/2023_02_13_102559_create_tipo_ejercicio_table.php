<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoEjercicioTable extends Migration
{
  
    public function up()
    {
        Schema::create('tipo_ejercicio', function (Blueprint $table) {
            $table->id('tipo_ejercicio_id');
            //$table->unsignedBigInteger('tipo_ejercicio_id');
            $table->string('nombre');
            $table->boolean('activo');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tipo_ejercicio');
    }
}
