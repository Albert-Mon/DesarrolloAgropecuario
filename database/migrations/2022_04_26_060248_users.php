<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_users');
            $table->string('nombre',255);
            $table->string('app',255)->nullable();
            $table->string('apm',255)->nullable();
            $table->date('fecha')->nullable();
            $table->string('sexo',1)->nullable();
            $table->string('email');
            $table->string('pass');
            $table->string('celular',10)->nullable();
            $table->string('curp',255)->nullable();
            $table->string('ine',255)->nullable();
            $table->string('direccion',255)->nullable();
            $table->string('cp',5)->nullable();
            $table->string('croquis',255)->nullable();
            $table->string('constanciadomicilio',255)->nullable();

            $table->string('tipo_user',255)->nullable();

            //para llaves foraneas
            $table->integer('id_localidades')->unsigned()->nullable();
            $table->foreign('id_localidades')->references('id_localidades')->on('localidades');

            $table->string('constanciaproductor',255)->nullable();
            $table->string('direccioninstitucion',255)->nullable();
            $table->string('nombrerepresentante',255)->nullable();
            $table->string('nombramiento',255)->nullable();
            $table->string('cargo',255)->nullable();
            
            $table->remembertoken();
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
        Schema::dropIfExists('users');
    }
}
