<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitudapoyos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudapoyos',function(Blueprint $table){
            $table->increments('Id_solicitudapoyo');
            //Llave foranea #1
            $table->integer('Id_tipoapoyo')->unsigned();
            $table->foreign('Id_tipoapoyo')->references('Id_tipoapoyo')->on ('tipoapoyos');
            //Llave forane ESTATUS
            $table->integer('Id_estatus')->unsigned()->nullable();
            $table->foreign('Id_estatus')->references('Id_estatus')->on ('estatuses');
            //llave foranea #2 INCONCLUSA
            $table->integer('Id_perfilproductor');
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
        Schema::drop('solicitudapoyos');
    }
}
