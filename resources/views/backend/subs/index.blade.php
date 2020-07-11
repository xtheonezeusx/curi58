@extends('backend.layout')

@section('title', 'Subtipos de Trabajo')

@push('css')
    @toastr_css
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Subtipos de Trabajo</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Subtipos de Trabajo
                <a href="{{ route('subs.create') }}" class="btn btn-sm btn-success float-right">Nuevo Subtipo de Trabajo</a>
            </h6>
        </div>
        <div class="card-body">
            @if (count($subs))
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
                        @foreach ($subs as $key => $sub)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sub->nombre }}</td>
                            <td><a href="{{ route('subs.edit', $sub->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar este tipo Subtipo de Trabajo?')) { document.getElementById('form-delete-{{ $sub->id }}').submit() }"><i class="fas fa-trash-alt"></i></button>
                                <form action="{{ route('subs.destroy', $sub->id) }}" method="POST" style="display:none;" id="form-delete-{{ $sub->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $subs->links() }}
            </div>
            @else
            <div class="alert alert-info">No hay Subtipos de Trabajo para mostrar!</div>
            @endif
        </div>
    </div>

@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush