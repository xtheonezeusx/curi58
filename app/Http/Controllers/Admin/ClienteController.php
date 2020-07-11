<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Cliente;
use App\User;
use DB;
use App\Facultad;
use App\Institucion;
use Validator;
use Auth;
use App\Grupo;
use App\Categoria;
use App\Tipo;
use App\Sub;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        $instituciones = Institucion::all();
        $grupos = Grupo::all();
        $tipos = Tipo::all();
        $clientes = Cliente::all();
        $subs = Sub::all();
        return view('backend.clientes.index', compact('instituciones', 'grupos', 'tipos', 'clientes', 'categorias', 'subs'));
    }

    public function getClientes(Request $request)
    {
        if(request()->ajax()) {
        if ($request->grupo) {
            $clientes = DB::table('clientes')
            ->join('users', 'clientes.user_id', '=', 'users.id')
            ->join('instituciones', 'clientes.institucion_id', '=', 'instituciones.id')
            ->join('facultades', 'clientes.facultad_id', '=', 'facultades.id')
            ->join('grupos', 'clientes.grupo_id', '=', 'grupos.id')
            ->join('tipos', 'clientes.tipo_id', '=', 'tipos.id')
            ->select('clientes.id', 'clientes.nombre', 'clientes.dni', 'clientes.celular', 'instituciones.nombre as nombre_institucion', 'facultades.nombre as nombre_facultad', 'users.name as nombre_usuario', 'grupos.nombre as nombre_grupo', 'tipos.nombre as nombre_tipo')
            ->where('grupos.id', $request->grupo)
            ->get();
        } else {
            $clientes = DB::table('clientes')
            ->join('users', 'clientes.user_id', '=', 'users.id')
            ->join('instituciones', 'clientes.institucion_id', '=', 'instituciones.id')
            ->join('facultades', 'clientes.facultad_id', '=', 'facultades.id')
            ->join('grupos', 'clientes.grupo_id', '=', 'grupos.id')
            ->join('tipos', 'clientes.tipo_id', '=', 'tipos.id')
            ->select('clientes.id', 'clientes.nombre', 'clientes.dni', 'clientes.celular', 'instituciones.nombre as nombre_institucion', 'facultades.nombre as nombre_facultad', 'users.name as nombre_usuario', 'grupos.nombre as nombre_grupo', 'tipos.nombre as nombre_tipo')
            ->get();
        }
        }        

        return DataTables::of($clientes)
            ->addColumn('action', function($cliente) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item btn-success trabajo" id="' . $cliente->id . '"><i class="fas fa-book"></i> Nuevo Trabajo</a>
                                <a href="#" class="dropdown-item btn-primary edit" id="' . $cliente->id . '"><i class="fas fa-edit"></i> Editar</a>
                                <a href="#" class="dropdown-item btn-danger delete" id="' . $cliente->id . '"><i class="fas fa-trash"></i> Eliminar</a>
                            </div>
                        </div>';
            })
            ->make(true);
    }

    public function getFacultades($id)
    {
        $institucion = Institucion::find($id);
        $output = '<option value="">Seleccione una facultad</option>';
        foreach ($institucion->facultades as $facultad) {
            $output .= "<option value='" . $facultad->id . "'>" . $facultad->nombre . "</option>";
        }
        return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'dni' => 'required',
            'celular' => 'required',
            'institucion' => 'required',
            'facultad' => 'required',
            'tipo' => 'required',
            'grupo' => 'required',
        ]);
        
        $errors = array();
        $message = '';

        if ($validator->fails())
        {
            foreach ($validator->errors()->all() as $error)
            {
                $errors[] = $error;
            }
        }
        else
        {
            Cliente::create([
                'nombre' => $request->nombre,
                'dni' => $request->dni,
                'celular' => $request->celular,
                'institucion_id' => $request->institucion,
                'facultad_id' => $request->facultad,
                'user_id' => Auth::user()->id,
                'grupo_id' => $request->grupo,
                'tipo_id' => $request->tipo,
            ]);

            $message = 'Cliente creado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'dni' => 'required',
            'celular' => 'required',
            'institucion' => 'required',
            'facultad' => 'required',
            'tipo' => 'required',
            'grupo' => 'required',
        ]);
        
        $errors = array();
        $message = '';

        $cliente = Cliente::find($id);

        if ($validator->fails())
        {
            foreach ($validator->errors()->all() as $error)
            {
                $errors[] = $error;
            }
        }
        else
        {
            $cliente->update([
                'nombre' => $request->nombre,
                'dni' => $request->dni,
                'celular' => $request->celular,
                'institucion_id' => $request->institucion,
                'facultad_id' => $request->facultad,
                'tipo_id' => $request->tipo,
                'grupo_id' => $request->grupo,
            ]);

            $message = 'Cliente actualizado correctamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return "Cliente eliminado exitosamente";
    }
}
