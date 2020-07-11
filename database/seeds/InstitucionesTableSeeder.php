<?php

use Illuminate\Database\Seeder;
use App\Institucion;

class InstitucionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institucion::create([
            'nombre' => 'Universidad Continental',
        ]);
    }
}
