<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    
    protected $table = 'MP_GRADO';
    protected $primaryKey = 'MP_GRA_ID';
 
    public $timestamps = false;   

}
