<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ciclo;

class CicloController extends Controller
{
    public function index()
    {
        $ciclos = Ciclo::orderBy('id', 'DESC')->paginate(6);
        return view('backend.ciclos.index', compact('ciclos'));
    }

    public function create()
    {
        return view('backend.ciclos.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Ciclo::create($attributes);
        Toastr()->success('Ciclo creado exitosamente');
        return redirect()->route('ciclos.index');
    }

    public function edit($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('backend.ciclos.edit', compact('ciclo'));
    }

    public function update(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $ciclo->update($attributes);
        Toastr()->success('Ciclo actualizado exitosamente');
        return redirect()->route('ciclos.index');
    }

    public function destroy($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $ciclo->delete();
        Toastr()->success('Ciclo eliminado exitosamente');
        return redirect()->route('ciclos.index');
    }
}
