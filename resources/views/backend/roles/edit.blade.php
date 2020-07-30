@extends('backend.layout')

@section('title', 'Editar Rol')

@section('content')

    <h3 class="mb-4 text-gray-800">Roles</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editar Rol
                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control" autofocus value="{{ $role->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-form-label col-sm-2">Permisos</label>
                    <div class="col-sm-10">
                        @foreach ($permissions as $key => $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permisos[]" id="{{ $key }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Editar Rol</button>
            </form>
        </div>
    </div>

@endsection
