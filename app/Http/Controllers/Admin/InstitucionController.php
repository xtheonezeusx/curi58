<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institucion;
use App\Facultad;

class InstitucionController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::orderBy('id', 'DESC')->paginate(10);
        return view('backend.instituciones.index', compact('instituciones'));
    }

    public function create()
    {
        return view('backend.instituciones.create');
    }

    public function store(Request $request)
    {
        $attributtes = $request->validate([
            'nombre' => 'required',
        ]);

        Institucion::create($attributtes);

        Toastr()->success('Institución creada exitosamente.');
        return redirect()->route('instituciones.index');
    }

    public function show($id)
    {
        $institucion = Institucion::find($id);
        $facultades = Facultad::orderBy('id', 'DESC')->where('institucion_id', $institucion->id)->paginate(10);
        return view('backend.instituciones.show', compact('institucion', 'facultades'));
    }

    public function edit($id)
    {
        $institucion = Institucion::find($id);
        return view('backend.instituciones.edit', compact('institucion'));
    }

    public function update(Request $request, $id)
    {
        $institucion = Institucion::find($id);
        $attributtes = $request->validate([
            'nombre' => 'required',
        ]);

        $institucion->update($attributtes);

        Toastr()->success('Institución actualizada exitosamente.');
        return redirect()->route('instituciones.index');
    }

    public function destroy($id)
    {
        $institucion = Institucion::find($id);
        $institucion->delete();
        Toastr()->success('Institución eliminada exitosamente.');
        return redirect()->route('instituciones.index');
    }
}
