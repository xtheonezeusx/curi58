@extends('backend.layout')

@section('title', 'Mostrar Institución')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">
        {{ $institucion->nombre }}
        <a href="{{ route('instituciones.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de facultades
                <a href="{{ route('facultades.create', $institucion->id) }}" class="btn btn-sm btn-success float-right">Nueva Facultad</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($institucion->facultades))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facultades as $facultad)
                        <tr>
                            <td>{{ $facultad->id }}</td>
                            <td>{{ $facultad->nombre }}</td>
                            <td><a href="{{ route('facultades.edit', ['institucion' => $institucion->id, 'facultad' => $facultad->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar la Facultad?')) { document.getElementById('form-delete-{{ $institucion->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('facultades.destroy', ['institucion' => $institucion->id, 'facultades' => $facultad->id]) }}" method="POST" style="display:none;" id="form-delete-{{ $institucion->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $facultades->links() }}
            </div>
            @else
            <div class="alert alert-info">
                No hay facultades para mostrar.
            </div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush