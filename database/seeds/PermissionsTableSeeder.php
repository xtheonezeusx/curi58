<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'listar usuarios']);
        Permission::create(['name' => 'crear usuario']);
        Permission::create(['name' => 'editar usuario']);
        Permission::create(['name' => 'eliminar usuario']);

        Permission::create(['name' => 'listar clientes']);
        Permission::create(['name' => 'crear cliente']);
        Permission::create(['name' => 'editar cliente']);
        Permission::create(['name' => 'eliminar cliente']);
        Permission::create(['name' => 'asignar trabajo']);

        Permission::create(['name' => 'listar trabajos-sin-asignar']);
        Permission::create(['name' => 'asignar trabajo-sin-asignar']);
        Permission::create(['name' => 'editar trabajo-sin-asignar']);
        Permission::create(['name' => 'anular trabajo-sin-asignar']);

        Permission::create(['name' => 'listar trabajos-asignados']);

        Permission::create(['name' => 'listar mis-trabajos-asignados']);
        Permission::create(['name' => 'culminar mi-trabajo-asignado']);

        Permission::create(['name' => 'listar trabajos-control-calidad']);
        Permission::create(['name' => 'aprobar trabajos-control-calidad']);
        Permission::create(['name' => 'devolver trabajos-control-calidad']);

        Permission::create(['name' => 'listar trabajos-para-salida']);
        Permission::create(['name' => 'dar salida-trabajo']);

        Permission::create(['name' => 'listar trabajos-enviados']);

        Permission::create(['name' => 'listar salidas-sin-cobrar']);
        Permission::create(['name' => 'cobrar salidas-sin-cobrar']);

        Permission::create(['name' => 'listar salidas-cobradas']);
        Permission::create(['name' => 'ver-archivos salidas-cobradas']);
    }
}
