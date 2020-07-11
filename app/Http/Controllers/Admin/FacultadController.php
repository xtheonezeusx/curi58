<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institucion;
use App\Facultad;
use DataTables;
use Validator;

class FacultadController extends Controller
{

    public function getFacultades($id)
    {
        $institucion = Institucion::findOrFail($id);
        $facultades = Facultad::select(['id', 'nombre'])->where('institucion_id', $institucion->id);
        return DataTables::of($facultades)
        ->addColumn('action', function($facultad) {
                return '
                        <a href="#" class="btn btn-sm btn-secondary mostrar" id="' . $facultad->id . '"><i class="fas fa-eye"></i> Mostrar</a>
                        <a href="#" class="btn btn-sm btn-primary edit" id="' . $facultad->id . '"><i class="fas fa-edit"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger delete" id="' . $facultad->id . '"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        ';
            })
        ->make(true);
    }

    public function store(Request $request, $id)
    {

        $institucion = Institucion::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
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
            Facultad::create([
                'nombre' => $request->nombre,
                'institucion_id' => $institucion->id,
            ]);

            $message = 'Facultad crada exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function getFacultad($institucion, $facultad)
    {
       $facultad = Facultad::findOrFail($facultad);
        return $facultad;
    }

    public function show($institucion, $facultad)
    {
        $facultad = Facultad::findOrFail($facultad);
        return view('backend.facultades.show', compact('facultad'));
    }

    public function update(Request $request, $institucion, $facultad)
    {
        $facultad = Facultad::findOrFail($facultad);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
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
            $facultad->update([
                'nombre' => $request->nombre,
            ]);

            $message = 'Facultad actualizada exitosamente.';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function destroy($institucion_id, $facultad_id)
    {
        $facultad = Facultad::findOrFailOrFail($facultad_id);
        $facultad->delete();
        return "Facultad eliminado exitosamente";
    }

    public function getCursos($facultad)
    {
        $facultad = Facultad::find($facultad);
        $output = '<option value="">Seleccione un Curso</option>';
        foreach ($facultad->cursos as $curso) {
            $output .= "<option value='" . $curso->id . "'>" . $curso->nombre . "</option>";
        }
        return $output;
    }
}
