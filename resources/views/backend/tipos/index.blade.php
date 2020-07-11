@extends('backend.layout')

@section('title', 'Tipo de Clientes')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Tipo de Clientes</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Tipos de Cliente
                <a href="{{ route('tipos.create') }}" class="btn btn-sm btn-success float-right">Nuevo Tipo</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($tipos))
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
                        @foreach ($tipos as $key => $tipo)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $tipo->nombre }}</td>
                            <td><a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar este Tipo?')) { document.getElementById('form-delete-{{ $tipo->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('tipos.destroy', $tipo->id) }}" method="POST" style="display:none;" id="form-delete-{{ $tipo->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tipos->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Tipos de Cliente para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush