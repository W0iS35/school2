<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    
    protected $table = 'MP_SECCION';
    protected $primaryKey = 'MP_SEC_ID';
 
    public $timestamps = false;   

}
