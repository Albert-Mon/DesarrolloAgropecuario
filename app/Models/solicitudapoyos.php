<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;


class solicitudapoyos extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $primaryKey ='Id_solicitudapoyo';
     protected $fillable = ['Id_solicitudapoyo','Id_tipoapoyo','Id_estatus','id_users'];
}
