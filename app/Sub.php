<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }
}
