@extends('backend.layout')

@section('title', 'Trabajos Asignados')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Trabajos Asignados</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Trabajos Asignados
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Asignar</th>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Modalidad</th>
                            <th>Tipo</th>
                            <th>Tiempo Restante</th>
                            <th>Fecha Entrega</th>
                            <th>Registrado Por</th>
                            <th>Asignado A</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr>
                            @can('asignar trabajo-sin-asignar')
                            <td><a href="{{ route('trabajos.modificar', $trabajo->id) }}" class="btn btn-sm btn-primary">Modificar Desarrollador</a></td>
                            @endcan
                            <td>{{ $trabajo->id }}</td>
                            <td>{{ $trabajo->cliente->nombre }}</td>
                            <td>{{ $trabajo->cliente->tipo->nombre }}</td>
                            <td>{{ $trabajo->categoria->nombre }}</td>
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
                            <td>{{ $trabajo->desarrollador->name }}</td>
                            <td><a href="{{ asset($trabajo->archivo) }}" target="_blank">Descargar</a></td>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Cantidad de trabajos Asignados por Desarrollador
            </h6>
        </div>
        <div class="card-body">
            @if (count($trabajosd))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Desarrollador</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajosd as $trabajo)
                        <tr>
                            <td>{{ $trabajo->name }}</td>
                            <td>{{ $trabajo->cantidad }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">No hay trabajos asignados!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush