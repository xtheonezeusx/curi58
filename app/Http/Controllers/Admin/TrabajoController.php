<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trabajo;
use Validator;
use Auth;
use DataTables;
use DB;
use App\Categoria;
use App\Facultad;
use App\Curso;
use File;
use App\Cliente;
use App\User;
use App\Envio;
use App\Salida;
use App\Sub;

class TrabajoController extends Controller
{

    public function index()
    {
        $users = User::all();
        $subs = Sub::all();
        $categorias = Categoria::all();
        return view('backend.trabajos.index', compact('categorias', 'users', 'subs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
            'archivo' => 'required|mimes:doc,docx,pdf',
            'categoria' => 'required',
            'subtipo' => 'required',
            'precio' => 'required|integer',
            'adelanto' => 'required|integer',
            'fecha_entrega' => 'required',
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
            $path = $request->file('archivo')->store('trabajos');
            Trabajo::create([
                'descripcion' => $request->descripcion,
                'fecha_entrega' => $request->fecha_entrega,
                'archivo' => $path,
                'estado' => "sin_asignar",
                'cliente_id' => $request->cliente_id,
                'categoria_id' => $request->categoria,
                'sub_id' => $request->subtipo,
                'precio' => $request->precio,
                'adelanto' => $request->adelanto,
                'curso_id' => $request->curso,
                'docente_id' => $request->docente,
                'user_id' => Auth::user()->id,
                'ciclo_id' => $request->session()->get('ciclo_id'),
            ]);

            $message = 'Trabajo creado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function getTrabajos(Request $request)
    {
        $trabajos = DB::table('trabajos')
            ->join('users', 'trabajos.user_id', '=', 'users.id')
            ->leftjoin('cursos', 'trabajos.curso_id', '=', 'cursos.id')
            ->leftjoin('docentes', 'trabajos.docente_id', '=', 'docentes.id')
            ->join('clientes', 'trabajos.cliente_id', '=', 'clientes.id')
            ->join('categorias', 'trabajos.categoria_id', '=', 'categorias.id')
            ->join('subs', 'trabajos.sub_id', '=', 'subs.id')
            ->select('trabajos.id', 'trabajos.fecha_entrega', 'trabajos.archivo', 'clientes.nombre as cliente', 'cursos.nombre as curso', 'docentes.nombre as docente', 'users.name as user', 'categorias.nombre as categoria', 'subs.nombre as subtipo', 'trabajos.precio', 'trabajos.adelanto')->where('trabajos.estado', 'sin_asignar')->where('ciclo_id', $request->session()->get('ciclo_id'))->get();
        return DataTables::of($trabajos)
        ->editColumn('curso', function ($trabajo) {
            if ($trabajo->curso == null) return '<span class="badge badge-info">No definido</span>';
            return $trabajo->curso;
        })
        ->editColumn('docente', function ($trabajo) {
            if ($trabajo->docente == null) return '<span class="badge badge-info">No definido</span>';
            return $trabajo->docente;
        })
        ->editColumn('archivo', function ($trabajo) {
            return '<a href="' . asset($trabajo->archivo) . '" target="_blank">Descargar</a>';
        })
        ->addColumn('action', function($trabajo) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item btn-success asignar" id="' . $trabajo->id . '"><i class="fas fa-book"></i> Asignar</a>
                                <a href="#" class="dropdown-item btn-primary edit" id="' . $trabajo->id . '"><i class="fas fa-edit"></i> Editar</a>
                                <a href="#" class="dropdown-item btn-danger anular" id="' . $trabajo->id . '"><i class="fas fa-trash-alt"></i> Anular</a>
                            </div>
                        </div>';
            })
        ->rawColumns(['curso', 'docente', 'archivo', 'action'])
        ->make(true);
    }

    public function update(Request $request, $trabajo)
    {
        $trabajo = Trabajo::findOrFail($trabajo);
        $path = $trabajo->archivo;

        $validator = Validator::make($request->all(), [
            'fecha_entrega' => 'required',
            'categoria' => 'required',
        ]);

        $errors = array();
        $message = '';

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
        } else {
            if ($request->hasFile('archivo')) {
                File::delete($trabajo->archivo);
                $path = $request->archivo->store('trabajos');
            }
            $trabajo->update([
                'fecha_entrega' => $request->fecha_entrega,
                'categoria_id' => $request->categoria,
                'sub_id' => $request->subtipo,
                'curso_id' => $request->curso,
                'docente_id' => $request->docente,
                'archivo' => $path,
                'precio' => $request->precio,
                'adelanto' => $request->adelanto,
            ]);

            $message = 'Trabajo actualizado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function anular($trabajo)
    {
        $trabajo = Trabajo::find($trabajo);
        $trabajo->update([
            'estado' => 'anulado',
        ]);
        return 'El trabajo ha sido anulado';
    }

    public function getTrabajo($trabajo)
    {
        $trabajo = Trabajo::find($trabajo);
        return $trabajo;
    }

    public function getFacultad($curso)
    {
        $curso = Curso::find($curso);
        $facultad = $curso->facultad;
        return $facultad;
    }

    public function getFacu($cliente)
    {
        $cliente = Cliente::find($cliente);
        $facultad = $cliente->facultad;
        return $facultad;
    }

    public function asignar(Request $request, $trabajo, $user)
    {
        $trabajo = Trabajo::findOrFail($trabajo);

        $validator = Validator::make($request->all(), [
            'desarrollador' => 'required',
        ]);

        $errors = array();
        $message = '';

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
        } else {

            $trabajo->update([
                'estado' => 'asignado',
                'desarrollador_id' => $user,
            ]);

            $message = 'Trabajo asignado correctamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function asignados(Request $request)
    {
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'asignado')->where('ciclo_id', $request->session()->get('ciclo_id'))->paginate(10);
        $trabajosd = DB::table('trabajos')
                        ->join('users', 'users.id', '=', 'trabajos.desarrollador_id')
                        ->select('users.*', DB::raw('count(*) as cantidad'))
                        ->groupBy('users.id')
                        ->where('trabajos.estado', '=', 'asignado')
                        ->where('trabajos.ciclo_id', '=', $request->session()->get('ciclo_id'))
                        ->get();
        return view('backend.trabajos.asignados', compact('trabajos', 'trabajosd'));
    }

    public function mis_asignados(Request $request)
    {
        $user = Auth::user();
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'asignado')->where('ciclo_id', $request->session()->get('ciclo_id'))->where('desarrollador_id', $user->id)->paginate(10);
        return view('backend.trabajos.mis_asignados', compact('trabajos'));
    }

    public function culminar($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        return view('backend.trabajos.culminar', compact('trabajo'));
    }

    public function finalizar(Request $request, $id)
    {
        $trabajo = Trabajo::findOrFail($id);
        
        $request->validate([
            'archivo' => 'required|mimes:doc,docx,pdf',
        ]);

        if ($trabajo->archivo_final === NULL) {

            $path = $request->archivo->store('culminados');

            $trabajo->update([
                'observacion' => $request->observacion,
                'archivo_final' => $path,
                'estado' => 'control',
            ]);
        } else {
            File::delete($trabajo->archivo_final);
            $path = $path = $request->archivo->store('culminados');
            $trabajo->update([
                'observacion' => $request->observacion,
                'archivo_final' => $path,
                'estado' => 'control',
            ]);
        }

        Toastr()->success('El trabajo fue enviado a Control de Calidad');
        return redirect()->route('trabajos.mis_asignados');

    }

    public function control(Request $request)
    {
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'control')->where('ciclo_id', $request->session()->get('ciclo_id'))->paginate(10);
        return view('backend.trabajos.control', compact('trabajos'));
    }

    public function aprobar($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->update([
            'estado' => 'aprobado',
        ]);
        Toastr()->success('El trabajo fue aprobado exitosamente');
        return redirect()->route('trabajos.control');
    }

    public function salida(Request $request)
    {
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'aprobado')->where('ciclo_id', $request->session()->get('ciclo_id'))->paginate(10);
        return view('backend.trabajos.salida', compact('trabajos'));
    }

    public function devolver($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        return view('backend.trabajos.devolver', compact('trabajo'));
    }

    public function entregar(Request $request, $id)
    {
        $request->validate([
            'observacion' => 'required',
        ]);

        $trabajo = Trabajo::findOrFail($id);
        $trabajo->update([
            'estado' => 'asignado',
            'observacion' => $request->observacion,
        ]);
        Toastr()->success('El trabajo fue devuelto exitosamente');
        return redirect()->route('trabajos.control');
    }

    public function modificar($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $trabajosd = DB::table('trabajos')
                        ->join('users', 'users.id', '=', 'trabajos.desarrollador_id')
                        ->select('users.*', DB::raw('count(*) as cantidad'))
                        ->groupBy('users.id')
                        ->where('trabajos.estado', '=', 'asignado')
                        ->get();
        $users = User::all();
        return view('backend.trabajos.modificar', compact('trabajo', 'users', 'trabajosd'));
    }

    public function desarrollador(Request $request, $id)
    {
        $request->validate([
            'desarrollador' => 'required',
        ]);

        $trabajo = Trabajo::findOrFail($id);
        $trabajo->update([
            'desarrollador_id' => $request->desarrollador,
            'estado' => 'asignado',
        ]);

        Toastr()->success('Desarrollador asignado exitosamente');
        return redirect()->route('trabajos.asignados');
    }

    public function darSalida($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $envios = Envio::all();

        return view('backend.trabajos.darSalida', compact('trabajo', 'envios'));
    }

    public function enviar(Request $request, $id)
    {   
        $request->validate([
            'envio' => 'required',
        ]);

        $trabajo = Trabajo::findOrFail($id);
        $trabajo->update([
            'envio_id' => $request->envio,
            'estado' => 'enviado',
        ]);

        Salida::create([
            'estado' => 'sin_cobrar',
            'trabajo_id' => $trabajo->id,
            'ciclo_id' => $request->session()->get('ciclo_id'),
        ]);

        Toastr()->success('Trabajo enviado exitosamente');
        return redirect()->route('salidas.sin_cobrar');

    }

    public function enviados(Request $request)
    {
        $trabajos = Trabajo::orderBy('id', 'DESC')->where('estado', 'enviado')->where('ciclo_id', $request->session()->get('ciclo_id'))->paginate(10);
        return view('backend.trabajos.enviados', compact('trabajos'));

    }
}
