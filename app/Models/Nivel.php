<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    
    protected $table = 'MP_NIVEL';
    protected $primaryKey = 'MP_NIV_ID';
 
    public $timestamps = false;   

}
