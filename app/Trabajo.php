<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = [
        'descripcion', 'fecha_entrega', 'archivo', 'estado', 'cliente_id', 'categoria_id', 'curso_id', 'docente_id', 'user_id', 'desarrollador_id', 'observacion', 'archivo_final', 'precio', 'adelanto', 'sub_id', 'envio_id', 'ciclo_id',
    ];

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function desarrollador()
    {
        return $this->belongsTo('App\User');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function sub()
    {
        return $this->belongsTo('App\Sub');
    }

    public function envio()
    {
        return $this->belongsTo('App\Envio');
    }

    public function salida()
    {
        return $this->hasOne('App\Salida');
    }

    public function ciclo()
    {
        return $this->belongsTo('App\Ciclo');
    }

}
