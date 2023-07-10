<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio', function (Blueprint $table) {
            //$table->unsignedBigInteger('ejercicio_id');
            $table->id('ejercicio_id');
            $table->string('nombre');
            $table->string('imagePath');
            $table->unsignedBigInteger('categoria_id'); //fk
            $table->unsignedBigInteger('tipo_id'); //fk
            $table->timestamps();

              //FOREIGN KEY
              $table->foreign('categoria_id')->references('categoria_ejercicio_id')->on('categoria_ejercicio')->onDelete('cascade');
              $table->foreign('tipo_id')->references('tipo_ejercicio_id')->on('tipo_ejercicio')->onDelete('cascade');
  
              //PRIMARY KEYS
              //$table->primary(['categoria_ejercicio_id','tipo_ejercicio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejercicio');
    }
}
