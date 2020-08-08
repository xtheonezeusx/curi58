@extends('backend.layout')

@section('title', 'Cobrar Salida')

@section('content')

    <h3 class="mb-4 text-gray-800">Cobrar Salida</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Cobrar Salida
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary float-right">Volver</a>
            </h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('comprobantes.cobrar', $salida->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="pago" class="col-form-label col-sm-2">Tipo de Pago</label>
                    <div class="col-sm-10">
                        <select name="pago" id="pago" class="custom-select">
                            <option value="">Seleccione un Tipo de Pago</option>
                            @foreach ($pagos as $pago)
                            <option value="{{ $pago->id }}">{{ $pago->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cuenta" class="col-form-label col-sm-2">Número de Cuenta</label>
                    <div class="col-sm-10">
                        <select name="cuenta" id="cuenta" class="custom-select">
                            <option value="">Seleccione una Cuenta</option>
                            @foreach ($cuentas as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->grupo->nombre .'/'. $cuenta->banco .'/'. $cuenta->numero }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="numero" class="col-form-label col-sm-2">Número de Operación</label>
                    <div class="col-sm-10">
                        <input type="text" id="numero" name="numero" class="form-control" value="{{ old('numero') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fecha" class="col-form-label col-sm-2">Fecha de Pago</label>
                    <div class="col-sm-10">
                        <input type="date" id="fecha" name="fecha" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="monto" class="col-form-label col-sm-2">Monto del Comprobante</label>
                    <div class="col-sm-10">
                        <input type="number" id="monto" name="monto" step="0.1" class="form-control" value="{{ old('monto') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="archivo" class="col-form-label col-sm-2">Archivo</label>
                    <div class="col-sm-10">
                        <input type="file" id="archivo" name="archivo" class="form-control-file">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Cobrar Salida</button>
            </form>
        </div>
    </div>

@endsection
