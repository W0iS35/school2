<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    
    public $timestamps = false;

    protected $table = 'USUARIO';
    protected $primaryKey = 'USU_ID';
    
    protected $fillable = [
        'USU_NOMBRES',
        'USU_APELLIDOS',
        'USU_USUARIO',
        'USU_CONTRASENIA',
        'USU_CARGO',
        'USU_ESTADO',
        'USU_TIPO',
        'username',
        'password',
    ];

    function serieUsuario(){
        return $this->hasOne(SerieUsuario::class, 'USU_ID','USU_ID');
    }
    
    function serieComprobante(){
        return $this->hasOne(SeriePago::class, 'USU_ID','USU_ID');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
