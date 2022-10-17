<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class tipocapacitaciones extends Model
{
    use HasFactory;
    use Softdeletes;
 
    protected $primaryKey ='Id_tipocapacitacion';
    protected $fillable = ['Id_tipocapacitacion','nombretipocapacitacion','categoria','descripciontipocapacitacion',
    'fechainicio','fechafinal','lugar','horario'];
    
}
