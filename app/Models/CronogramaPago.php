<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronogramaPago extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'MP_CRONOGRAMAPAGO';
    protected $primaryKey = 'MP_CRO_ID';

}
