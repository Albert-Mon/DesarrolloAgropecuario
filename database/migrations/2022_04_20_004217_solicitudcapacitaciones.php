<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitudcapacitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudcapacitaciones',function(Blueprint $table){
            $table->increments('Id_solicitudcapacitacion');
            //Llave foranea #1
            $table->integer('Id_tipocapacitacion')->unsigned();
            $table->foreign('Id_tipocapacitacion')->references('Id_tipocapacitacion')->on ('tipocapacitaciones');
            
            //Llave forane ESTATUS
            $table->integer('Id_estatus')->unsigned()->nullable();
            $table->foreign('Id_estatus')->references('Id_estatus')->on ('estatuses');
            //llave foranea #2 INCONCLUSA
            $table->integer('id_users');
            $table->string('comentario',255);
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
        Schema::drop('solicitudcapacitaciones');
    }
}
