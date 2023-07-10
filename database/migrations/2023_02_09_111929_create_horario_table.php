<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->id('horario_id');
            //$table->unsignedBigInteger('horario_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('clase_id'); //fk
            $table->unsignedBigInteger('sala_id'); //fk
            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('clase_id')->references('clase_id')->on('clase')->onDelete('cascade');
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
        Schema::dropIfExists('horario');
    }
}
