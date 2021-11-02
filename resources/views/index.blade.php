@extends('layout.app')
@section('titulo','Inicio')

@section('contenido')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Header-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Descripcion.........</small>
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Header-->
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="card-body bg-white">

            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection
