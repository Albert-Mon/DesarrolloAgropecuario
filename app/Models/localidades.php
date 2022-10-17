<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class localidades extends Model
{

    use HasFactory;
    use Softdeletes;
    
    protected $primaryKey = 'id_localidades';
    protected $fillable = ['id_localidades','nombre_localidades']; 

}