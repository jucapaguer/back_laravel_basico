<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filtro_artista extends Model
{
    protected $table = 'filtro_artista';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}