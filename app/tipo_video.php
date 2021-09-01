<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_video extends Model
{
    protected $table = 'tipo_videos';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}
