<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class users extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey = 'id_users';
    protected $fillable = ['id_users','nombre','app','apm','fecha','sexo','email','pass'
                          ,'celular','curp','ine','direccion','cp','croquis'
                          ,'constanciadomicilio','cargo','tipo_user','id_localidades','update_at'
                          ,'deleted_at','constanciaproductor','nombrerepresentante'
                          ,'direccioninstitucion','nombramiento']; 
}
