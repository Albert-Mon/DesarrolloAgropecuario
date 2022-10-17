<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;


class tipoapoyos extends Model
{
    use HasFactory;
    use Softdeletes;
 
     protected $primaryKey ='Id_tipoapoyo';
     protected $fillable = ['Id_tipoapoyo','nombretipoapoyo','descripciontipoapoyo'];
     
}
