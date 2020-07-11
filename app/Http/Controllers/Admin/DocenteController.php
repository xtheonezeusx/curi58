<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
use App\Curso;
use App\Docente;

class DocenteController extends Controller
{
    public function getDocentes($institucion, $facultad, $curso)
    {
        $curso = Curso::findOrFail($curso);
        $docentes = Docente::select('id', 'nombre')->where('curso_id', $curso->id);
        return DataTables::of($docentes)
        ->addColumn('action', function($docente) {
                return '
                        <a href="#" class="btn btn-sm btn-primary edit" id="' . $docente->id . '"><i class="fas fa-edit"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger delete" id="' . $docente->id . '"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        ';
            })
        ->make(true);
    }

    public function store(Request $request, $institucion, $facultad, $curso)
    {   

        $curso = Curso::findOrFail($curso);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        $errors = array();
        $message = '';

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
        } else {
            Docente::create([
                'nombre' => $request->nombre,
                'curso_id' => $curso->id,
            ]);

            $message = 'Docente creado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function getDocente($institucion, $facultad, $curso, $docente)
    {
        $docente = Docente::find($docente);
        return $docente;
    }

    public function update(Request $request, $institucion, $facultad, $curso, $docente)
    {
        $curso = Curso::findOrFail($curso);
        $docente = Docente::findOrFail($docente);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        $errors = array();
        $message = '';

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
        } else {
            $docente->update([
                'nombre' => $request->nombre,
            ]);

            $message = 'Docente actualizado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function destroy($institucion, $facultad, $curso, $docente)
    {
        $docente = Docente::find($docente);
        $docente->delete();

        return 'Docente eliminado exitosamente';
    }

}
