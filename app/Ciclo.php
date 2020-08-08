<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }

    public function salidas()
    {
        return $this->hasMany('App\Salida');
    }
}
