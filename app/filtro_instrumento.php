<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filtro_instrumento extends Model
{
    protected $table = 'filtro_instrumento';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}