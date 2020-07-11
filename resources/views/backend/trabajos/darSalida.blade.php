@extends('backend.layout')

@section('title', 'Dar Salida')

@section('content')

    <h3 class="mb-4 text-gray-800">Dar Salida</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Dar Salida
                <a href="{{ route('trabajos.salida') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form method="POST" action="{{ route('trabajos.enviar', $trabajo->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="envio" class="col-form-label col-sm-2">Forma de Envio</label>
                    <div class="col-sm-10">
                        <select name="envio" id="envio" class="custom-select">
                            <option value="">Selecciona un tipo de Envio</option>
                            @foreach ($envios as $envio)
                            <option value="{{ $envio->id }}">{{ $envio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Enviar Trabajo</button>
            </form>
        </div>
    </div>

@endsection