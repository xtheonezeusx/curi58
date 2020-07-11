@extends('backend.layout')

@section('title', 'Instituciones')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Instituciones</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Instituciones
                <a href="{{ route('instituciones.create') }}" class="btn btn-sm btn-success float-right">Nueva Institución</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($instituciones))
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
                        @foreach ($instituciones as $key => $institucion)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><a href="{{ route('instituciones.show', $institucion->id) }}">{{ $institucion->nombre }}</a></td>
                            <td><a href="{{ route('instituciones.edit', $institucion->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar la Institucion?')) { document.getElementById('form-delete-{{ $institucion->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('instituciones.destroy', $institucion->id) }}" method="POST" style="display:none;" id="form-delete-{{ $institucion->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $instituciones->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Instituciones para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush