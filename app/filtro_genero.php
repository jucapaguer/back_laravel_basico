<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filtro_genero extends Model
{
    protected $table = 'filtro_genero';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}