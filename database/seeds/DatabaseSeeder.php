<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GruposTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EnviosTableSeeder::class);
        $this->call(InstitucionesTableSeeder::class);
        $this->call(FacultadesTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(SubsTableSeeder::class);
        $this->call(PagosTableSeeder::class);
        $this->call(CuentasTableSeeder::class);
    }
}
