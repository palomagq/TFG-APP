<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivoCiudadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivo_ciudad', function (Blueprint $table) {
            $table->id('festivo_ciudad_id');
            $table->date('fecha_festivo');
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
        Schema::dropIfExists('festivo_ciudad');
    }
}
