@extends('backend.layout')

@section('title', 'Mis Trabajos Asignados')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Mis Trabajos Asignados</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de mis Trabajos Asignados
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Acciones</th>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Tiempo Restante</th>
                            <th>Fecha Entrega</th>
                            <th>Registrado Por</th>
                            <th>Enunciado</th>
                            <th>Archivo Enviado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr>
                            @can('culminar mi-trabajo-asignado')
                            <td><a href="{{ route('trabajos.culminar', $trabajo->id) }}" class="btn btn-sm btn-primary">Culminar</a></td>
                            @endcan
                            <td>{{ $trabajo->id }}</td>
                            <td>{{ $trabajo->cliente->nombre }}</td>
                            @php 
                            Carbon\Carbon::setLocale('es') 
                            @endphp
                            @if ((Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($trabajo->fecha_entrega))) < 2)
                            <td class="border-left-danger">{{ Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($trabajo->fecha_entrega)) }}</td>
                            @elseif ((Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($trabajo->fecha_entrega))) <= 4)
                            <td class="border-left-info">{{ Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($trabajo->fecha_entrega)) }}</td>
                            @else
                            <td class="border-left-success">{{ Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($trabajo->fecha_entrega)) }}</td>
                            @endif
                            <td>{{ $trabajo->fecha_entrega }}</td>
                            <td>{{ $trabajo->user->name }}</td>
                            <td><a href="{{ asset($trabajo->archivo) }}" target="_blank">Descargar</a></td>
                            <td>
                                @if ($trabajo->archivo_final == NULL)
                                <span class="badge badge-info">Pendiente</span>
                                @else
                                <a href="{{ asset($trabajo->archivo_final) }}" target="_blank">Descargar</a>
                                @endif
                            </td>
                            <td>
                                @if ($trabajo->archivo_final == NULL)
                                <span class="badge badge-info">Ninguna</span>
                                @else
                                {{ $trabajo->observacion }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{ $trabajos->links() }}
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