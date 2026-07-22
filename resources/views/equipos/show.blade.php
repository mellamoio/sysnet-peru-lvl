@section('title')
    Sysnet Perú - Detalle de Equipo
@endsection
@extends('layouts.app')
@section('style')
    <!-- Slick css -->
    <link href="{{ asset('assets/plugins/slick/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/slick/slick-theme.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Equipos</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('equipos.show', $equipo) }}">Detalle de Equipo</a>
                        </li>
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
            <div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-xl-5">
                                <img src="{{ asset('storage/' . $equipo->modelo->url_imagen) }}" width="100%"
                                    loading="lazy" />
                            </div>
                            <div class="col-lg-6 col-xl-7">
                                <p><span class="badge badge-light font-16">{{ $equipo->modelo->nombre }}</span></p>
                                <h2 class="font-22">{{ $equipo->modelo->tipoProducto->nombre ?? 'Sin Categoría' }}</h2>

                                <p class="text-primary font-16 f-w-7 my-3">
                                    {{ $equipo->modelo->marca->nombre ?? 'Sin Marca' }}</p>
                                <p class="mb-4">{{ $equipo->modelo->tipoProducto->descripcion ?? 'Sin Descripción' }}</p>

                                <div class="button-list mb-5">
                                    <h3 class="font-20 mb-3">Observaciones</h3>
                                    <div>
                                        {{ $equipo->observaciones }}
                                    </div>
                                </div>

                                <div class="button-list mt-3">
                                    <a href="{{ route('equipos.pdf', $equipo) }}" class="btn btn-primary-rgba font-18"><i
                                            class="feather icon-file-text mr-2"></i>Descargar Ficha PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs custom-tab-line mb-3" id="defaultTabLine" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="description-tab-line" data-toggle="tab"
                                    href="#description-line" role="tab" aria-controls="description-line"
                                    aria-selected="true"><i class="feather icon-file-text mr-2"></i>Description</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="defaultTabContentLine">
                            <div class="tab-pane fade show active" id="description-line" role="tabpanel"
                                aria-labelledby="description-tab-line">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged.</p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged.</p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->

        <!-- Start row -->
        <div class="row">
            <!-- Start col -->

            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
@endsection
@section('script')
    <!-- Slick js -->
    <script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-ecommerce-single-product.js') }}"></script>
@endsection
