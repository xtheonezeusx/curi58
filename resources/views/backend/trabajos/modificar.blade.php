@extends('backend.layout')

@section('title', 'Asignar Desarrollador')

@section('content')

    <h3 class="mb-4 text-gray-800">Asignar Desarrollador</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Asignar Desarrollador
                <a href="{{ route('trabajos.asignados') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form method="POST" action="{{ route('trabajos.desarrollador', $trabajo->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="desarrollador" class="col-form-label col-sm-2">Desarrollador</label>
                    <div class="col-sm-10">
                        <select name="desarrollador" id="desarrollador" class="custom-select">
                            <option value="">Selecciona un Desarrollador</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Asignar Desarrollador</button>
            </form>
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