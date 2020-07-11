@extends('backend.layout')

@section('title', 'Trabajos Enviados')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Trabajos Enviados</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Trabajos Enviados
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Institución</th>
                            <th>Facultad</th>
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Registrado Por</th>
                            <th>Desarrollado Por</th>
                            <th>Enunciado</th>
                            <th>Archivo Finalizado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr>
                            <td>{{ $trabajo->id }}</td>
                            <td>{{ $trabajo->cliente->nombre }}</td>
                            <td>{{ $trabajo->cliente->facultad->institucion->nombre }}</td>
                            <td>{{ $trabajo->cliente->facultad->nombre }}</td>
                            <td>
                                @if ($trabajo->curso == NULL)
                                <span class="badge badge-info">No específicado</span>
                                @else
                                {{ $trabajo->curso->nombre }}
                                @endif
                            </td>
                            <td>
                                @if ($trabajo->docente == NULL)
                                <span class="badge badge-info">No específicado</span>
                                @else
                                {{ $trabajo->docente->nombre }}
                                @endif
                            </td>
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