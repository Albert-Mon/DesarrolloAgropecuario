<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tipocapacitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocapacitaciones',function(Blueprint $table){
            $table->increments('Id_tipocapacitacion');
            $table->string('nombretipocapacitacion',250);
            $table->string('categoria',255);
            $table->string('descripciontipocapacitacion',255);
            $table->date('fechainicio',25);
            $table->date('fechafinal',25);
            $table->string('lugar',255);
            $table->string('horario',20);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipocapacitaciones');
    }
}
