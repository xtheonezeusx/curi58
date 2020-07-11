@extends('backend.layout')

@section('title', 'Control de Calidad')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Trabajos enviados para Control de Calidad</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Trabajos para Control de Calidad
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Aprobar</th>
                            <th>Devolver</th>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Fecha Entrega</th>
                            <th>Registrado Por</th>
                            <th>Desarrollador</th>
                            <th>Enunciado</th>
                            <th>Archivo Enviado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr>
                            <td>
                                <button href="" class="btn btn-sm btn-success" onclick="event.preventDefault(); if (confirm('¿Estas seguro de aprobar este trabajo?')) { document.getElementById('form-aprobar-{{ $trabajo->id }}').submit(); }">Aprobar</button>
                                <form action="{{ route('trabajos.aprobar', $trabajo->id) }}" method="POST" id="form-aprobar-{{ $trabajo->id }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('trabajos.devolver', $trabajo->id) }}" class="btn btn-sm btn-primary">Devolver</a>
                            </td>
                            <td>{{ $trabajo->id }}</td>
                            <td>{{ $trabajo->cliente->nombre }}</td>
                            <td>{{ $trabajo->fecha_entrega }}</td>
                            <td>{{ $trabajo->user->name }}</td>
                            <td>{{ $trabajo->desarrollador->name }}</td>
                            <td><a href="{{ asset($trabajo->archivo) }}" target="_blank">Descargar</a></td>
                            <td>
                                @if ($trabajo->archivo_final == NULL)
                                <span class="badge badge-info">Pendiente</span>
                                @else
                                <a href="{{ asset($trabajo->archivo_final) }}" target="_blank">Descargar</a>
                                @endif
                            </td>
                            <td>
                                @if ($trabajo->observacion == NULL)
                                <span class="badge badge-info">Ninguna</span>
                                @else
                                {{ $trabajo->observacion }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $trabajos->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Trabajos para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush