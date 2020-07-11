@extends('backend.layout')

@section('title', 'Lista de Cuentas')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Lista de Cuentas</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Cuentas
                <a href="{{ route('cuentas.create') }}" class="btn btn-sm btn-success float-right">Nueva Cuenta</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($cuentas))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>N°</th>
                            <th>Grupo</th>
                            <th>Banco</th>
                            <th>Número</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuentas as $cuenta)
                        <tr>
                            <td>{{ $cuenta->id }}</td>
                            <td>{{ $cuenta->grupo->nombre }}</td>
                            <td>{{ $cuenta->banco }}</td>
                            <td>{{ $cuenta->numero }}</td>
                            <td><a href="{{ route('cuentas.edit', $cuenta->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar la Cuenta?')) { document.getElementById('form-delete-{{ $cuenta->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display:none;" id="form-delete-{{ $cuenta->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cuentas->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Cuentas para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush