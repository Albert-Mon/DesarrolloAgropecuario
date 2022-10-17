<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Localidades extends Migration
{
   public function up(){
     Schema::create('localidades', function(Blueprint $table){
            $table->increments('id_localidades');
            $table->string('nombre',255);
            $table->remembertoken();
            $table->timestamps();

        });
    }
    public function down()
    {
        Schema::drop('localidades');
    }
}
