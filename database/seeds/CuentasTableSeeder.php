<?php

use Illuminate\Database\Seeder;
use App\Cuenta;

class CuentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // aprueba
        Cuenta::create([
            'banco' => 'BBVA Continental',
            'numero' => '0011 0266 0200151035',
            'grupo_id' => 1,
        ]);
        Cuenta::create([
            'banco' => 'Interbank',
            'numero' => '5153092917146',
            'grupo_id' => 1,
        ]);
        Cuenta::create([
            'banco' => 'Scotiabank',
            'numero' => '6740107492',
            'grupo_id' => 1,
        ]);
        Cuenta::create([
            'banco' => 'Banco de la Nacion',
            'numero' => '04 388 561071',
            'grupo_id' => 1,
        ]);
        Cuenta::create([
            'banco' => 'BCP',
            'numero' => '191-34901772-0-13',
            'grupo_id' => 1,
        ]);
        // universo
        Cuenta::create([
            'banco' => 'BBVA Continental',
            'numero' => '0011 0237 0200382241 54',
            'grupo_id' => 3,
        ]);
        Cuenta::create([
            'banco' => 'Interbank',
            'numero' => '5123125586522',
            'grupo_id' => 3,
        ]);
        Cuenta::create([
            'banco' => 'Scotiabank',
            'numero' => '9430173501',
            'grupo_id' => 3,
        ]);
        Cuenta::create([
            'banco' => 'Banco de la Nacion',
            'numero' => '04388710786',
            'grupo_id' => 3,
        ]);
        Cuenta::create([
            'banco' => 'BCP',
            'numero' => '355-90679153-039',
            'grupo_id' => 3,
        ]);
        // plataforma
        Cuenta::create([
            'banco' => 'BBVA Continental',
            'numero' => '0011 0057 0210228463',
            'grupo_id' => 2,
        ]);
        Cuenta::create([
            'banco' => 'Interbank',
            'numero' => '5123140976639',
            'grupo_id' => 2,
        ]);
        Cuenta::create([
            'banco' => 'Scotiabank',
            'numero' => '943-0198037',
            'grupo_id' => 2,
        ]);
        Cuenta::create([
            'banco' => 'Banco de la Nacion',
            'numero' => '04388769012',
            'grupo_id' => 2,
        ]);
        Cuenta::create([
            'banco' => 'BCP',
            'numero' => '35592537875036',
            'grupo_id' => 2,
        ]);
    }
}
