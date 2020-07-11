<?php

use Illuminate\Database\Seeder;
use App\Grupo;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            'nombre' => 'Aprueba',
        ]);
        Grupo::create([
            'nombre' => 'Plataforma',
        ]);
        Grupo::create([
            'nombre' => 'Universo',
        ]);
    }
}
