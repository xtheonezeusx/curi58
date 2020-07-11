<?php

use Illuminate\Database\Seeder;
use App\Sub;

class SubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sub::create([
            'nombre' => 'Vídeo',
        ]);
        Sub::create([
            'nombre' => 'Foro',
        ]);
        Sub::create([
            'nombre' => 'Tarea',
        ]);
        Sub::create([
            'nombre' => 'Tarea Grupal',
        ]);
        Sub::create([
            'nombre' => 'Tarea Vídeo',
        ]);
        Sub::create([
            'nombre' => 'Evaluación',
        ]);
        Sub::create([
            'nombre' => 'Aún no sale',
        ]);
        Sub::create([
            'nombre' => 'Foro R',
        ]);
        Sub::create([
            'nombre' => 'Autoevaluación',
        ]);
        Sub::create([
            'nombre' => 'Examen Presencial',
        ]);
    }
}
