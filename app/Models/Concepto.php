<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;
    
    protected $table = 'MP_CONCEPTO';
    protected $primaryKey = 'MP_CON_ID';
 
    public $timestamps = false;   

}
