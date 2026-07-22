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
                        <li class="breadcrumb-item"><a href="{{route('users.edit', $user)}}">Actualizar Usuario</a></li>
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
                                <h5 class="card-title">Actualización de Usuario</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">
                                    Este es un formulario para actualizar un usuario. Por favor, complete todos los campos requeridos antes de enviar el formulario.
                                </h6>
                                <form method="POST" action="{{ route('users.update', $user->id) }}">
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
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" required name="name" id="name" aria-describedby="NombreHelp" placeholder="Liliana Arroyo">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" required name="email" id="email" aria-describedby="CorreoHelp" placeholder="liliana.arroyo@example.com">
                                    </div>

                                    <div class="form-group">
                                        <label for="rol_id">Rol</label>
                                        <select class="form-control" name="rol_id" id="rol_id" required>
                                            <option value="">Seleccione un rol</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado de Cuenta</label>
                                        <select class="form-control" name="estado" id="estado" required>
                                            <option value="">Seleccione un estado</option>
                                            <option value="1" {{ $user->estado == 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $user->estado == 0 ? 'selected' : '' }}>Inactivo</option>
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
