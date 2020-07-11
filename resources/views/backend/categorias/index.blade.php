@extends('backend.layout')

@section('title', 'Tipo de Trabajo')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Tipo de Trabajo</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Tipos de Trabajo
                <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-success float-right">Nuevo Tipo</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($categorias))
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
                        @foreach ($categorias as $key => $categoria)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td><a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar este Tipo de Trabajo?')) { document.getElementById('form-delete-{{ $categoria->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:none;" id="form-delete-{{ $categoria->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{ $categorias->links() }}
                </table>
            </div>
            @else
            <div class="alert alert-info">No hay Tipos de Trabajo para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush