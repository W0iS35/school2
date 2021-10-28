<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnioAcademico extends Model
{
    use HasFactory;
    protected $table = 'MP_ANIOACADEMICO';
    protected $primaryKey = 'MP_ANIO_ID';
 
    public $timestamps = false;   

}
