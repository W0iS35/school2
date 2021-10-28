<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    
    protected $table = 'MP_LOCAL';
    protected $primaryKey = 'MP_LOC_ID';
 
    public $timestamps = false;   

}
