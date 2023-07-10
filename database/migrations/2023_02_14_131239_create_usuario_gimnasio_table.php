<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioGimnasioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_gimnasio', function (Blueprint $table) {
            $table->id('usuario_gimnasio_id');
            $table->unsignedBigInteger('gimnasio_id'); //fk
            $table->unsignedBigInteger('usuarios_id'); //fk
            $table->timestamps();

            //FOREIGN KEY
            $table->foreign('gimnasio_id')->references('gimnasio_id')->on('gimnasio')->onDelete('cascade');
            $table->foreign('usuarios_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_gimnasio');
    }
}
