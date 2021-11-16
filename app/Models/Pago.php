<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'MP_PAGO';
    protected $primaryKey = 'MP_PAGO_ID';

    public function usuario(){
        return $this->belongsTo(User::class, 'USU_ID', 'USU_ID');
    }

}
