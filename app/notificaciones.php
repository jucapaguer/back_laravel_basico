<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notificaciones extends Model
{
    protected $table = 'notificaciones';
    protected $fillable = [
        'id_user',
        'nombre',
        'descripcion',
    ];
    protected $primaryKey = 'id';
}
