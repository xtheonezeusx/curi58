@extends('backend.layout')

@section('title', 'Grupos')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Usuarios</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Usuarios
                @can('crear usuario')
                <a href="{{ route('usuarios.create') }}" class="btn btn-sm btn-success float-right">Nuevo Usuario</a>
                @endcan
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Rol</th>
                            <th>Asignar Rol</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->cellphone }}</td>
                            <td>{{ $user->roles->pluck('name') }}</td>
                            @role('admin')
                            <td><a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-sm btn-primary">Asignar Rol</a></td>
                            @endrole
                            @can('editar usuario')
                            <td><a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            @endcan
                            @can('eliminar usuario')
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar al Usuario?')) { document.getElementById('form-delete-{{ $user->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:none;" id="form-delete-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush