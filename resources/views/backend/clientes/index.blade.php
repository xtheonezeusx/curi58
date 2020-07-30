@extends('backend.layout')

@section('title', 'Clientes')

@push('css')
    @toastr_css
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.css') }}">
@endpush

@section('content')

    <h3 class="mb-4 text-gray-800">Clientes</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Lista de Clientes
                @can('crear cliente')
                <button type="button" class="btn btn-sm btn-success float-right" id="btn_nuevo">
                    Nuevo Cliente
                </button>
                @endcan
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_clientes">
                    <thead class="thead-light">
                        <tr>
                            <th>Acciones</th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Dni</th>
                            <th>Celular</th>
                            <th>Institución</th>
                            <th>Facultad</th>
                            <th>
                                <select name="grupo_filter" id="grupo_filter" class="form-control">
                                    <option value="">Selecciona el Grupo</option>
                                    @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th>Registrado Por</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Nuevo -->
    <div class="modal fade" id="modal_nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="output"></div>
                <form method="POST" id="form_nuevo">
                    @csrf
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">
                        Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nombres y Apellidos" id="nombre" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dni" class="col-form-label col-sm-2">
                        Dni</label>
                        <div class="col-sm-10">
                            <input type="text" id="dni" name="dni" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="celular" class="col-form-label col-sm-2">
                        Celular</label>
                        <div class="col-sm-10">
                            <input type="text" id="celular" name="celular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="institucion" class="col-form-label col-sm-2">
                        Institución</label>
                        <div class="col-sm-10">
                            <select name="institucion" id="institucion" class="custom-select">
                                <option value="">Seleccione una institución</option>
                            @foreach($instituciones as $institucion)
                                <option value="{{ $institucion->id }}">{{ $institucion->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facultad" class="col-form-label col-sm-2">
                        Facultad</label>
                        <div class="col-sm-10">
                            <select name="facultad" id="facultad" class="custom-select">
                                <option value="">Seleccione una facultad</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo" class="col-form-label col-sm-2">
                        Tipo</label>
                        <div class="col-sm-10">
                            <select name="tipo" id="tipo" class="custom-select">
                                <option value="">Seleccione tipo de cliente</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grupo" class="col-form-label col-sm-2">
                        Grupo</label>
                        <div class="col-sm-10">
                            <select name="grupo" id="grupo" class="custom-select">
                                <option value="">Seleccione Grupo</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-success">Nuevo Cliente</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Editar -->
    <div class="modal fade" id="modal_editar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="salida"></div>
                <form method="POST" id="form_editar">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="cliente_id">
                    <div class="form-group row">
                        <label for="nombre_edit" class="col-form-label col-sm-2">
                        Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Nombres y Apellidos" id="nombre_edit" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dni_edit" class="col-form-label col-sm-2">
                        Dni</label>
                        <div class="col-sm-10">
                            <input type="text" id="dni_edit" name="dni" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="celular_edit" class="col-form-label col-sm-2">
                        Celular</label>
                        <div class="col-sm-10">
                            <input type="text" id="celular_edit" name="celular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="institucion_edit" class="col-form-label col-sm-2">
                        Institución</label>
                        <div class="col-sm-10">
                            <select name="institucion" id="institucion_edit" class="custom-select">
                                <option value="">Seleccione una institución</option>
                            @foreach($instituciones as $institucion)
                                <option value="{{ $institucion->id }}">{{ $institucion->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facultad_edit" class="col-form-label col-sm-2">
                        Facultad</label>
                        <div class="col-sm-10">
                            <select name="facultad" id="facultad_edit" class="custom-select">
                                <option value="">Seleccione una facultad</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo" class="col-form-label col-sm-2">
                        Tipo</label>
                        <div class="col-sm-10">
                            <select name="tipo" id="tipo_edit" class="custom-select">
                                <option value="">Seleccione tipo de cliente</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grupo" class="col-form-label col-sm-2">
                        Grupo</label>
                        <div class="col-sm-10">
                            <select name="grupo" id="grupo_edit" class="custom-select">
                                <option value="">Seleccione Grupo</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-primary">Editar Cliente</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Trabajo -->
    <div class="modal fade" id="modal_trabajo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="output2"></div>
                <form method="POST" id="form_trabajo" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="cliente_id2" name="cliente_id">
                    <div class="form-group row">
                        <label for="descripcion" class="col-form-label col-sm-3">
                        Descripción</label>
                        <div class="col-sm-9">
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="archivo" class="col-form-label col-sm-3">
                        Archivo</label>
                        <div class="col-sm-9">
                            <input type="file" id="archivo" name="archivo" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="categoria" class="col-form-label col-sm-3">
                        Tipo de Trabajo</label>
                        <div class="col-sm-9">
                            <select name="categoria" id="categoria" class="custom-select">
                                <option value="">Seleccione el Tipo</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subtipo" class="col-form-label col-sm-3">
                        Subtipo de Trabajo</label>
                        <div class="col-sm-9">
                            <select name="subtipo" id="subtipo" class="custom-select">
                                <option value="">Seleccione el Subtipo de Trabajo</option>
                                @foreach ($subs as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha_entrega" class="col-form-label col-sm-3">
                        Fecha de entrega</label>
                        <div class="col-sm-9">
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-form-label col-sm-3">
                        Precio</label>
                        <div class="col-sm-9">
                            <input type="number" id="precio" name="precio" step="0.1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adelanto" class="col-form-label col-sm-3">
                        Adelanto</label>
                        <div class="col-sm-9">
                            <input type="number" id="adelanto" name="adelanto" step="0.1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="curso" class="col-form-label col-sm-3">
                        Curso</label>
                        <div class="col-sm-9">
                            <select name="curso" id="curso" class="custom-select">
                                <option value="">Seleccione un Curso</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="docente" class="col-form-label col-sm-3">
                        Docente</label>
                        <div class="col-sm-9">
                            <select name="docente" id="docente" class="custom-select">
                                <option value="">Seleccione un Docente</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-primary">Nuevo Trabajo</button>
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
        
            $("#btn_nuevo").on("click", function() {
                $("#form_nuevo").trigger("reset");
                $("#output").html("");
                $("#modal_nuevo").modal("show");
            });

            fetch_data();
            
            function fetch_data(grupo = '') {
            $('#table_clientes').DataTable({
                processing: true,
                serverSide: true,
                ajax: { 
                    url: '{{ route("clientes.getClientes") }}',
                    data: {grupo:grupo}
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'dni', name: 'dni'},
                    {data: 'celular', name: 'celular'},
                    {data: 'nombre_institucion', name: 'nombre_institucion'},
                    {data: 'nombre_facultad', name: 'nombre_facultad'},
                    {data: 'nombre_grupo', name: 'nombre_grupo', orderable: false},
                    {data: 'nombre_usuario', name: 'nombre_usuario'},
                    {data: 'nombre_tipo', name: 'nombre_tipo'},
                ],
                order: [[1, 'DESC']],
                language: { "url": "/backend/vendor/datatables/Spanish.json" },
            });
            }

            $('#grupo_filter').change(function(){
                var grupo_id = $('#grupo_filter').val();
                $('#table_clientes').DataTable().destroy();
                fetch_data(grupo_id);
            });

            $("#institucion").change(function() {
                $("#institucion option:selected").each(function() {
                    var institucion_id = $(this).val();
                    var url = "{{ route('clientes.getFacultades', 'institucion_id') }}";
                    $.ajax({
                        // url: "/admin/clientes/instituciones/" + institucion_id,
                        url: url.replace('institucion_id', institucion_id),
                        success: function(data) {
                            $("#facultad").html(data);
                        }
                    });
                });
            });

            $("#institucion_edit").change(function() {
                $("#institucion_edit option:selected").each(function() {
                    var institucion_id = $(this).val();
                    var url = "{{ route('clientes.getFacultades', 'institucion_id') }}";
                    $.ajax({
                        // url: "/admin/clientes/instituciones/" + institucion_id,
                        url: url.replace('institucion_id', institucion_id),
                        success: function(data) {
                            
                            $("#facultad_edit").html(data);
                        }
                    });
                });
            });

            $("#form_nuevo").on("submit", function() {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('clientes.store') }}",
                    method: "POST",
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
                            $("#output").html(errors_html);
                        }
                        else
                        {
                            $("#modal_nuevo").modal("hide");
                            toastr.success(data.message);
                            $("#table_clientes").DataTable().ajax.reload();
                        }
                    }
                })
            });

            $(document).on('click', '.edit', function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "/admin/clientes/" + id,
                    success: function(data)
                    {
                        $("#salida").html("");
                        $("#nombre_edit").val(data.nombre);
                        $("#dni_edit").val(data.dni);
                        $("#celular_edit").val(data.celular);
                        $("#cliente_id").val(id);

                        $("#tipo_edit option[value=" +  data.tipo_id + "]").attr("selected", true);

                        $("#grupo_edit option[value=" +  data.grupo_id + "]").attr("selected", true);

                        $("#institucion_edit option[value=" +  data.institucion_id + "]").attr("selected", true);
                        var institucion_id = data.institucion_id;
                        var facultad_id = data.facultad_id;
                        $.ajax({
                            url: "/admin/clientes/instituciones/" + institucion_id,
                            success: function(data) {
                                $("#facultad_edit").html(data);
                                $("#facultad_edit option[value=" +  facultad_id + "]").attr("selected", true);
                            }
                        });

                        $("#modal_editar").modal("show");
                    }
                });
            });

            $("#form_editar").on("submit", function(event) {
                event.preventDefault();
                var id = $("#cliente_id").val();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "/admin/clientes/" + id,
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
                            $("#table_clientes").DataTable().ajax.reload();
                        }
                    }
                });
            });

            // delete
            $(document).on('click', '.delete', function(){
                var id = $(this).attr('id');
                if(confirm("Estas seguro de eliminar este Cliente?"))
                {
                    $.ajax({
                        url: "/admin/clientes/" + id,
                        method: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE",
                                "id": id,
                                },
                        success: function(data)
                        {
                            toastr.success(data);
                            $('#table_clientes').DataTable().ajax.reload();
                        }
                    })
                }
                else
                {
                    return false;
                }
            });

            // nuevo trabajo
            $(document).on('click', '.trabajo', function(){
                var id = $(this).attr('id');
                $.ajax({
                    url: "/admin/clientes/" + id,
                    success: function(data)
                    {
                        $("#cliente_id2").val(id);
                        var facultad_id = data.facultad_id;
                        $.ajax({
                            url: "/admin/facultades/" + facultad_id,
                            success: function(data) {
                                $("#curso").html(data);
                            }
                        });
                        $("#output2").html("");
                        $("#form_trabajo").trigger("reset");
                        $("#modal_trabajo").modal("show");
                    }
                });
            });

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

            $("#form_trabajo").on("submit", function() {
                event.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: "{{ route('trabajos.store') }}",
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
                            window.location.href = "{{ route('trabajos.index') }}";
                        }
                    }
                })
            });

        });
    </script>
@endpush