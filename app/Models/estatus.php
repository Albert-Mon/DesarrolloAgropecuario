<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatus extends Model
{
    use HasFactory;
    protected $primaryKey ='Id_estatus';
    protected $fillable = ['Id_estatus','nombre_estatus','descripcionestatus'];
}
