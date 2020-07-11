@extends('backend.layout')

@section('title', 'Cursos')

@push('css')
    @toastr_css
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.css') }}">
@endpush

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instituciones.show', $facultad->institucion->id) }}">{{ $facultad->institucion->nombre }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $facultad->nombre }}</li>
    </ol>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de cursos
                <button id="btn_nuevo" class="btn btn-sm btn-success float-right">Nuevo Curso</button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_cursos">
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
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Curso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="output"></div>
            <form id="form_nuevo" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success">Nuevo Curso</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Curso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="salida"></div>
            <form id="form_editar" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="curso_id">
                <div class="form-group row">
                    <label for="nombre_edit" class="col-form-label col-sm-2">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre_edit" name="nombre" class="form-control">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Editar Curso</button>
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

            $('#table_cursos').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("cursos.getCursos",["institucion"=>$facultad->institucion->id, "facultad"=>$facultad->id]) }}',
                columns: [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'action', orderable: false, searchable: false},
                ],
                order: [[0, 'DESC']],
                language: { "url": "/backend/vendor/datatables/Spanish.json" },
            });

            $("#btn_nuevo").on("click", function() {
                $("#output").html("");
                $("#form_nuevo").trigger("reset");
                $("#modal_nuevo").modal("show");
            });

            $("#form_nuevo").on("submit", function() {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('cursos.create', ['institucion' => $facultad->institucion->id, 'facultad' => $facultad->id]) }}",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (data.errors.length > 0) {
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for ($i = 0; $i < data.errors.length; $i++) {
                                errors_html += "<li>" + data.errors[$i] + "</li>";
                            }
                            errors_html += "</ul></div>";
                            $("#output").html(errors_html);
                        } else {
                            $("#modal_nuevo").modal("hide");
                            toastr.success(data.message);
                            $("#table_cursos").DataTable().ajax.reload();
                        }
                    }
                });
            });

            $(document).on("click", ".edit", function() {
                var curso_id = $(this).attr("id");
                $.ajax({
                    url: "/admin/instituciones/" + {{ $facultad->institucion->id }} + "/" + {{ $facultad->id }} + "/" + curso_id + "/getCurso",
                    success: function(data) {
                        $("#nombre_edit").val(data.nombre);
                        $("#curso_id").val(curso_id);
                        $("#modal_editar").modal("show");
                    }
                });
            });

            $("#form_editar").on("submit", function() {
                event.preventDefault();
                var curso_id = $("#curso_id").val();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "/admin/instituciones/" + {{ $facultad->institucion->id }} + "/" + {{ $facultad->id }} + "/" + curso_id,
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (data.errors.length > 0) {
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for ($i = 0; $i < data.errors.length; $i++) {
                                errors_html += "<li>" + data.errors[$i] + "</li>";
                            }
                            errors_html += "</ul></div>";
                            $("#salida").html(errors_html);
                        } else {
                            $("#modal_editar").modal("hide");
                            toastr.success(data.message);
                            $("#table_cursos").DataTable().ajax.reload();
                        }
                    }
                });
            });

            $(document).on('click', '.delete', function(){
                var curso_id = $(this).attr('id');
                if(confirm("Estas seguro de eliminar este Curso?"))
                {
                    $.ajax({
                        url: "/admin/instituciones/" + {{ $facultad->institucion->id }} + "/" + {{ $facultad->id }} + "/" + curso_id,
                        method: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE",
                                "curso_id": curso_id,
                                },
                        success: function(data)
                        {
                            toastr.success(data);
                            $('#table_cursos').DataTable().ajax.reload();
                        }
                    })
                }
                else
                {
                    return false;
                }
            });

            $(document).on('click', '.mostrar', function(){
                var curso_id = $(this).attr('id');
                window.location.href = "/admin/instituciones/" + {{ $facultad->institucion->id }} + "/" + {{ $facultad->id }} + "/" + curso_id;
            });

        });
    </script>
@endpush