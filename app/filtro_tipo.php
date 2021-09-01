<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filtro_tipo extends Model
{
    protected $table = 'filtro_tipo';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}