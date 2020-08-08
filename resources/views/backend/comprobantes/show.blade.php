@extends('backend.layout')

@section('title', 'Ver Archivos')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">
        Archivos
        <a href="{{ route('salidas.cobradas') }}" class="btn btn-sm btn-primary float-right">Volver</a>
    </h3>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Ver Archivos
                @can('cobrar salidas-sin-cobrar')
                <a href="{{ route('comprobantes.cobrar', $salida->id) }}" class="btn btn-sm btn-success float-right">Nuevo Comprobante</a>
                @endcan
            </h6>
        </div>
        <div class="card-body">
            @if (count($comprobantes))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha de Pago</th>
                            <th>Número de Operación</th>
                            <th>Monto</th>
                            <th>Cuenta</th>
                            <th>Banco</th>
                            <th>Archivo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comprobantes as $comprobante)
                        <tr>
                            <td>{{ $comprobante->fecha_pago }}</td>
                            <td>{{ $comprobante->numero }}</td>
                            <td>{{ $comprobante->monto }}</td>
                            <td>{{ $comprobante->cuenta->numero }}</td>
                            <td>{{ $comprobante->cuenta->banco }}</td>
                            <td><a href="{{ asset($comprobante->archivo) }}" target="_blank">Descargar</a></td>
                            @can('editar-archivos salidas-cobradas')
                            <td><a href="{{ route('comprobantes.edit', $comprobante->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            @endcan
                            @can('eliminar-archivos salidas-cobradas')
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar el Comprobante?')) { document.getElementById('form-delete-{{ $comprobante->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('comprobantes.destroy', $comprobante->id) }}" method="POST" style="display:none;" id="form-delete-{{ $comprobante->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">No hay comprobantes para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush