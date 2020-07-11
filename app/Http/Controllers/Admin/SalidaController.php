<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Salida;
use App\Pago;
use App\Cuenta;
use App\Comprobante;
use DB;

class SalidaController extends Controller
{
    public function sin_cobrar()
    {
        $salidas = Salida::orderBy('id', 'DESC')->where('estado', 'sin_cobrar')->paginate(10);
        return view('backend.salidas.sin_cobrar', compact('salidas'));
    }

    public function cobrar($id)
    {
        $salida = Salida::FindOrFail($id);
        $cuentas = Cuenta::all();
        $pagos = Pago::all();
        return view('backend.salidas.cobrar', compact('salida', 'cuentas', 'pagos'));
    }

    public function comprobantes(Request $request, $id)
    {

        $salida = Salida::findOrFail($id); 

        $request->validate([
            'pago' => 'required',
            'cuenta' => 'required',
            'numero' => 'required',
            'fecha' => 'required',
            'monto' => 'required',
            'archivo' => 'required|mimes:jpeg,bmp,png',
        ]);

        $path = $request->archivo->store('comprobantes');

        Comprobante::create([
            'numero' => $request->numero,
            'fecha_pago' => $request->fecha,
            'monto' => $request->monto,
            'archivo' => $path,
            'pago_id' => $request->pago,
            'cuenta_id' => $request->cuenta,
            'salida_id' => $salida->id,
        ]);

        $salida->update([
            'estado' => 'cobrado',
        ]);

        Toastr()->success('Salida cobrada correctamente');
        return redirect()->route('salidas.cobradas');
    }

    public function cobradas()
    {

        $salidas = Salida::orderBy('id', 'DESC')->where('estado', 'cobrado')->paginate(10);

        return view('backend.salidas.cobradas', compact('salidas'));
    }

}
