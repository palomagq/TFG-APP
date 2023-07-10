<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioGimnasioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_gimnasio', function (Blueprint $table) {
            $table->id('horario_gimnasio_id');
            $table->time('hora_inicio_lv');
            $table->time('hora_fin_lv');
            $table->time('hora_inicio_sabado');
            $table->time('hora_fin_sabado');
            $table->time('hora_inicio_domingo');
            $table->time('hora_fin_domingo');
            $table->time('hora_inicio_festivo');
            $table->time('hora_fin_festivo');
            $table->unsignedBigInteger('gimnasio_id'); //fk
            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('gimnasio_id')->references('gimnasio_id')->on('gimnasio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_gimnasio');
    }
}
