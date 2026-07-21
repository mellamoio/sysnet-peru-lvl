@section('title')
    Sysnet Perú - Lista de Clientes
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
                <h4 class="page-title">Clientes</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Lista de Clientes</a></li>
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
            <div class="col-lg-4">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Registro de Clientes</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">
                            Este es un formulario para crear un nuevo cliente. Por favor, complete todos los campos
                            requeridos antes de enviar el formulario.
                        </h6>
                        <form method="POST" action="{{ route('clientes.store') }}">
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
                                <label for="razon_social">Razon Social</label>
                                <input type="text" class="form-control" required name="razon_social" id="razon_social"
                                    aria-describedby="RazonSocialHelp" placeholder="Sysnet del Perú SAC">
                            </div>
                            <div class="form-group">
                                <label for="ruc">RUC</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="form-control" required maxlength="11" name="ruc" id="ruc"
                                    aria-describedby="RucHelp" placeholder="1234567891">
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" required name="direccion" id="direccion"
                                    aria-describedby="DireccionHelp" placeholder="Av. Santa Rosa 529">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                    class="form-control" required maxlength="9" name="telefono" id="telefono"
                                    aria-describedby="TelefonoHelp" placeholder="987654321">
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado del Cliente</label>
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

            <!-- Start col -->
            <div class="col-lg-8">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h5 class="card-title mb-0">Todos los Clientes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Razón Social</th>
                                        <th>RUC</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $cliente->razon_social }}</td>
                                            <td>{{ $cliente->ruc }}</td>
                                            <td>{{ $cliente->direccion }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>
                                                @if ($cliente->estado == 1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="button-list">
                                                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                                                        class="btn btn-success-rgba"><i class="feather icon-edit-2"></i></a>

                                                    <button type="button" class="btn btn-danger-rgba btn-delete-user"
                                                        data-toggle="modal" data-target="#deleteUserModal"
                                                        data-url="{{ route('clientes.destroy', $cliente->id) }}"
                                                        data-name="{{ $cliente->razon_social }}">
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
            <!-- End col -->

        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
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

            $(document).on('click', '.btn-delete-user', function() {

                let url = $(this).data('url');
                let nombre = $(this).data('name');

                $('#deleteUserForm').attr('action', url);
                $('#userName').text(nombre);

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
