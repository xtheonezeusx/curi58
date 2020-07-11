@extends('backend.layout')

@section('title', 'Grupos')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Grupos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Grupos
                <a href="{{ route('grupos.create') }}" class="btn btn-sm btn-success float-right">Nuevo Grupo</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($grupos))
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
                        @foreach ($grupos as $key => $grupo)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $grupo->nombre }}</td>
                            <td><a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar el Grupo?')) { document.getElementById('form-delete-{{ $grupo->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" style="display:none;" id="form-delete-{{ $grupo->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $grupos->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Grupos para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush