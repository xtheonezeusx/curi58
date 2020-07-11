@extends('backend.layout')

@section('title', 'Devolver Trabajo')

@section('content')

    <h3 class="mb-4 text-gray-800">Devolver Trabajo</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Devolver Trabajo
                <a href="{{ route('trabajos.control') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form method="POST" action="{{ route('trabajos.entregar', $trabajo->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="observacion" class="col-form-label col-sm-2">Observación</label>
                    <div class="col-sm-10">
                        <textarea name="observacion" id="observacion" class="form-control">{{ old('observacion') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Devolver Trabajo</button>
            </form>
        </div>
    </div>

@endsection