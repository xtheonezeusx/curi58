<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::orderBy('id', 'DESC')->paginate(10);
        return view('backend.tipos.index', compact('tipos'));
    }

    public function create()
    {
        return view('backend.tipos.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Tipo::create($attributes);
        Toastr()->success('Tipo de Cliente creado exitosamente');
        return redirect()->route('tipos.index');
    }

    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        return view('backend.tipos.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $tipo->update($attributes);
        Toastr()->success('Tipo de cliente actualizado exitosamente');
        return redirect()->route('tipos.index');
    }

    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();
        Toastr()->success('Tipo de Cliente eliminado exitosamente');
        return redirect()->route('tipos.index');
    }
}
