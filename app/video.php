<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    protected $table = 'videos';
    protected $fillable = [
        'id_tipo_video',
        'id_artista',
        'id_genero',
        'id_instrumento',
        'id_tipo',
        'nombre',
        'descripcion',
        'url'
    ];
    protected $primaryKey = 'id';
}
