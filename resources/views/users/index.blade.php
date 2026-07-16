@section('title')
    Sysnet Perú - Lista de Usuarios
@endsection
@extends('layouts.app')
@section('style')
<style>
    /* Add your custom styles here */
    .container-fluid{
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
                <h4 class="page-title">Usuarios</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Lista de Usuarios</a></li>
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
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h5 class="card-title mb-0">Todos los usuarios</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>#{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->rol->nombre ?? 'Sin rol' }}</td>
                                            <td>{{ $user->created_at ?? 'Sin fecha' }}</td>
                                            <td>
                                                <div class="button-list">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success-rgba"><i class="feather icon-edit-2"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger-rgba" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')"><i class="feather icon-trash"></i></button>
                                                    </form>
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

@endsection
@section('script')
<!-- Pnotify js -->
<script src="{{ asset('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-pnotify.js') }}"></script>

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
