@extends('backend.layout')

@section('title', 'Lista de Salidas sin cobrar')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Lista de Salidas sin cobrar</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Salidas sin cobrar
            </h6>
        </div>
        <div class="card-body">
            @if (count($salidas))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Cobrar</th>
                            <th>Cliente</th>
                            <th>Tipo de Trabajo</th>
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Precio</th>
                            <th>Adelanto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salidas as $salida)
                        <tr>
                            @can('cobrar salidas-sin-cobrar')
                            <td><a href="{{ route('salidas.cobrar', $salida->id) }}" class="btn btn-sm btn-primary">Cobrar</a></td>
                            @endcan
                            <td>{{ $salida->trabajo->cliente->nombre }}</td>
                            <td>{{ $salida->trabajo->categoria->nombre }}</td>
                            <td>
                                @if ($salida->trabajo->curso == NULL)
                                    <span class="badge badge-info">No específicado</span>
                                @else
                                    {{ $salida->trabajo->curso->nombre }}
                                @endif
                            </td>
                            <td>
                                @if ($salida->trabajo->docente == NULL)
                                    <span class="badge badge-info">No específicado</span>
                                @else
                                    {{ $salida->trabajo->docente->nombre }}
                                @endif
                            </td>
                            <td>{{ $salida->trabajo->precio }}</td>
                            <td>{{ $salida->trabajo->adelanto }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">No hay Salidas sin cobrar para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush