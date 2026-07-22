@section('title')
    Sysnet Perú - Lista de Productos
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
                <h4 class="page-title">Productos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('equipos.index') }}">Lista de Productos</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h5 class="card-title mb-0">Todos los Equipos</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Producto</th>
                                        <th>Modelo</th>
                                        <th>IMEI</th>
                                        <th>Estado</th>
                                        <th>Disponibilidad</th>
                                        <th>Observación</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipos as $equipo)
                                        <tr>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $equipo->tipoProducto->nombre }}</td>
                                            <td>
                                                @if (!$equipo->modelo->url_imagen)
                                                    <img src="{{ asset('assets/images/ui-images/image-rounded.jpg') }}"
                                                        width="100" loading="lazy" class="rounded" />
                                                @else
                                                    <img src="{{ asset('storage/' . $equipo->modelo->url_imagen) }}"
                                                        width="100" loading="lazy" class="rounded" />
                                                @endif
                                            </td>
                                            <td>{!! DNS1D::getBarcodeSVG($equipo->imei, 'C128', 2, 40) !!}</td>
                                            <td>
                                                @if ($equipo->estado->id == 1)
                                                    <span class="badge badge-success">{{ $equipo->estado->nombre }}</span>
                                                @elseif ($equipo->estado->id == 2)
                                                    <span class="badge badge-warning">{{ $equipo->estado->nombre }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $equipo->estado->nombre }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$equipo->disponible)
                                                    <span class="alert d-block alert-danger text-center" role="alert"><i
                                                            class="feather icon-x-circle"></i> No disponible</span>
                                                @else
                                                    <span class="alert d-block alert-success text-center" role="alert"><i
                                                            class="feather icon-check-square"></i> Disponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    {!! $equipo->observaciones ?? '<span class="text-muted">Sin observaciones</span>' !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="button-list">
                                                    <a href="{{ route('equipos.show', $equipo->id) }}"
                                                        class="btn btn-primary-rgba"><i class="feather icon-eye"></i></a>

                                                    <button type="button" class="btn btn-success-rgba btn-edit-producto"
                                                        data-toggle="modal" data-target="#editProductoModal"
                                                        data-id="{{ $equipo->id }}"
                                                        data-url="{{ route('equipos.update', $equipo->id) }}">
                                                        <i class="feather icon-edit-2"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger-rgba btn-delete-user"
                                                        data-toggle="modal" data-target="#deleteUserModal"
                                                        data-url="{{ route('equipos.destroy', $equipo->id) }}"
                                                        data-name="{{ $equipo->imei }}">
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
                        ¿Deseas eliminar el producto
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

    <!-- Modal de Producto -->
    <div class="modal fade" id="editProductoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="editProductoForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Editar Producto
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_imei">IMEI</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="form-control" required name="imei" id="edit_imei" aria-describedby="ImeiHelp"
                                placeholder="123451848118545434">
                        </div>

                        <div class="form-group">
                            <label for="edit_modelo_id">Modelo</label>
                            <select class="form-control" name="modelo_id" id="edit_modelo_id" required>
                                <option value="">Seleccione un modelo</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_estado_id">Estado del producto</label>
                            <select class="form-control" name="estado_id" id="edit_estado_id" required>
                                <option value="">Seleccione un estado</option>
                                @foreach ($estadosEquipo as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_disponible">Disponibilidad</label>
                            <select class="form-control" name="disponible" id="edit_disponible" required>
                                <option value="">Seleccione un estado</option>
                                <option value="1">Disponible</option>
                                <option value="0">No Disponible</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_observaciones">Observaciones</label>
                            <textarea class="form-control" name="observaciones" id="edit_observaciones"></textarea>
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

            $(document).on('click', '.btn-delete-user', function() {

                let url = $(this).data('url');
                let nombre = $(this).data('name');

                $('#deleteUserForm').attr('action', url);
                $('#userName').text(nombre);

            });

            $(document).on('click', '.btn-edit-producto', function() {
                let id = $(this).data('id');
                let url = $(this).data('url');

                // getProducto retorna la petición AJAX y .done se ejecuta cuando la respuesta llega
                getProducto(id).done(function(dataProduct) {
                    console.log('Producto recibido:', dataProduct);

                    if (dataProduct) {
                        // Asignamos los valores a los inputs del modal
                        $('#edit_imei').val(dataProduct.imei);
                        $('#edit_modelo_id').val(dataProduct.modelo_id);
                        $('#edit_estado_id').val(dataProduct.estado_id);
                        $('#edit_disponible').val(Number(dataProduct.disponible));

                        // Si observaciones usa Summernote
                        if ($('#edit_observaciones').next('.note-editor').length) {
                            $('#edit_observaciones').summernote('code', dataProduct.observaciones ||
                                '');
                        } else {
                            $('#edit_observaciones').val(dataProduct.observaciones);
                        }

                        // Actualizamos el action del formulario para el Update
                        $('#editProductoForm').attr('action', url);
                    }
                }).fail(function(xhr, status, error) {
                    console.error('Error al obtener la información del producto:', error);
                });
            });

            // La función solo RETORNA el $.ajax
            function getProducto(id) {
                let urlData = "{{ route('equipos.edit', ':id') }}".replace(':id', id);

                return $.ajax({
                    url: urlData,
                    type: 'GET',
                    dataType: 'json'
                });
            }
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
