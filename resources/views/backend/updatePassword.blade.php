@extends('backend.layout')

@section('title', 'Cambiar Password')

@push('css')
    @toastr_css
@endpush

@section('content')
    <h3 class="mb-4 text-gray-800">Cambiar Password</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mi perfil</h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="old_password" class="col-form-label col-sm-2">Contraseña actual</label>
                    <div class="col-sm-10">
                        <input type="text" id="old_password" name="old_password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-form-label col-sm-2">Nueva Contraseña</label>
                    <div class="col-sm-10">
                        <input type="text" id="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-form-label col-sm-2">Confirmar contraseña</label>
                    <div class="col-sm-10">
                        <input type="text" id="password-confirm" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    @jquery
    @toastr_js
    @toastr_render
@endpush