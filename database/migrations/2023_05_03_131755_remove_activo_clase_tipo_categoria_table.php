<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveActivoClaseTipoCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('clases', function (Blueprint $table) {
            $table->dropColumn('activo');

        });
        Schema::table('tipo_ejercicio', function (Blueprint $table) {
            $table->dropColumn('activo');

        });
        Schema::table('categoria_ejercicio', function (Blueprint $table) {
            $table->dropColumn('activo');

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
        Schema::table('clases', function (Blueprint $table) {
            $table->boolean('activo');
        });
        Schema::table('tipo_ejercicio', function (Blueprint $table) {
            $table->boolean('activo');
        });
        Schema::table('categoria_ejercicio', function (Blueprint $table) {
            $table->boolean('activo');
        });
    }
}
