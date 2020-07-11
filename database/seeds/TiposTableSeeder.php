<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            'nombre' => 'Presencial',
        ]);
        Tipo::create([
            'nombre' => 'Gente que Trabaja',
        ]);
        Tipo::create([
            'nombre' => 'Semi Presencial',
        ]);
        Tipo::create([
            'nombre' => 'Multimodal',
        ]);
    }
}
