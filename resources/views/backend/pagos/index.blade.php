@extends('backend.layout')

@section('title', 'Pagos')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Pagos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Tipos de Pagos
                <a href="{{ route('pagos.create') }}" class="btn btn-sm btn-success float-right">Nuevo Tipo de Pago</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($pagos))
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
                        @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->id }}</td>
                            <td>{{ $pago->nombre }}</td>
                            <td><a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar el Tipo de Pago?')) { document.getElementById('form-delete-{{ $pago->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:none;" id="form-delete-{{ $pago->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pagos->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Tipos de Pago para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush