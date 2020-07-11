<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'PA1',
        ]);
        Categoria::create([
            'nombre' => 'PA2',
        ]);
        Categoria::create([
            'nombre' => 'PA3',
        ]);
        Categoria::create([
            'nombre' => 'PA4',
        ]);
        Categoria::create([
            'nombre' => 'Examen Final',
        ]);
        Categoria::create([
            'nombre' => 'Sustitutorio',
        ]);
        Categoria::create([
            'nombre' => 'Actividades Diversas',
        ]);
        Categoria::create([
            'nombre' => 'Examen Presencial',
        ]);
        Categoria::create([
            'nombre' => 'Auto Evaluación',
        ]);
    }
}
