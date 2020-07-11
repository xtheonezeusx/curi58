<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nombre', 'facultad_id',
    ];

    public function facultad()
    {
        return $this->belongsTo('App\Facultad');
    }

    public function docentes()
    {
        return $this->hasMany('App\Docente');
    }

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }
}
