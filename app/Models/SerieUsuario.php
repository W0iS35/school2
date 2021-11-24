<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieUsuario extends Model
{
    use HasFactory;
    
    protected $table = 'MP_SERIEUSUARIO';
    protected $primaryKey = 'MP_SERUSU_ID';
}
