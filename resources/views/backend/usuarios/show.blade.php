@extends('backend.layout')

@section('title', 'Asignar Rol')

@section('content')

    <h3 class="mb-4 text-gray-800">Usuarios</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Asignar Rol
                <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('usuarios.roles', $user->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <p><b>{{ $user->name }}</b></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-form-label col-sm-2">Roles</label>
                    <div class="col-sm-10">
                        @foreach ($roles as $key => $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $role->id }}" name="roles[]" id="{{ $key }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $role->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Asignar Rol</button>
            </form>
        </div>
    </div>

@endsection