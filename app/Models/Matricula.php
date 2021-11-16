<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'MP_MATRICULA';
    protected $primaryKey = 'MP_MAT_ID';

    public function vacante(){
        return $this->hasOne(Vacante::class, 'MP_VAC_ID','MP_VAC_ID');
    }

    public function cronogramaPago(){
        return $this->hasMany(CronogramaPago::class, 'MP_MAT_ID', 'MP_MAT_ID');
    }

    public function pago(){
        return $this->hasMany(Pago::class, 'MP_MAT_ID', 'MP_MAT_ID');
    }

}
