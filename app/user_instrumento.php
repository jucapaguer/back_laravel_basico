<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_instrumento extends Model
{
    protected $table = 'user_instrumento';
    protected $fillable = [
        'id_user',
        'id_instrumento',
    ];
    protected $primaryKey = 'id';
}
