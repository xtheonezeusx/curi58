<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function comprobantes()
    {
        return $this->hasMany('App\Comprobante');
    }
}
