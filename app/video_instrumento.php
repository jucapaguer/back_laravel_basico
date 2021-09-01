<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video_instrumento extends Model
{
    protected $table = 'video_instrumento';
    protected $fillable = [
        'id_video',
        'descripcion',
        'url'
    ];
    protected $primaryKey = 'id';
}
