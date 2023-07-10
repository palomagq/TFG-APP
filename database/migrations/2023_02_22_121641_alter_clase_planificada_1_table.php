<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClasePlanificada1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('clase_planificada', function($table) {
            $table->date('fecha_clase');
            $table->time('hora_inicio');
            $table->time('hora_fin');

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
        Schema::table('clase_planificada', function($table) {
            $table->dropColumn('fecha_clase');
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fin');

        });
    }
}
