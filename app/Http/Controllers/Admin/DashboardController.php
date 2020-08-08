<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Hash;
use App\User;
use App\Institucion;
use App\Facultad;
use App\Grupo;
use App\Cliente;
use App\Trabajo;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $instituciones = Institucion::all();
        $facultades = Facultad::all();
        $grupos = Grupo::all();
        $clientes = Cliente::all();

        $user = Auth::user();
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'asignado')->where('ciclo_id', $request->session()->get('ciclo_id'))->where('desarrollador_id', $user->id)->paginate(10);
        
        return view('backend.dashboard', compact('users', 'instituciones', 'facultades', 'grupos', 'clientes', 'trabajos'));
    }

    public function perfil()
    {
        return view('backend.updateProfile');
    }

    public function profile(Request $request)
    {   
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'image' => 'image|mimes:jpeg,bmp,png',
            'cellphone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);

        $path = $user->image;

        if ($request->hasFile('image')) {
            $path = $request->image->store('images/users');
            File::delete($user->image);
        }

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'image' => $path,
        ]);

        Toastr()->success('Usuario actualizado correctamente');
        return redirect()->back();
    }

    public function perfil2()
    {
        return view('backend.updatePassword');
    }

    public function password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = Auth::user();
        $hashedPassword =  $user->password;
        $old_password = $request->old_password;

        if (Hash::check($old_password, $hashedPassword)) {

            if (Hash::check($request->password, $hashedPassword)) {

                Toastr()->error('La nueva contraseña no puede ser la misma.');
                return redirect()->back();
            
            } else {
                $user->fill([
                    'password' => Hash::make($request->password)
                ])->save();

                Toastr()->success('Contraseña actualizada correctamente');
                return redirect()->back();
            }

        } else {
            Toastr()->error('La contraseña actual no coincide.');
            return redirect()->back();
        }

    }
}
