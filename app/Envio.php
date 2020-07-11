<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }
}
