<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sub;

class SubController extends Controller
{
    public function index()
    {
        $subs = Sub::orderBy('id', 'DESC')->paginate(5);
        return view('backend.subs.index', compact('subs'));
    }

    public function create()
    {
        return view('backend.subs.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Sub::create($attributes);
        Toastr()->success('Subtipo de Trabajo creado exitosamente');
        return redirect()->route('subs.index');
    }

    public function edit($id)
    {
        $sub = Sub::findOrFail($id);
        return view('backend.subs.edit', compact('sub'));
    }

    public function update(Request $request, $id)
    {
        $sub = Sub::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $sub->update($attributes);
        Toastr()->success('Subtipo de Trabajo actualizado exitosamente');
        return redirect()->route('subs.index');
    }

    public function destroy($id)
    {
        $sub = Sub::findOrFail($id);
        $sub->delete();
        Toastr()->success('Subtipo de Trabajo eliminado exitosamente');
        return redirect()->route('subs.index');
    }
}
