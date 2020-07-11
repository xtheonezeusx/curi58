@extends('backend.layout')

@section('title', 'Culminar Trabajo Asignado')

@section('content')

    <h3 class="mb-4 text-gray-800">Culminar Trabajo Asignado</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Culminar Trabajo Asignado
                <a href="{{ route('trabajos.mis_asignados') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form method="POST" action="{{ route('trabajos.finalizar', $trabajo->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="observacion" class="col-form-label col-sm-2">Observación</label>
                    <div class="col-sm-10">
                        <textarea name="observacion" id="observacion" class="form-control">{{ old('observacion') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="archivo" class="col-form-label col-sm-2">Archivo</label>
                    <div class="col-sm-10">
                        <input type="file" id="archivo" name="archivo" class="form-control-file">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Finalizar Trabajo</button>
            </form>
        </div>
    </div>

@endsection