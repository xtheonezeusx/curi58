<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';

    protected $fillable = [
        'nombre',
    ];

    public function facultades()
    {
        return $this->hasMany('App\Facultad');
    }
}
