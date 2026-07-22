@section('title')
    Sysnet Perú - Actualizar Cliente
@endsection
@extends('layouts.app')
@section('style')
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
                        <li class="breadcrumb-item"><a href="{{ route('clientes.edit', $cliente) }}">Actualizar Clientes</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Actualización de Clientes</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">
                            Este es un formulario para actualizar un cliente. Por favor, complete todos los campos
                            requeridos antes de enviar el formulario.
                        </h6>
                        <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                            @csrf
                            @method('PUT')
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
                                <input type="text" value="{{ $cliente->razon_social }}" class="form-control" required
                                    name="razon_social" id="razon_social" aria-describedby="RazonSocialHelp"
                                    placeholder="Sysnet del Perú SAC">
                            </div>
                            <div class="form-group">
                                <label for="ruc">RUC</label>
                                <input type="text" value="{{ $cliente->ruc }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" required
                                    maxlength="11" name="ruc" id="ruc" aria-describedby="RucHelp"
                                    placeholder="1234567891">
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" value="{{ $cliente->direccion }}" class="form-control" required
                                    name="direccion" id="direccion" aria-describedby="DireccionHelp"
                                    placeholder="Av. Santa Rosa 529">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel" value="{{ $cliente->telefono }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                    class="form-control" required maxlength="9" name="telefono" id="telefono"
                                    aria-describedby="TelefonoHelp" placeholder="987654321">
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado del Cliente</label>
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="1" {{ $cliente->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $cliente->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Pnotify js -->
    <script src="{{ asset('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>

    @if (session('error'))
        <script>
            $(document).ready(function() {
                new PNotify({
                    title: '¡Lo siento!',
                    text: "{{ session('error') }}", // Usamos comillas dobles aquí por seguridad
                    type: 'danger',
                });
            });
        </script>
    @endif
@endsection
