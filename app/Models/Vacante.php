<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    
    protected $table = 'MP_VACANTES';
    protected $primaryKey = 'MP_VAC_ID';
 
    public $timestamps = false;   

    
    function local(){
        return $this->hasOne(Local::class,'MP_LOC_ID','MP_LOC_ID');
    }
    
    function nivel(){
        return $this->hasOne(Nivel::class,'MP_NIV_ID','MP_NIV_ID');
    }
    
    function anio(){
        return $this->hasOne(AnioAcademico::class,'MP_ANIO_ID','MP_ANIO_ID');
    }
    
    function grado(){
        return $this->hasOne(Grado::class,'MP_GRA_ID','MP_GRAD_ID');
    }
    
    function seccion(){
        return $this->hasOne(Seccion::class,'MP_SEC_ID','MP_SEC_ID');
    }
}
