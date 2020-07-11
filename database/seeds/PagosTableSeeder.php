<?php

use Illuminate\Database\Seeder;
use App\Pago;

class PagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pago::create([
            'nombre' => 'Ninguno',
        ]);
        Pago::create([
            'nombre' => 'Depósito',
        ]);
        Pago::create([
            'nombre' => 'Transferencia',
        ]);
        Pago::create([
            'nombre' => 'Efectivo',
        ]);
        Pago::create([
            'nombre' => 'Giro',
        ]);
        Pago::create([
            'nombre' => 'Banca Móvil',
        ]);
        Pago::create([
            'nombre' => 'Yape',
        ]);
        Pago::create([
            'nombre' => 'Wester Union',
        ]);
    }
}
