<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id('clases_id');
            //$table->unsignedBigInteger('clase_id');
            $table->string('nombre');
            $table->boolean('activo');
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
        Schema::dropIfExists('clases');
    }
}
