@extends('backend.layout')

@section('title', 'Envios')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Envios</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Tipos de Envios
                <a href="{{ route('envios.create') }}" class="btn btn-sm btn-success float-right">Nuevo Tipo de Envio</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($envios))
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
                        @foreach ($envios as $key => $envio)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $envio->nombre }}</td>
                            <td><a href="{{ route('envios.edit', $envio->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar este tipo de Envio?')) { document.getElementById('form-delete-{{ $envio->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('envios.destroy', $envio->id) }}" method="POST" style="display:none;" id="form-delete-{{ $envio->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $envios->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Envios para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush