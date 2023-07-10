<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class RenameCapacidadColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sala', function(Blueprint $table) {
            $table->renameColumn('serie', 'capacidad');
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
        Schema::table('sala', function(Blueprint $table) {
            $table->renameColumn('capacidad', 'serie');
        });
    }
}
