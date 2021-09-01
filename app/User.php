<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//JWTSubject 
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'id_rol', 
        'id_plan',
        'nombre', 
        'apellido', 
        'tipo_identificacion', 
        'numero_identificacion', 
        'email', 
        'password',
        'telefono1', 
        'telefono2', 
        'direccion1',
        'direccion2', 
        'congregacion', 
        'instrumentos',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* jwt */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
