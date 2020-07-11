<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = [
        'trabajo_id', 'estado',
    ];

    public function trabajo()
    {
        return $this->belongsTo('App\Trabajo');
    }

    public function comprobantes()
    {
        return $this->hasMany('App\Comprobante');
    }

    
}
