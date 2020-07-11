<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';

    protected $fillable = [
        'nombre', 'institucion_id',
    ];

    public function institucion()
    {
        return $this->belongsTo('App\Institucion');
    }

    public function cursos()
    {
        return $this->hasMany('App\Curso');
    }
}
