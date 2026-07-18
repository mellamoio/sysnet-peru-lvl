@section('title')
    Sysnet Perú - Marcas & Modelos
@endsection
@extends('layouts.app')
@section('style')
    <!-- DataTables css -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Listado</a></li>
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
                    <div class="col-lg-12">
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
                                        <label for="nombre">Razon Social</label>
                                        <input type="text" class="form-control" required name="nombre" id="nombre"
                                            aria-describedby="NombreHelp" placeholder="Telefónica">
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado de la Marca</label>
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
                                <form method="POST" action="{{ route('modelos.store') }}">
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
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" required name="nombre" id="nombre"
                                            aria-describedby="NombreHelp" placeholder="Telefónica">
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Marca</label>
                                        <select class="form-control" name="estado" id="estado" required>
                                            <option value="">Seleccione una Marca</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->id }}">{{$marca->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Registrar</button>
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
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modelos as $modelo)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>{{ $modelo->nombre }}</td>
                                                    <td>
                                                        {{ $modelo->marca->nombre }}
                                                    </td>
                                                    <td>
                                                        <div class="button-list">
                                                            <button type="button"
                                                                class="btn btn-success-rgba btn-edit-marca"
                                                                data-toggle="modal" data-target="#editMarcaModal"
                                                                data-id="{{ $modelo->id }}"
                                                                data-nombre="{{ $modelo->nombre }}"
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
                        ¿Deseas eliminar al cliente
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

@endsection
@section('script')
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
            $('.datatable-special').DataTable( {
                "order": [[ 3, "desc" ]],
                responsive: true
            } );

            $('.btn-delete-user').on('click', function() {
                let url = $(this).data('url');
                let nombre = $(this).data('name');
                $('#deleteUserForm').attr('action', url);
                $('#userName').text(nombre);
            });

            $('.btn-edit-marca').on('click', function() {
                let id = $(this).data('id');
                let nombre = $(this).data('nombre');
                let estado = $(this).data('estado');
                $('#edit_nombre').val(nombre);
                $('#edit_estado').val(estado);
                console.log(estado);
                let url = $(this).data('url');
                $('#editMarcaForm').attr('action', url);
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
