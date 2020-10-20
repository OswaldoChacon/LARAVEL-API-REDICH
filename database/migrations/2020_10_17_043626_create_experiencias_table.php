<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {            
            $table->id();
            $table->string('puesto');
            $table->string('empresa');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('actividades');
            $table->bigInteger('usuario_id')->unsigned();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiencias');
    }
}
