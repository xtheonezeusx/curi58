<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    public function cuentas()
    {
        return $this->hasMany('App\Cuenta');
    }
}
