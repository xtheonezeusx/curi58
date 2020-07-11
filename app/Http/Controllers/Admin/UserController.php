<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('backend.usuarios.index', compact('users'));
    }

    public function create()
    {
        return view('backend.usuarios.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.usuarios.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $attributtes = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'cellphone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $hash = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'password' => $hash,
        ]);

        Toastr()->success('Usuario creado exitosamente.');
        return redirect()->route('usuarios.index');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $attributtes = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'cellphone' => 'required',
        ]);

        $user->update($attributtes);

        Toastr()->success('Usuario actualizado exitosamente.');
        return redirect()->route('usuarios.index');

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Toastr()->success('Usuario eliminado exitosamente.');
        return redirect()->route('usuarios.index');
    }
}
