<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'MP_TIPOCOMPROBANTE';
    protected $primaryKey = 'MP_TIPCOM_ID';

    // Hola mundo
    // asas

}
