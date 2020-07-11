@extends('backend.layout')

@section('title', 'Nueva Cuenta')

@section('content')

    <h3 class="mb-4 text-gray-800">Nueva Cuenta</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Nueva Cuenta
                <a href="{{ route('cuentas.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('cuentas.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="grupo" class="col-fom-lable col-sm-2">Grupo</label>
                    <div class="col-sm-10">
                        <select name="grupo" id="grupo" class="custom-select">
                            <option value="">Seleccione un Grupo</option>
                            @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="banco" class="col-fom-lable col-sm-2">Banco</label>
                    <div class="col-sm-10">
                        <input type="text" id="banco" name="banco" class="form-control" autofocus value="{{ old('banco') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="numero" class="col-fom-lable col-sm-2">Número</label>
                    <div class="col-sm-10">
                        <input type="text" id="numero" name="numero" class="form-control" value="{{ old('numero') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Nueva Cuenta</button>
            </form>
        </div>
    </div>

@endsection

