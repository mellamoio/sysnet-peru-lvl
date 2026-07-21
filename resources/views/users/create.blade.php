@section('title')
    Sysnet Perú - Lista de Usuarios
@endsection
@extends('layouts.app')
@section('style')
@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Usuarios</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('users.create') }}">Crear Usuario</a></li>
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
                        <h5 class="card-title">Registro de Usuario</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">
                            Este es un formulario para crear un nuevo usuario. Por favor, complete todos los campos
                            requeridos antes de enviar el formulario.
                        </h6>
                        <form method="POST" action="{{ route('users.store') }}">
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
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" required name="name" id="name"
                                    aria-describedby="NombreHelp" placeholder="Liliana Arroyo">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" required name="email" id="email"
                                    aria-describedby="CorreoHelp" placeholder="liliana.arroyo@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" required name="password" id="password"
                                    placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input type="password" class="form-control" required name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirmar Password">
                            </div>

                            <div class="form-group">
                                <label for="rol_id">Rol</label>
                                <select class="form-control" name="rol_id" id="rol_id" required>
                                    <option value="">Seleccione un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado de Cuenta</label>
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
        </div>
    </div>
@endsection
@section('script')
@endsection
