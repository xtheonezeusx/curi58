<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }
}
