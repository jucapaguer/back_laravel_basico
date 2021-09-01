<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class terminos extends Model
{
    protected $table = 'terminos';
    protected $fillable = [
        'id_user',
        'accion',

    ];
    protected $primaryKey = 'id';
}
