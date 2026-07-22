@section('title')
    Sysnet Perú - Marcas & Modelos
@endsection
@extends('layouts.app')
@section('style')
    <!-- DataTables css -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Dropzone css -->
    <link href="{{ asset('assets/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
    <style>
        /* Add your custom styles here */
        .container-fluid {
            width: 100% !important;
        }
    </style>
    <!-- Pnotify css -->
    <link href="{{ asset('assets/plugins/pnotify/css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Marcas & Modelos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('marcas_y_modelos.index') }}">Listado</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Registro de Marcas</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">
                                    Este es un formulario para crear una nueva marca. Por favor, complete todos los campos
                                    requeridos antes de enviar el formulario.
                                </h6>
                                <form method="POST" action="{{ route('marcas.store') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nombre">Razon Social:</label>
                                        <input type="text" class="form-control" required name="nombre" id="nombre"
                                            aria-describedby="NombreHelp" placeholder="Telefónica">
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado de la Marca:</label>
                                        <select class="form-control" name="estado" id="estado" required>
                                            <option value="">Seleccione un estado</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Registro de Tipo de Producto</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">
                                    Este es un formulario para crear un nuevo tipo de producto. Por favor, complete todos los campos
                                    requeridos antes de enviar el formulario.
                                </h6>
                                <form method="POST" action="{{ route('tipo-productos.store') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" required name="nombre" id="nombre"
                                            aria-describedby="NombreHelp" placeholder="Cámara Go Pro">
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion">Descripción del Tipo de Producto:</label>
                                        <textarea id="descripcion" required name="descripcion" class="form-control"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title mb-0">Todas las Marcas</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($marcas as $marca)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>{{ $marca->nombre }}</td>
                                                    <td>
                                                        @if ($marca->estado == 1)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="button-list">
                                                            <button type="button"
                                                                class="btn btn-success-rgba btn-edit-marca"
                                                                data-toggle="modal" data-target="#editMarcaModal"
                                                                data-id="{{ $marca->id }}"
                                                                data-nombre="{{ $marca->nombre }}"
                                                                data-estado="{{ (int) $marca->estado }}"
                                                                data-url="{{ route('marcas.update', $marca->id) }}">
                                                                <i class="feather icon-edit-2"></i>
                                                            </button>

                                                            <button type="button"
                                                                class="btn btn-danger-rgba btn-delete-user"
                                                                data-toggle="modal" data-target="#deleteUserModal"
                                                                data-url="{{ route('marcas.destroy', $marca->id) }}"
                                                                data-name="{{ $marca->nombre }}">
                                                                <i class="feather icon-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title mb-0">Todos los Tipos de Productos</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless datatable-special">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tiposProducto as $producto)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>
                                                        <p>
                                                            {{ $producto->descripcion }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="button-list">
                                                            <button type="button"
                                                                class="btn btn-success-rgba btn-edit-tipoProducto"
                                                                data-toggle="modal" data-target="#editTipoProductoModal"
                                                                data-id="{{ $producto->id }}"
                                                                data-nombre="{{ $producto->nombre }}"
                                                                data-descripcion="{{ $producto->descripcion }}"
                                                                data-url="{{ route('tipo-productos.update', $producto->id) }}">
                                                                <i class="feather icon-edit-2"></i>
                                                            </button>

                                                            <button type="button"
                                                                class="btn btn-danger-rgba btn-delete-user"
                                                                data-toggle="modal" data-target="#deleteUserModal"
                                                                data-url="{{ route('tipo-productos.destroy', $producto->id) }}"
                                                                data-name="{{ $producto->nombre }}">
                                                                <i class="feather icon-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Registro de Modelos</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">
                                    Este es un formulario para crear una nuevo modelo. Por favor, complete todos los campos
                                    requeridos antes de enviar el formulario.
                                </h6>
                                <form method="POST" action="{{ route('modelos.store') }}" id="form-modelo"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="nombre_modelo">Código</label>
                                        <input type="text" class="form-control" required name="nombre"
                                            id="nombre_modelo" placeholder="Ej. FMB920">
                                    </div>

                                    <div class="form-group">
                                        <label for="marca_id">Marca</label>
                                        <select class="form-control" name="marca_id" id="marca_id" required>
                                            <option value="">Seleccione una Marca</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo_producto_id">Tipo de Producto / Categoría</label>
                                        <select name="tipo_producto_id" id="tipo_producto_id" class="form-control"
                                            required>
                                            <option value="">Seleccione un tipo</option>
                                            @foreach ($tiposProducto as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Contenedor Dropzone visual (Sin form interno) -->
                                    <div class="form-group">
                                        <label>Imagen del Modelo (Opcional)</label>
                                        <div id="modelo-dropzone" class="dropzone"
                                            style="border: 2px dashed #0087F7; border-radius: 5px; background: white; cursor: pointer;">
                                            <div class="dz-message text-center">
                                                <i class="feather icon-upload-cloud" style="font-size: 2rem;"></i><br>
                                                Arrastra la foto aquí o haz clic para subir
                                            </div>
                                        </div>
                                        <!-- Input file real y oculto que Laravel recibirá en el request -->
                                        <input type="file" name="url_imagen" id="archivo-real"
                                            style="display: none;">
                                    </div>

                                    <button type="submit" id="btn-submit-modelo"
                                        class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="card-title mb-0">Todas las Marcas</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless datatable-special">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modelos as $modelo)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if (!$modelo->url_imagen)
                                                            <img src="{{ asset('assets/images/ui-images/image-rounded.jpg') }}"
                                                                width="100" loading="lazy" class="rounded" />
                                                        @else
                                                            <img src="{{ asset('storage/' . $modelo->url_imagen) }}"
                                                                width="100" loading="lazy" class="rounded" />
                                                        @endif
                                                    </td>
                                                    <td>{{ $modelo->nombre }}</td>
                                                    <td>
                                                        {{ $modelo->marca->nombre }}
                                                    </td>
                                                    <td>
                                                        <div class="button-list">
                                                            <button type="button"
                                                                class="btn btn-success-rgba btn-edit-modelo"
                                                                data-toggle="modal" data-target="#editModeloModal"
                                                                data-id="{{ $modelo->id }}"
                                                                data-nombre="{{ $modelo->nombre }}"
                                                                data-marca="{{ $modelo->marca_id }}"
                                                                data-tipoproducto="{{ $modelo->tipo_producto_id }}"
                                                                data-img="{{ $modelo->url_imagen ? asset('storage/' . $modelo->url_imagen) : asset('assets/images/ui-images/image-rounded.jpg') }}"
                                                                data-url="{{ route('modelos.update', $modelo->id) }}">
                                                                <i class="feather icon-edit-2"></i>
                                                            </button>

                                                            <button type="button"
                                                                class="btn btn-danger-rgba btn-delete-user"
                                                                data-toggle="modal" data-target="#deleteUserModal"
                                                                data-url="{{ route('modelos.destroy', $modelo->id) }}"
                                                                data-name="{{ $modelo->nombre }}">
                                                                <i class="feather icon-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->


    <!-- Modal de Eliminar -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirmar eliminación
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        ¿Deseas eliminar a
                        <strong id="userName"></strong>?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Eliminar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal de Marca -->
    <div class="modal fade" id="editMarcaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="editMarcaForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Editar Marca
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre</label>

                            <input type="text" class="form-control" name="nombre" id="edit_nombre" required>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>

                            <select class="form-control" name="estado" id="edit_estado" required>

                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>

                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal de Marca -->
    <div class="modal fade" id="editTipoProductoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="editTipoProductoForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Editar Tipo de Productos
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre</label>

                            <input type="text" class="form-control" name="nombre" id="edit_nombreTipoProducto" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" id="edit_descripcionTipoProducto" name="descripcion" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal de Marca -->
    <div class="modal fade" id="editModeloModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="editModeloForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Editar Modelo
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Código</label>

                            <input type="text" class="form-control" name="nombre" id="edit_nombreModelo" required>
                        </div>

                        <div class="form-group">
                            <label>Marca</label>

                            <select class="form-control" name="marca_id" id="edit_marcaModelo" required>

                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipo de Producto / Categoría</label>

                            <select class="form-control" name="tipo_producto_id" id="edit_tipoModelo" required>

                                @foreach ($tiposProducto as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Input para cambiar foto -->
                        <div class="form-group">
                            @if ($modelo->url_imagen)
                                <div class="mb-2">
                                    <label>Imagen Actual:</label><br>
                                    <img src="#" class="rounded" id="editImg" width="100">
                                </div>
                            @endif

                            <label for="url_imagen">Cambiar Imagen (Opcional)</label>
                            <input type="file" class="form-control-file" name="url_imagen"
                                accept="image/jpeg,image/png,image/jpg">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <!-- Dropzone js -->
    <script src="{{ asset('assets/plugins/dropzone/dist/dropzone.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-table-datatable.js') }}"></script>
    <!-- Pnotify js -->
    <script src="{{ asset('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-pnotify.js') }}"></script>

    <script>
        $(function() {
            $('.datatable-special').DataTable({
                "order": [
                    [3, "desc"]
                ],
                responsive: true
            });

            $(document).on('click', '.btn-delete-user', function() {
                let url = $(this).data('url');
                let nombre = $(this).data('name');
                $('#deleteUserForm').attr('action', url);
                $('#userName').text(nombre);
            });

            $(document).on('click', '.btn-edit-marca', function() {
                let id = $(this).data('id');
                let nombre = $(this).data('nombre');
                let estado = $(this).data('estado');
                $('#edit_nombre').val(nombre);
                $('#edit_estado').val(estado);
                let url = $(this).data('url');
                $('#editMarcaForm').attr('action', url);
            });

            $(document).on('click', '.btn-edit-tipoProducto', function() {
                let id = $(this).data('id');
                let nombreTipoProducto = $(this).data('nombre');
                let descripcionTipoProducto = $(this).data('descripcion');
                $('#edit_nombreTipoProducto').val(nombreTipoProducto);
                $('#edit_descripcionTipoProducto').val(descripcionTipoProducto);
                let urlTipoProducto = $(this).data('url');
                $('#editTipoProductoForm').attr('action', urlTipoProducto);
            });

            $(document).on('click', '.btn-edit-modelo', function() {
                let idModelo = $(this).data('id');
                let nombreModelo = $(this).data('nombre');
                let marcaModelo = $(this).data('marca');
                let edit_tipoModelo = $(this).data('tipoproducto');
                let imgModel = $(this).data('img')
                $('#edit_nombreModelo').val(nombreModelo);
                $('#edit_marcaModelo').val(marcaModelo);
                $('#edit_tipoModelo').val(edit_tipoModelo)
                $('#editImg').attr('src', imgModel);
                let urlModelo = $(this).data('url');
                $('#editModeloForm').attr('action', urlModelo);
            });
        });
    </script>

    <script>
        Dropzone.autoDiscover = false;

        $(function() {
            let miDropzone = new Dropzone("#modelo-dropzone", {
                url: "#", // No hace llamadas porque el form hace el submit solo
                autoProcessQueue: false,
                maxFiles: 1,
                addRemoveLinks: true,
                dictRemoveFile: "Quitar",
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                init: function() {
                    let dz = this;

                    // Cuando el usuario arrastra o selecciona un archivo
                    dz.on("addedfile", function(file) {
                        if (dz.files.length > 1) {
                            dz.removeFile(dz.files[0]); // Mantiene solo la última
                        }

                        // Inyectamos el archivo al input oculto usando DataTransfer
                        let dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        $('#archivo-real')[0].files = dataTransfer.files;
                    });

                    // Si el usuario borra la foto del Dropzone
                    dz.on("removedfile", function(file) {
                        $('#archivo-real').val(''); // Limpiamos el input oculto
                    });
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                new PNotify({
                    title: '¡Listo!',
                    text: "{{ session('success') }}", // Usamos comillas dobles aquí por seguridad
                    type: 'success',
                });
            });
        </script>
    @endif
@endsection
