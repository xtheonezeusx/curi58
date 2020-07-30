<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $permissions = ['listar usuarios', 'crear usuario', 'editar usuario', 'eliminar usuario', 'listar clientes', 'crear cliente', 'editar cliente', 'eliminar cliente', 'asignar trabajo', 'listar trabajos-sin-asignar', 'asignar trabajo-sin-asignar', 'editar trabajo-sin-asignar', 'anular trabajo-sin-asignar', 'listar trabajos-asignados', 'listar mis-trabajos-asignados', 'culminar mi-trabajo-asignado', 'listar trabajos-control-calidad', 'aprobar trabajos-control-calidad', 'devolver trabajos-control-calidad', 'listar trabajos-para-salida', 'dar salida-trabajo', 'listar trabajos-enviados', 'listar salidas-sin-cobrar', 'cobrar salidas-sin-cobrar', 'listar salidas-cobradas', 'ver-archivos salidas-cobradas'];
        $role->syncPermissions($permissions);
    }
}
