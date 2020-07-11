<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'banco', 'numero', 'grupo_id',
    ];

    public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }

    public function comprobantes()
    {
        return $this->hasMany('App\Comprobante');
    }
}
