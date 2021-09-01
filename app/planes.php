<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planes extends Model
{
    protected $table = 'planes';
    protected $fillable = [
        'nombre',
    ];
    protected $primaryKey = 'id';
}
