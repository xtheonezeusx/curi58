<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $fillable = [
        'numero', 'monto', 'archivo', 'pago_id', 'cuenta_id', 'salida_id', 'fecha_pago',
    ];

    public function salida()
    {
        return $this->belongsTo('App\Salida');
    }

    public function cuenta()
    {
        return $this->belongsTo('App\Cuenta');
    }

    public function pago()
    {
        return $this->belongsTo('App\Pago');
    }
}
