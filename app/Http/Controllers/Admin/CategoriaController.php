<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoria;

class CategoriaController extends Controller
{

    public function index()
    {
        $categorias = Categoria::orderBy('id', 'DESC')->paginate(10);
        return view('backend.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('backend.categorias.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Categoria::create($attributes);
        Toastr()->success('Tipo de Trabajo creado exitosamente');
        return redirect()->route('categorias.index');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('backend.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $categoria->update($attributes);
        Toastr()->success('Tipo de Trabajo actualizado exitosamente');
        return redirect()->route('categorias.index');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        Toastr()->success('Tipo de Trabajo eliminado exitosamente');
        return redirect()->route('categorias.index');
    }

}
