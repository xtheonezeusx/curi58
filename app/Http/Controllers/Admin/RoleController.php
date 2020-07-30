<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('backend.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $permisos = $request->permisos;

        $role = Role::create(['name' => $request->nombre]);
        $role->syncPermissions($permisos);

        Toastr()->success('Rol creado exitosamente');
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $permisos = $request->permisos;

        $role->update(['name' => $request->nombre]);
        $role->syncPermissions($permisos);

        Toastr()->success('Rol actualizado exitosamente');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        Toastr()->success('Rol eliminado exitosamente');
        return redirect()->route('roles.index');
    }
}
