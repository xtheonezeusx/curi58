<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'nombre', 'curso_id',
    ];

    public function docente()
    {
        return $this->belongsTo('App\Curso');
    }

    public function trabajos()
    {
        return $this->hasMany('App\Trabajo');
    }

}
