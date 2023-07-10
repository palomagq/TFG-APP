<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sala', function (Blueprint $table) {
            $table->id('sala_id');
            //$table->unsignedBigInteger('sala_id');
            $table->string('nombre');
            $table->integer('serie');
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
        Schema::dropIfExists('sala');
    }
}
