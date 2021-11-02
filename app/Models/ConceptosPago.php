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

    public function concepto(){
        return $this->hasOne(Concepto::class,'MP_CON_ID','MP_CON_ID');
    }
    
    public function anio(){
        return $this->hasOne(AnioAcademico::class,'MP_ANIO_ID','MP_ANIO_ID' );
    }
    
    public function nivel(){
        return $this->hasOne(Nivel::class,'MP_NIV_ID','MP_NIV_ID');
    }
    
    
    public function local(){
        return $this->hasOne(Local::class,'MP_LOC_ID','MP_LOC_ID');
    }
}
