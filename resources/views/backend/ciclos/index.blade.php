@extends('backend.layout')

@section('title', 'Ciclos')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Ciclos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Ciclos
                @can('crear ciclo')
                <a href="{{ route('ciclos.create') }}" class="btn btn-sm btn-success float-right">Nuevo Ciclo</a>
                @endcan
            </h6>
        </div>
        <div class="card-body">
            @if (count($ciclos))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ciclos as $key => $ciclo)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ciclo->nombre }}</td>
                            @can('editar ciclo')
                            <td><a href="{{ route('ciclos.edit', $ciclo->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            @endcan
                            @can('eliminar ciclo')
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar el Ciclo?')) { document.getElementById('form-delete-{{ $ciclo->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('ciclos.destroy', $ciclo->id) }}" method="POST" style="display:none;" id="form-delete-{{ $ciclo->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ciclos->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay ciclos para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush