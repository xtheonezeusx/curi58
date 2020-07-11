<?php

use Illuminate\Database\Seeder;
use App\Envio;

class EnviosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Envio::create([
            'nombre' => 'WhatsApp',
        ]);
        Envio::create([
            'nombre' => 'Correo Electrónico',
        ]);
        Envio::create([
            'nombre' => 'Plataforma',
        ]);
        Envio::create([
            'nombre' => 'Otros',
        ]);
    }
}
