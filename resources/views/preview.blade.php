@extends('backend.layout')

@section('title', 'Preview')

@section('content')

    @include('backend.partials.topbar')
    
    <div class="container my-5">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Seleccione un Ciclo Académico
                    @can('listar ciclos')
                    <a href="{{ route('ciclos.index') }}" class="btn btn-sm btn-success float-right">Ciclos</a>
                    @endcan
                </h6>
            </div>
            <div class="card-body">
                @if (count($ciclos))
                <form action="{{ route('preview.select') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ciclo">Ciclo</label>
                        <select name="ciclo" id="ciclo" class="custom-select">
                            @foreach ($ciclos as $ciclo)
                            <option value="{{ $ciclo->id }}">{{ $ciclo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Seleccionar Ciclo</button>
                </form>
                @else
                <div class="alert alert-info">No hay ciclos para mostrar!</div>
                @endif
            </div>
        </div>

    </div>

    @include('backend.partials.modal')

    @include('backend.partials.footer')

@endsection