<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['url', 'user_id'];

    // relacionamos la tabla users con la tabla file de uno a muchos inversa 
public function users(){
    return $this->belongsTo('App\User');
}
}

