@extends('backend.layout')

@section('title', 'Editar Usuario')

@section('content')

    <h3 class="mb-4 text-gray-800">Usuarios</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editar Usuario
                <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-fom-lable col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" class="form-control" autofocus value="{{ $user->name }}" placeholder="Nombres y Apellidos">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-fom-lable col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cellphone" class="col-fom-lable col-sm-2">Celular</label>
                    <div class="col-sm-10">
                        <input type="text" id="cellphone" name="cellphone" class="form-control" value="{{ $user->cellphone }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Editar Usuario</button>
            </form>
        </div>
    </div>

@endsection