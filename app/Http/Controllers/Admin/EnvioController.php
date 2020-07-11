<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Envio;

class EnvioController extends Controller
{

    public function index()
    {
        $envios = Envio::orderBy('id', 'DESC')->paginate(6);
        return view('backend.envios.index', compact('envios'));
    }

    public function create()
    {
        return view('backend.envios.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Envio::create($attributes);
        Toastr()->success('Envio creado exitosamente');
        return redirect()->route('envios.index');
    }

    public function edit($id)
    {
        $envio = Envio::findOrFail($id);
        return view('backend.envios.edit', compact('envio'));
    }

    public function update(Request $request, $id)
    {
        $envio = Envio::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $envio->update($attributes);
        Toastr()->success('Tipo de Envio actualizado exitosamente');
        return redirect()->route('envios.index');
    }

    public function destroy($id)
    {
        $envio = Envio::findOrFail($id);
        $envio->delete();
        Toastr()->success('Tipo de Envio eliminado exitosamente');
        return redirect()->route('envios.index');
    }

}
