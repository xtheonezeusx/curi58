<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo;

class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::orderBy('id', 'DESC')->paginate(6);
        return view('backend.grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('backend.grupos.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Grupo::create($attributes);
        Toastr()->success('Grupo creado exitosamente');
        return redirect()->route('grupos.index');
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('backend.grupos.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        $grupo = Grupo::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $grupo->update($attributes);
        Toastr()->success('Grupo actualizado exitosamente');
        return redirect()->route('grupos.index');
    }

    public function destroy($id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->delete();
        Toastr()->success('Grupo eliminado exitosamente');
        return redirect()->route('grupos.index');
    }
}
