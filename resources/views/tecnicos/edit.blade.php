@section('title')
    Sysnet Perú - Actualizar Técnicos
@endsection
@extends('layouts.app')
@section('style')
@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Técnicos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('tecnicos.edit', $tecnico) }}">Actualizar Técnico</a></li>
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
                        <h5 class="card-title">Actualización de Técnico</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">
                            Este es un formulario para actualizar un técnico. Por favor, complete todos los campos
                            requeridos antes de enviar el formulario.
                        </h6>
                        <form method="POST" action="{{ route('tecnicos.update', $tecnico->id) }}">
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
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" value="{{ $tecnico->nombre }}" required
                                    name="nombre" id="nombre" aria-describedby="NombreHelp">
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI / CE</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="form-control" value="{{ $tecnico->dni }}" required maxlength="12" name="dni"
                                    id="dni" aria-describedby="DniHelp">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                    class="form-control" value="{{ $tecnico->telefono }}" required maxlength="9"
                                    name="telefono" id="telefono" aria-describedby="TelefonoHelp">
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado de Técnicos</label>
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="1" {{ $tecnico->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $tecnico->estado == 0 ? 'selected' : '' }}>Inactivo</option>
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
@endsection
