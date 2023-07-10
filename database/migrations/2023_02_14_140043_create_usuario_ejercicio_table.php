<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_ejercicio', function (Blueprint $table) {
            $table->id('usuario_ejercicio_id');
            $table->integer('serie');
            $table->integer('repeticion');
            $table->float('distancia');
            $table->float('peso');		
            $table->date('fecha');
            $table->unsignedBigInteger('usuarios_id'); //fk
            $table->unsignedBigInteger('ejercicio_id'); //fk

            $table->timestamps();


            //FOREIGN KEY
            $table->foreign('usuarios_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('ejercicio_id')->references('ejercicio_id')->on('ejercicio')->onDelete('cascade');

            //PRIMARY KEYS
            //$table->primary(['usuarios_id','ejercicio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_ejercicio');
    }
}
