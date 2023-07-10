<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUsuarioEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('usuario_ejercicio', function (Blueprint $table) {
            $table->dropColumn('serie');
            $table->dropColumn('repeticion');
            $table->dropColumn('distancia');
            $table->dropColumn('peso');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('usuario_ejercicio', function (Blueprint $table) {
            $table->integer('serie');
            $table->integer('repeticion');
            $table->float('distancia');
            $table->float('peso');	        
        });
    }
}
