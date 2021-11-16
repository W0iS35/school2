<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriePago extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'MP_SERIECOMPROBANTE';
    protected $primaryKey = 'MP_SERCOM_ID';

    public function usuario(){
        return $this->hasOne(User::class,'USU_ID', 'USU_ID' );
    }
}
