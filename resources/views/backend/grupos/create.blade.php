@extends('backend.layout')

@section('title', 'Nuevo Grupo')


@section('content')

    <h3 class="mb-4 text-gray-800">Grupos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Nuevo Grupo
                <a href="{{ route('grupos.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('grupos.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control" autofocus value="{{ old('nombre') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Nuevo Grupo</button>
            </form>
        </div>
    </div>

@endsection

