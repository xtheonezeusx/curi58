<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cuenta;
use App\Grupo;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::orderBy('id', 'DESC')->paginate(5);
        return view('backend.cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        $grupos = Grupo::all();
        return view('backend.cuentas.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'banco' => 'required',
            'numero' => 'required',
            'grupo' => 'required',
        ]);

        Cuenta::create([
            'banco' => $request->banco,
            'numero' => $request->numero,
            'grupo_id' => $request->grupo,
        ]);
        Toastr()->success('Cuenta creada exitosamente');
        return redirect()->route('cuentas.index');
    }

    public function edit($id)
    {
        $grupos = Grupo::all();
        $cuenta = Cuenta::findOrFail($id);
        return view('backend.cuentas.edit', compact('cuenta', 'grupos'));
    }

    public function update(Request $request, $id)
    {
        $cuenta = Cuenta::findOrFail($id);

        $attributes = $request->validate([
            'banco' => 'required',
            'numero' => 'required',
            'grupo' => 'required',
        ]);

        $cuenta->update([
            'banco' => $request->banco,
            'numero' => $request->numero,
            'grupo_id' => $request->grupo,
        ]);
        Toastr()->success('Cuenta actualizada exitosamente');
        return redirect()->route('cuentas.index');
    }

    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->delete();
        Toastr()->success('Cuenta eliminada exitosamente');
        return redirect()->route('cuentas.index');
    }
}
