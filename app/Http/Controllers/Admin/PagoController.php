<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pago;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::orderBy('id', 'DESC')->paginate(6);
        return view('backend.pagos.index', compact('pagos'));
    }

    public function create()
    {
        return view('backend.pagos.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        Pago::create($attributes);
        Toastr()->success('Tipo de Pago creado exitosamente');
        return redirect()->route('pagos.index');
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        return view('backend.pagos.edit', compact('pago'));
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $attributes = $request->validate([
            'nombre' => 'required',
        ]);

        $pago->update($attributes);
        Toastr()->success('Tipo de Pago actualizado exitosamente');
        return redirect()->route('pagos.index');
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();
        Toastr()->success('Tipo de Pago eliminado exitosamente');
        return redirect()->route('pagos.index');
    }
}
