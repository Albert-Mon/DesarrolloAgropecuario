<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;


class solicitudcapacitaciones extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $primaryKey ='Id_solicitudcapacitacion';
     protected $fillable = ['Id_solicitudcapacitacion','Id_tipocapacitacion','Id_estatus','id_users','comentario'];

}
