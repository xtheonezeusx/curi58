@extends('backend.layout')

@section('title', 'Nueva Facultad')

@section('content')

    <h3 class="mb-4 text-gray-800">{{ $institucion->nombre }}</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Nueva Facultad
                <a href="{{ route('instituciones.show', $institucion->id) }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('facultades.store', $institucion->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nombre" class="col-fom-lable col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control" autofocus value="{{ old('nombre') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Nueva Facultad</button>
            </form>
        </div>
    </div>

@endsection
