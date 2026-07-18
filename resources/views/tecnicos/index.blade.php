@section('title')
    Sysnet Perú - Lista de Técnicos
@endsection
@extends('layouts.app')
@section('style')
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
                <h4 class="page-title">Técnicos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Lista de Técnicos</a></li>
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
                        <h5 class="card-title">Registro de Técnicos</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">
                            Este es un formulario para crear un nuevo técnico. Por favor, complete todos los campos
                            requeridos antes de enviar el formulario.
                        </h6>
                        <form method="POST" action="{{ route('tecnicos.store') }}">
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
                                    aria-describedby="NombreHelp" placeholder="Jesús Arroyo">
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI / CE</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="form-control" required maxlength="12" name="dni" id="dni"
                                    aria-describedby="DniHelp" placeholder="12345678">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                    class="form-control" required maxlength="9" name="telefono" id="telefono"
                                    aria-describedby="TelefonoHelp" placeholder="987654321">
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado de Técnico</label>
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
                                <h5 class="card-title mb-0">Todos los técnicos</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tecnicos as $tecnico)
                                        <tr>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $tecnico->nombre }}</td>
                                            <td>{{ $tecnico->dni }}</td>
                                            <td>{{ $tecnico->telefono }}</td>
                                            <td>
                                                @if ($tecnico->estado == 1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="button-list">
                                                    <a href="{{ route('tecnicos.edit', $tecnico->id) }}"
                                                        class="btn btn-success-rgba"><i class="feather icon-edit-2"></i></a>

                                                    <button type="button" class="btn btn-danger-rgba btn-delete-user"
                                                        data-toggle="modal" data-target="#deleteUserModal"
                                                        data-url="{{ route('tecnicos.destroy', $tecnico->id) }}"
                                                        data-name="{{ $tecnico->nombre }}">
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
                        ¿Deseas eliminar al técnico
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
    <!-- Pnotify js -->
    <script src="{{ asset('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-pnotify.js') }}"></script>

    <script>
        $(function() {

            $('.btn-delete-user').on('click', function() {

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
