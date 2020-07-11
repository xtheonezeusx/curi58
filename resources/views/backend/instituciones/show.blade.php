@extends('backend.layout')

@section('title', 'Mostrar Institución')

@push('css')
    @toastr_css
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.css') }}">
@endpush

@section('content')

    <input type="hidden" value="{{ $institucion->id }}" id="institucion_id">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $institucion->nombre }}</li>
    </ol>

    <input type="hidden" id="institucion_id" value="{{ $institucion->id }}">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de facultades
                <button class="btn btn-sm btn-success float-right" id="btn_nuevo">
                    Nueva Facultad
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_facultades">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="modal_nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Facultad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="output"></div>
            <form method="POST" id="form_nuevo">
                @csrf
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-success">Nueva Facultad</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Facultad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="salida"></div>
            <form method="POST" id="form_editar">
                <input type="hidden" id="facultad_id" name="facultad_id">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nombre_edit" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre_edit" name="nombre" class="form-control">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Editar Facultad</button>
            </form>
        </div>
        </div>
    </div>
    </div>

@endsection

@push('js')
    @toastr_js
    @toastr_render
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
        
            $('#table_facultades').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("facultades.getFacultades", $institucion->id) }}',
                columns: [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'action', orderable: false, searchable: false},
                ],
                order: [[0, 'DESC']],
                language: { "url": "/backend/vendor/datatables/Spanish.json" },
            });

            $("#btn_nuevo").on('click', function() {
                $("#form_nuevo").trigger("reset");
                $("#output").html("");
                $("#modal_nuevo").modal("show");
            });

            $("#form_nuevo").on("submit", function() {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('facultades.store', $institucion->id) }}",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (data.errors.length > 0) {
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for (var i = 0; i < data.errors.length; i++) {
                                errors_html += "<li>" + data.errors[i] + "</li>"
                            }
                            errors_html += "</ul></div>";
                            $("#output").html(errors_html);
                        } else {
                            $("#modal_nuevo").modal("hide");
                            toastr.success(data.message);
                            $("#table_facultades").DataTable().ajax.reload();
                        }
                    }
                })
            });

            $(document).on('click', '.edit', function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "/admin/instituciones/" + {{ $institucion->id }} + "/" + id + "/getFacultad",
                    success: function(data)
                    {
                        $("#salida").html("");
                        $("#nombre_edit").val(data.nombre);
                        $("#facultad_id").val(id);
                        $("#modal_editar").modal("show");
                    }
                });
            });

            $("#form_editar").on("submit", function(event) {
                event.preventDefault();
                var id = $("#facultad_id").val();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "/admin/instituciones/" + {{ $institucion->id }} + "/" + id,
                    method: "POST",
                    data: form_data,
                    success: function(data)
                    {
                        if(data.errors.length > 0)
                        {
                            // contenido del mensaje de errores
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for(var i = 0; i < data.errors.length; i++)
                            {
                                errors_html += "<li>" + data.errors[i] + "</li>";
                            }
                            errors_html += "</ul></div>";
                            $("#salida").html(errors_html);
                        }
                        else
                        {
                            $("#modal_editar").modal("hide");
                            toastr.success(data.message);
                            $("#table_facultades").DataTable().ajax.reload();
                        }
                    }
                });
            });

            $(document).on('click', '.delete', function(){
                var facultad_id = $(this).attr('id');
                var institucion_id = $("#institucion_id").val();
                if(confirm("Estas seguro de eliminar esta Facultad?"))
                {
                    $.ajax({
                        url: "/admin/instituciones/" + institucion_id + "/" + facultad_id,
                        method: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE",
                                "facultad_id": facultad_id,
                                "institucion_id": institucion_id,
                                },
                        success: function(data)
                        {
                            toastr.success(data);
                            $('#table_facultades').DataTable().ajax.reload();
                        }
                    })
                }
                else
                {
                    return false;
                }
            });

            $(document).on('click', '.mostrar', function(){
                var facultad_id = $(this).attr('id');
                window.location.href = "/admin/instituciones/" + {{ $institucion->id }} + "/" + facultad_id;
            });

        })
    </script>
@endpush