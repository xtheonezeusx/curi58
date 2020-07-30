@extends('backend.layout')

@section('title', 'Roles')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Roles</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Roles
                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success float-right">Nuevo Rol</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($roles))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar el Rol?')) { document.getElementById('form-delete-{{ $role->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:none;" id="form-delete-{{ $role->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Roles para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush