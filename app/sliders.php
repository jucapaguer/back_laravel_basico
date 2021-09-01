<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sliders extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
        'id',
        'tipo',
        'aplicativo',
        'url',
        'opcion',
        
    ];
    protected $primaryKey = 'id';
}
