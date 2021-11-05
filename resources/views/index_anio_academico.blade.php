@extends('layout.app')
@section('titulo','Colegio cabrera - Año academico')
@section('contenido')


<div class="toolbar" id="kt_toolbar">
    <!--begin::Header-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Año Academico
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <small class="text-muted fs-7 fw-bold my-1 ms-1">Gestion de años academicos</small>
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Header-->
</div>

<div class="post " id="kt_post">
    <!--begin::Container-->
    <div class="card">
      
        <div class="card-body bg-white row">
            <div class="col-md">
                <h3 class="text-center p-1 lead">Crear nuevo año academico</h3>
                <hr>
                <div class="text-center">        
                    <!-- Modal: Crear nuevo anio academico -->
                    <button type="button" class="btn btn-primary  btn-sm" data-toggle="modal" id="btn_crear_anio" >
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Crear Año Academico
                    </button>
                </div>
            
            </div>
            <div class="col-md-5 m-3">
                    <table class="table table-sm table-light table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th colspan="2 " id="prueba">Años Academicos</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase ">Año</th>
                                <th class="text-uppercase ">Estado</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($anios as $anio)
                            <tr>
                                <td>{{$anio->MP_ANIO_NOMBRE}}</td>
                                <td>{{$anio->MP_ANIO_ESTADO}} </td>
                                <td class="bg-white text-start " style="width: 100px;">
                                    <button type="button" class="btn btn-sm bg-transparent  edit-m" style="color: red;" 
                                    data-anio-anio="{{$anio->MP_ANIO_ID}}" 
                                    data-anio-fInicio="{{$anio->MP_ANIO_FECHAINICIO}}"
                                    data-anio-fFin="{{$anio->MP_ANIO_FECHAFIN}}"
                                    data-anio-descripcion="{{$anio->MP_ANIO_DESCRIPCION}}" 
                                    data-anio-nombre="{{$anio->MP_ANIO_NOMBRE}}" 
                                    data-anio-estado="{{$anio->MP_ANIO_ESTADO}}"
                                    data-toggle="modal" 
                                    data-target=".bd-modal-anio-academico-edit">
                                        <i class="fas fa-edit  "></i>
                                    </button>
                                            
                                        <!-- MODAL: Eliminar anio -->
                                        <button type="button"
                                                class="btn-del-vac bg-transparent border-0 text-danger btn-alert-modal"
                                                data_modal_alerta_mensaje="¿ Esta seguro de eliminar el año academico  '{{$anio->MP_ANIO_NOMBRE}}'
                                                'identificado con codigo {{$anio->MP_ANIO_ID}} ?
                                                    <br><br>
                                                    <p  class='small text-danger text-right'><span> Solo se eliminaran años que no tengan registradas vacantes, conceptos, etc</span></p>
                                        "
                                                data_modal-alert-target="{{ route('anio.delete', ['id'=>$anio->MP_ANIO_ID]) }}
                                                ">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>

    <!--Begin ::Modals-->
    @include('modal.modal_anio_academico')
    @include('modal.modal_anio_academico_edit')
    @include('modal.modal_alerta_confirmacion')

    <!--End ::Modals-->

@endsection

@section('scripts')

    <script>
        $(() => {
            //alert("asdas")
            $(".aside-menu .menu-item .menu-link ").removeClass('active');
            $("#menu_item_anio").addClass('active');

        })
    </script>

    <script src="{{ asset('js/anio.js') }}"></script>   
    <script src="{{ asset('js/alerta.js') }}"></script>   
@endsection



