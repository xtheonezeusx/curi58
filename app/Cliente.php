<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'dni', 'celular', 'institucion_id', 'facultad_id', 'user_id', 'grupo_id', 'tipo_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Tipo');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }

    public function facultad()
    {
        return $this->belongsTo('App\Facultad');
    }
}
