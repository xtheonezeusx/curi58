@extends('backend.layout')

@section('title', 'Lista de Salidas cobradas')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Lista de Salidas cobradas</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Lista de Salidas cobradas
                    </h6>
                </div>
                <!-- <div class="col-sm-6">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cliente" name="cliente" for="cliente">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="cliente"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
        <div class="card-body">
            @if (count($salidas))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Ver Archivos</th>
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
                            @can('ver-archivos salidas-cobradas')
                            <td><a href="{{ route('comprobantes.show', $salida->id) }}">Ver Archivos</a></td>
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
            {{ $salidas->links() }}
            @else
            <div class="alert alert-info">No hay Salidas cobradas mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush