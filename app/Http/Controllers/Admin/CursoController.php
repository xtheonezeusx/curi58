<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institucion;
use App\Facultad;
use App\Curso;
use DataTables;
use Validator;

class CursoController extends Controller
{
    public function getCursos($institucion, $facultad)
    {
        $facultad = Facultad::findOrFail($facultad);
        $cursos = Curso::select('id', 'nombre')->where('facultad_id', $facultad->id);
        return DataTables::of($cursos)
        ->addColumn('action', function($curso) {
                return '
                        <a href="#" class="btn btn-sm btn-secondary mostrar" id="' . $curso->id . '"><i class="fas fa-eye"></i> Mostrar</a>
                        <a href="#" class="btn btn-sm btn-primary edit" id="' . $curso->id . '"><i class="fas fa-edit"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger delete" id="' . $curso->id . '"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        ';
            })
        ->make(true);
    }

    public function create(Request $request, $institucion, $facultad)
    {   

        $facultad = Facultad::findOrFail($facultad);

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
            Curso::create([
                'nombre' => $request->nombre,
                'facultad_id' => $facultad->id,
            ]);

            $message = 'Curso creado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function getCurso($institucion, $facultad, $curso)
    {
        $curso = Curso::findOrFail($curso);
        return $curso;
    }

    public function update(Request $request, $institucion, $facultad, $curso)
    {
        $facultad = Facultad::findOrFail($facultad);
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
            $curso->update([
                'nombre' => $request->nombre,
            ]);

            $message = 'Curso actualizado exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function destroy($institucion, $facultad, $curso)
    {
        $curso = Curso::findOrFail($curso);
        $curso->delete();
        return 'Curso eliminado exitosamente.';
    }

    public function show($institucion, $facultad, $curso)
    {   
        $curso = Curso::findOrFail($curso);
        return view('backend.cursos.show', compact('curso'));
    }

    public function getDocentes($curso)
    {
        $curso = Curso::find($curso);
        $output = '<option value="">Seleccione un Docente</option>';
        foreach ($curso->docentes as $docente) {
            $output .= "<option value='" . $docente->id . "'>" . $docente->nombre . "</option>";
        }
        return $output;
    }

    public function cursos()
    {
        return;
    }
}
