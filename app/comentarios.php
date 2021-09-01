<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    protected $table = 'comentarios';
    protected $fillable = [
        'id_user',
        'id_video',
        'calificacion',
        'mensaje',
        
    ];
    protected $primaryKey = 'id';
}
