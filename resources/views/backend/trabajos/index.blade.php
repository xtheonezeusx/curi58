@extends('backend.layout')

@section('title', 'Trabajos sin Asignar')

@push('css')
    @toastr_css
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.css') }}">
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Trabajos</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Trabajos sin Asignar
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_trabajos">
                    <thead class="thead-light">
                        <tr>
                            <th>Acciones</th>
                            <th>Id</th>
                            <th>Fecha Entrega</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Sub Tipo</th>
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Registrado Por</th>
                            <th>Archivo</th>
                            <th>Precio</th>
                            <th>Adelanto</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modal_editar">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Trabajo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form_editar" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="trabajo_id" id="trabajo_id">
                <div class="form-group row">
                    <label for="fecha_entrega" class="col-form-label col-sm-3">Fecha de Entrega</label>
                    <div class="col-sm-9">
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categoria" class="col-form-label col-sm-3">Tipo</label>
                    <div class="col-sm-9">
                        <select name="categoria" id="categoria" class="custom-select">
                            <option value="">Selecciona un Tipo</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="subtipo" class="col-form-label col-sm-3">Sub Tipo</label>
                    <div class="col-sm-9">
                        <select name="subtipo" id="subtipo" class="custom-select">
                            <option value="">Selecciona un Tipo</option>
                            @foreach ($subs as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="curso" class="col-form-label col-sm-3">Curso</label>
                    <div class="col-sm-9">
                        <select name="curso" id="curso" class="custom-select">
                            <option value="">Selecciona un Curso</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="docente" class="col-form-label col-sm-3">Docente</label>
                    <div class="col-sm-9">
                        <select name="docente" id="docente" class="custom-select">
                            <option value="">Selecciona un Docente</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="archivo" class="col-form-label col-sm-3">Archivo</label>
                    <div class="col-sm-9">
                        <input type="file" name="archivo" id="archivo" class="form-control-file">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="precio" class="col-form-label col-sm-3">Precio</label>
                    <div class="col-sm-9">
                        <input type="text" id="precio" name="precio" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="adelanto" class="col-form-label col-sm-3">Adelanto</label>
                    <div class="col-sm-9">
                        <input type="text" id="adelanto" name="adelanto" class="form-control">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Editar Trabajo</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Asignar-->
    <div class="modal fade" id="modal_asignar">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Asignar Desarrollador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="output3"></div>
            <form id="form_asignar" method="POST">
                <input type="hidden" name="producto_id" id="producto_id3">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="desarrollador" class="col-form-label col-sm-3">Desarrollador</label>
                    <div class="col-sm-9">
                        <select name="desarrollador" id="desarrollador" class="custom-select" required>
                            <option value="">Seleccion un desarrollador</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Asignar</button>
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

            $("#table_trabajos").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('trabajos.getTrabajos') }}",
                columns: [
                    {data: "action", searchable: false, orderable: false},
                    {data: "id"},
                    {data: "fecha_entrega"},
                    {data: "cliente"},
                    {data: "categoria"},
                    {data: "subtipo"},
                    {data: "curso"},
                    {data: "docente"},
                    {data: "user"},
                    {data: "archivo", searchable: false, orderable: false},
                    {data: "precio"},
                    {data: "adelanto"},
                ],
                order: [[1, 'DESC']],
                language: { "url": "/backend/vendor/datatables/Spanish.json" },
            });

            // opcion:docente
            $("#curso").change(function() {
                $("#curso option:selected").each(function() {
                    var curso_id = $(this).val();
                    $.ajax({
                        url: "/admin/cursos/" + curso_id,
                        success: function(data) {
                            $("#docente").html(data);
                        }
                    });
                });
            });

            $(document).on('click', '.edit', function() {
                var trabajo_id = $(this).attr('id');
                $("#form_editar").trigger("reset");
                $.ajax({
                    url: "/admin/trabajos/" + trabajo_id + "/getTrabajo",
                    success: function(data) {

                        $("#categoria option[value=" +  data.categoria_id + "]").attr("selected", true);
                        $("#subtipo option[value=" +  data.sub_id + "]").attr("selected", true);
                        var curso_id = data.curso_id;
                        var docente_id = data.docente_id;
                        var cliente_id = data.cliente_id;

                        $("#fecha_entrega").val(data.fecha_entrega);
                        $("#trabajo_id").val(trabajo_id);
                        $("#precio").val(data.precio);
                        $("#adelanto").val(data.adelanto);

                        if (!curso_id && !docente_id) {
                            $("#docente").val(null);
                            $.ajax({
                                url: "/admin/trabajos/clientes/" + cliente_id + "/getFacultad",
                                success: function(data) {
                                    var facultad_id = data.id;
                                    $.ajax({
                                        url: "/admin/facultades/" + facultad_id,
                                        success: function(data) {
                                            $("#curso").html(data);
                                            $("#modal_editar").modal("show");
                                        }
                                    });

                                }
                            })
                        } else {
                            $.ajax({
                                url: "/admin/trabajos/" + curso_id + "/getFacultad",
                                success: function(data) {
                                    var facultad_id = data.id;
                                    $.ajax({
                                        url: "/admin/facultades/" + facultad_id,
                                        success: function(data) {
                                            $("#curso").html(data);

                                            $("#curso option[value=" + curso_id + "]").attr("selected", true);

                                            $.ajax({
                                                url: "/admin/cursos/" + curso_id,
                                                success: function(data) {
                                                    $("#docente").html(data);

                                                    $("#docente option[value=" + docente_id + "]").attr("selected", true);
                                                    $("#modal_editar").modal("show");
                                                }
                                            });


                                        }
                                    });

                                }
                            })
                        }
                        
                    }
                });
            });

            $("#form_editar").on('submit', function() {
                event.preventDefault();
                var form_data = new FormData(this);
                var trabajo_id = $("#trabajo_id").val();
                $.ajax({
                    url: "/admin/trabajos/" + trabajo_id,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_data,
                    success: function(data) {
                        if (data.errors.length > 0)
                        {
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for (var i = 0; i < data.errors.length; i++)
                            {
                                errors_html += "<li>" + data.errors[i] + "</li>"
                            }
                            errors_html += "</ul></div>";
                            $("#output2").html(errors_html);
                        }
                        else
                        {
                            toastr.success(data.message);
                            $("#modal_editar").modal("hide");
                            $('#table_trabajos').DataTable().ajax.reload();
                        }
                    }
                })
            });

            $(document).on('click', '.anular', function(){
                var trabajo_id = $(this).attr('id');
                if(confirm("Estas seguro de anular este Trabajo?"))
                {
                    $.ajax({
                        url: "/admin/trabajos/" + trabajo_id + "/anular",
                        method: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "PUT",
                                "trabajo_id": trabajo_id,
                                },
                        success: function(data)
                        {
                            toastr.success(data);
                            $('#table_trabajos').DataTable().ajax.reload();
                        }
                    })
                }
                else
                {
                    return false;
                }
            });

            $(document).on('click', '.asignar', function() {
                $("#form_asignar").trigger("reset");
                var trabajo_id = $(this).attr('id');
                $("#producto_id3").val(trabajo_id);
                var url = "{{ route('trabajos.modificar', 'trabajo_id') }}";
                window.location.href = url.replace('trabajo_id', trabajo_id);
            });

            // $("#form_asignar").on("submit", function() {
            //     event.preventDefault();
            //     var trabajo_id = $("#producto_id3").val();
            //     var user_id = $("#desarrollador").val();
            //     var form_data = $(this).serialize();
            //     $.ajax({
            //         url: "/admin/trabajos/" + trabajo_id + "/asignar/" + user_id,
            //         method: "POST",
            //         data: form_data,
            //         success: function(data) {
            //             if (data.errors.length > 0)
            //             {
            //                 var errors_html = "<div class='alert alert-danger'><ul>";
            //                 for (var i = 0; i < data.errors.length; i++)
            //                 {
            //                     errors_html += "<li>" + data.errors[i] + "</li>"
            //                 }
            //                 errors_html += "</ul></div>";
            //                 $("#output3").html(errors_html);
            //             }
            //             else
            //             {
            //                 toastr.success(data.message);
            //                 $("#modal_asignar").modal("hide");
            //                 $('#table_trabajos').DataTable().ajax.reload();
            //             }
            //         }
            //     });
            // });

        });
    </script>
@endpush