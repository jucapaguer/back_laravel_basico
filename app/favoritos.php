<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favoritos extends Model
{
    protected $table = 'favoritos';
    protected $fillable = [
        'id_user',
        'id_video',
        
    ];
    protected $primaryKey = 'id';
}
