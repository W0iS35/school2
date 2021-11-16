<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'MP_ALUMNO';
    protected $primaryKey = 'MP_ALU_ID';

    public function matricula(){
        return $this->hasMany(Matricula::class, 'MP_ALU_ID', 'MP_ALU_ID');
    }


}
