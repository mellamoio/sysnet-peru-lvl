@section('title')
    Sysnet Perú - Registrar Equipos
@endsection
@extends('layouts.app')
@section('style')
    <!-- Summernote css -->
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css">
    <!-- Pnotify css -->
    <link href="{{ asset('assets/plugins/pnotify/css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Equipos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('equipos.create') }}">Crear Productos</a></li>
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
            <!-- Start col -->
            <div class="col-lg-5 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tipo de Registros</h5>
                    </div>
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2 active" id="v-pills-individual-tab" data-toggle="pill"
                                href="#v-pills-individual" role="tab" aria-controls="v-pills-individual"
                                aria-selected="true"><i class="feather icon-package mr-2"></i>Registro Individual</a>
                            <a class="nav-link mb-2" id="v-pills-faster-tab" data-toggle="pill" href="#v-pills-faster"
                                role="tab" aria-controls="v-pills-faster" aria-selected="false"><i
                                    class="feather icon-grid mr-2"></i>Captura Rápida (Multilínea)</a>
                            <a class="nav-link mb-2" id="v-pills-massive-tab" data-toggle="pill" href="#v-pills-massive"
                                role="tab" aria-controls="v-pills-massive" aria-selected="false"><i
                                    class="feather icon-file-text mr-2"></i>Importación Masiva (Excel)</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
            <!-- Start col -->
            <div class="col-lg-7 col-xl-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Dashboard Start -->
                    <div class="tab-pane fade show active" id="v-pills-individual" role="tabpanel"
                        aria-labelledby="v-pills-individual-tab">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Producto</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('equipos.store') }}">
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
                                        <label for="name">IMEI</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            class="form-control" required name="imei" id="imei"
                                            aria-describedby="ImeiHelp" placeholder="123451848118545434">
                                    </div>

                                    <div class="form-group">
                                        <label for="modelo_id">Modelo</label>
                                        <select class="form-control" name="modelo_id" id="modelo_id" required>
                                            <option value="">Seleccione un modelo</option>
                                            @foreach ($modelos as $modelo)
                                                <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado_id">Estado del producto</label>
                                        <select class="form-control" name="estado_id" id="estado_id" required>
                                            <option value="">Seleccione un estado</option>
                                            @foreach ($estadosEquipo as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="disponible">Disponibilidad</label>
                                        <select class="form-control" name="disponible" id="disponible" required>
                                            <option value="">Seleccione un estado</option>
                                            <option value="1">Disponible</option>
                                            <option value="0">No Disponible</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="observaciones"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Dashboard End -->
                    <!-- My Orders Start -->
                    <div class="tab-pane fade" id="v-pills-faster" role="tabpanel" aria-labelledby="v-pills-faster-tab">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Carga rápida de productos</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('equipos.store_batch') }}" id="form-multilinea">
                                    @csrf

                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle" id="tabla-multilinea">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>IMEI <span class="text-danger">*</span></th>
                                                    <th>Modelo <span class="text-danger">*</span></th>
                                                    <th>Estado <span class="text-danger">*</span></th>
                                                    <th>Disponibilidad <span class="text-danger">*</span></th>
                                                    <th>Observación</th>
                                                    <th style="text-align: center;"><i class="feather icon-trash-2"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="container-filas">
                                                <!-- Fila por defecto (Fila 0) -->
                                                <tr class="fila-equipo">
                                                    <td>
                                                        <input type="text" name="equipos[0][imei]"
                                                            class="form-control input-imei"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="IMEI (14-18 dígitos)" required maxlength="18">
                                                    </td>
                                                    <td>
                                                        <select name="equipos[0][modelo_id]" class="form-control"
                                                            required>
                                                            <option value="">Seleccione modelo</option>
                                                            @foreach ($modelos as $modelo)
                                                                <option value="{{ $modelo->id }}">{{ $modelo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="equipos[0][estado_id]" class="form-control"
                                                            required>
                                                            <option value="">Seleccione estado</option>
                                                            @foreach ($estadosEquipo as $estado)
                                                                <option value="{{ $estado->id }}">{{ $estado->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="equipos[0][disponible]" class="form-control"
                                                            required>
                                                            <option value="1">Disponible</option>
                                                            <option value="0">No Disponible</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="equipos[0][observaciones]"
                                                            class="form-control" placeholder="Nota rápida...">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm btn-remove-row" disabled>
                                                            <i class="feather icon-x"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <button type="button" class="btn btn-secondary" id="btn-add-row-bottom">
                                            <i class="feather icon-plus mr-1"></i>Agregar otra fila
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="feather icon-save mr-1"></i>Registrar Equipos
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- My Orders End -->
                    <!-- My Addresses Start -->
                    <div class="tab-pane fade" id="v-pills-massive" role="tabpanel"
                        aria-labelledby="v-pills-massive-tab">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Importación Masiva desde Excel</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="feather icon-info mr-2"></i>
                                    Descarga la plantilla de ejemplo para asegurarte de que los encabezados del archivo
                                    coincidan exactamente con la estructura requerida.
                                    <a href="{{ route('equipos.plantilla') }}" class="btn btn-sm btn-outline-info ml-3"><i
                                            class="feather icon-download"></i> Descargar Plantilla</a>
                                </div>

                                <form id="form-import-excel" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group my-4">
                                        <label for="archivo_excel"><strong>Seleccionar Archivo Excel (.xlsx, .xls,
                                                .csv)</strong></label>
                                        <input type="file" class="form-control-file" id="archivo_excel"
                                            name="archivo_excel" accept=".xlsx, .xls, .csv" required>
                                    </div>

                                    <button type="submit" class="btn btn-success" id="btn-importar-excel">
                                        <i class="feather icon-upload-cloud mr-1"></i> Importar Archivo
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- My Addresses End -->
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')
    <!-- Pnotify js -->
    <script src="{{ asset('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- Summernote JS -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-ecommerce-myaccount.js') }}"></script>
    <script>
        /* -- Form Editors - Summernote -- */
        $('#observaciones').summernote({
            height: 320,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    </script>

    <script>
        $(document).ready(function() {
            let rowIndex = 1;

            const modelosOptions =
                `@foreach ($modelos as $m)<option value="{{ $m->id }}">{{ $m->nombre }}</option>@endforeach`;
            const estadosOptions =
                `@foreach ($estadosEquipo as $e)<option value="{{ $e->id }}">{{ $e->nombre }}</option>@endforeach`;

            // Función para agregar una nueva fila
            function addRow() {
                let newRow = `
            <tr class="fila-equipo">
                <td>
                    <input type="text" name="equipos[${rowIndex}][imei]" class="form-control input-imei" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                           placeholder="IMEI (14-18 dígitos)" required maxlength="18">
                </td>
                <td>
                    <select name="equipos[${rowIndex}][modelo_id]" class="form-control" required>
                        <option value="">Seleccione modelo</option>
                        ${modelosOptions}
                    </select>
                </td>
                <td>
                    <select name="equipos[${rowIndex}][estado_id]" class="form-control" required>
                        <option value="">Seleccione estado</option>
                        ${estadosOptions}
                    </select>
                </td>
                <td>
                    <select name="equipos[${rowIndex}][disponible]" class="form-control" required>
                        <option value="1">Disponible</option>
                        <option value="0">No Disponible</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="equipos[${rowIndex}][observaciones]" class="form-control" placeholder="Nota rápida...">
                </td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-danger btn-sm btn-remove-row">
                        <i class="feather icon-x"></i>
                    </button>
                </td>
            </tr>
        `;

                $('#container-filas').append(newRow);
                rowIndex++;
                updateRemoveButtons();
            }

            // Eventos para agregar fila
            $('#btn-add-row, #btn-add-row-bottom').on('click', function() {
                addRow();
            });

            // Evento para eliminar fila
            $(document).on('click', '.btn-remove-row', function() {
                if ($('.fila-equipo').length > 1) {
                    $(this).closest('tr').remove();
                    updateRemoveButtons();
                }
            });

            // Control del estado del botón eliminar
            function updateRemoveButtons() {
                let totalFilas = $('.fila-equipo').length;
                if (totalFilas === 1) {
                    $('.btn-remove-row').attr('disabled', true);
                } else {
                    $('.btn-remove-row').removeAttr('disabled');
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#form-import-excel').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let $btn = $('#btn-importar-excel');
                let originalBtnHtml = $btn.html();

                // 1. Deshabilitar botón
                $btn.prop('disabled', true).html(
                    '<i class="feather icon-loader spin mr-1"></i> Subiendo e importando...');

                // 2. Notificación PNotify de carga
                let noticeProcessing = new PNotify({
                    title: 'Importando datos',
                    text: 'Leyendo y validando el archivo Excel...',
                    type: 'info',
                    icon: 'feather icon-refresh-cw spin',
                    hide: false
                });

                // 3. Petición AJAX para enviar archivos
                $.ajax({
                    url: "{{ route('equipos.import_excel') }}",
                    type: "POST",
                    data: formData,
                    processData: false, // Requerido para envío de archivos
                    contentType: false, // Requerido para envío de archivos
                    dataType: "json",
                    success: function(response) {
                        noticeProcessing.remove();

                        new PNotify({
                            title: '¡Importación Exitosa!',
                            text: response.message,
                            type: 'success',
                            delay: 5000
                        });

                        // Resetear el campo del archivo
                        $('#form-import-excel')[0].reset();
                    },
                    error: function(xhr) {
                        noticeProcessing.remove();

                        let errorHtml = '';

                        if (xhr.status === 422 && xhr.responseJSON) {
                            // Si viene una lista de errores por filas desde el backend
                            if (xhr.responseJSON.errors) {
                                let errors = xhr.responseJSON.errors;
                                errorHtml = '<ul class="mb-0 pl-3">';

                                if (Array.isArray(errors)) {
                                    $.each(errors, function(index, msg) {
                                        errorHtml += '<li>' + msg + '</li>';
                                    });
                                } else {
                                    $.each(errors, function(key, messages) {
                                        errorHtml += '<li>' + messages[0] + '</li>';
                                    });
                                }
                                errorHtml += '</ul>';
                            }
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml = xhr.responseJSON.message;
                        } else {
                            errorHtml =
                            'Ocurrió un problema inesperado al importar el archivo.';
                        }

                        new PNotify({
                            title: 'Error en la Importación',
                            text: errorHtml,
                            type: 'error',
                            delay: 7000
                        });
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
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
