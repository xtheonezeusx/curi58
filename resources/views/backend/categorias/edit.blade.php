@extends('backend.layout')

@section('title', 'Editar Tipo de Trabajo')

@section('content')

    <h3 class="mb-4 text-gray-800">Tipos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editar Tipo de Trabajo
                <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nombre" class="col-fom-lable col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control" autofocus value="{{ $categoria->nombre }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Editar Tipo</button>
            </form>
        </div>
    </div>

@endsection