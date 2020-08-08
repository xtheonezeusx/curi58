<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ciclo;

class PreviewController extends Controller
{
    public function index()
    {
        $ciclos = Ciclo::all();
        return view('preview', compact('ciclos'));
    }

    public function select(Request $request)
    {
        $ciclo = Ciclo::findOrFail($request->ciclo);
        $request->session()->put('ciclo_nombre', $ciclo->nombre);
        $request->session()->put('ciclo_id', $ciclo->id);

        return redirect()->route('dashboard');
    }
}
