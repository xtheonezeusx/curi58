@extends('backend.layout')

@section('title', 'Trabajos para dar Salida')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Trabajos culminados para dar Salida</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Trabajos para dar Salida
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Dar Salida</th>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Fecha Entrega</th>
                            <th>Registrado Por</th>
                            <th>Desarrollador</th>
                            <th>Enunciado</th>
                            <th>Archivo Finalizado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr>
                            @can('dar salida-trabajo')
                            <td>
                                <a href="{{ route('trabajos.darSalida', $trabajo->id) }}" class="btn btn-sm btn-primary">Dar Salida</a>
                            </td>
                            @endcan
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