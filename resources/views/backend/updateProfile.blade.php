@extends('backend.layout')

@section('title', 'Actualizar Perfil')

@push('css')
    @toastr_css
@endpush

@section('content')
    <h3 class="mb-4 text-gray-800">Actualizar Perfil</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mi perfil</h6>
        </div>
        <div class="card-body">
            @include('backend.partials.errors')
            <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-form-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cellphone" class="col-form-label col-sm-2">Celular</label>
                    <div class="col-sm-10">
                        <input type="text" id="cellphone" name="cellphone" class="form-control" value="{{ Auth::user()->cellphone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-form-label col-sm-2">Imagen de Perfil</label>
                    <div class="col-sm-10">
                        <input type="file" id="image" name="image" class="form-control-file">
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