<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Salida;
use App\Comprobante;
use App\Pago;
use App\Cuenta;
use File;

class ComprobanteController extends Controller
{
    public function show($id)
    {
        $salida = Salida::findOrFail($id);
        $comprobantes = Comprobante::orderBy('id', 'DESC')->where('salida_id', $salida->id)->get();
        return view('backend.comprobantes.show', compact('comprobantes', 'salida'));
    }

    public function edit($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $pagos = Pago::all();
        $cuentas = Cuenta::all();
        return view('backend.comprobantes.edit', compact('comprobante', 'pagos', 'cuentas'));
    }

    public function update(Request $request, $id)
    {

        $comprobante = Comprobante::findOrFail($id);

        $request->validate([
            'pago' => 'required',
            'cuenta' => 'required',
            'numero' => 'required',
            'fecha' => 'required',
            'monto' => 'required',
            'archivo' => 'mimes:jpeg,bmp,png',
        ]);

        $path = $comprobante->archivo;

        if ($request->hasFile('archivo')) {
            $path = $request->archivo->store('comprobantes');
            File::delete($comprobante->archivo);
        }

        $comprobante->update([
            'numero' => $request->numero,
            'fecha_pago' => $request->fecha,
            'monto' => $request->monto,
            'archivo' => $path,
            'pago_id' => $request->pago,
            'cuenta_id' => $request->cuenta,
        ]);

        $salida = $comprobante->salida->id;

        Toastr()->success('Comprobante actualizado correctamente');
        return redirect()->route('comprobantes.show', $salida);
        
    }

    public function destroy($id)
    {
        $comprobante = Comprobante::findOrFail($id);

        $salida = $comprobante->salida->id;

        File::delete($comprobante->archivo);
        $comprobante->delete();

        Toastr()->success('Comprobante eliminado correctamente');
        return redirect()->route('comprobantes.show', $salida);
    }
    
}
