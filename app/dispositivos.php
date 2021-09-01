<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dispositivos extends Model
{
    protected $table = 'dispositivos';
    protected $fillable = [
        'id_user',
        'id_dispositivo',
        'uui_dispositivo',
        'sistema'
        
    ];
    protected $primaryKey = 'id';
}