<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptosPago extends Model
{
    use HasFactory;
    
    protected $table = 'MP_CONCEPTOPAGO';
    protected $primaryKey = 'MP_CONPAGO_ID';
 
    public $timestamps = false;   

    
}
