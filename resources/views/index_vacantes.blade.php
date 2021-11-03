@extends('layout.app')
@section('titulo','Colegio cabrera - Vacantes')
@section('contenido')


<div class="toolbar" id="kt_toolbar">
    <!--begin::Header-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="col-12">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 ">Vacantes
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <div class=" text-muted fs-7 fw-bold p-2  col-10 text-end" >
                        Años activos:
                        @foreach ($anios as $anioAc)
                        <a class="btn btn-sm btn-primary" href="{{ route('home.vacantes', ['id_anio'=>$anioAc->MP_ANIO_ID]) }}">
                            {{$anioAc->MP_ANIO_NOMBRE}}  {{$anioAc->MP_ANIO_ID}}
                        </a>
                        @endforeach
                    </div> 
            </h1>
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Header-->
</div>

<div class="post m-2" id="kt_post">
    <!--begin::Container-->
    <div class="card">

        
        <hr>
        <div class="card-body bg-white row p-0 m-0">

            @if(isset($vacantes))
            <div class="col-md-4">
                <hr>
                <div class="text-center">
                    <!-- Modal: Crear nuevo anio academico -->
                    <h3 class="text-center p-1 lead">Creacion de secciones</h3>
                    @if (count($vacantes)==0)
                    <button type="button" id="btn_crear_vacantes_masivo" class="btn btn-warning  btn-sm col-md-12 mb-2 " data-toggle="modal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Creacion Masiva
                    </button>
                    @include('modal.modal_vacantes_masivo')
                    @endif

                    <button type="button" id="btn_crear_vacantes_individual" class="btn btn-success  btn-sm col-md-12 mb-2 " data-toggle="modal"
                        data-target="">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Creacion Individual
                    </button>
                    
                @include('modal.modal_vacante_crear')
                </div>
            </div>

            <div class="col-md-8 ">
                <h3 class="text-center p-1 lead ">Informacion de vacantes por secciones</h3>
                @if (count($vacantes)>0)
                <table class="table table-sm table-light table-striped text-center ">
                    <thead class="table-success">
                        <tr>
                            <th colspan="8" class="text-center text-uppercase">Vacantes</th>
                        </tr>
                        <tr>
                            <th class="">Nº</th>
                            <th class="">Codigo</th>
                            <th class="">Local</th>
                            <th class="">Grado</th>
                            <th class="">Seccion</th>
                            <th class="">V. Totales</th>
                            <th class="">V. Ocupadas</th>
                            <th class="">V. Disponibles</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php $n = 1; ?>
                        @foreach ($vacantes as $vacante)
                        <tr>
                            <td class="text-uppercase ">{{$n++}}</td>
                            <td class="text-uppercase ">{{$vacante->grado->MP_GRA_GRADO}}</td>
                            <td class="text-capitalize ">{{Str::lower($vacante->local->MP_LOC_NOM)}}</td>
                            <td class="text-uppercase ">{{$vacante->seccion->MP_SEC_NOMBRE}}</td>
                            <td class="text-uppercase ">{{$vacante->MP_SEC_ID}}</td>
                            <td class="text-uppercase ">{{$vacante->MP_VAC_TOT}}</td>
                            <td class="text-uppercase ">{{$vacante->MP_VAC_OCU}}</td>
                            <td class="text-uppercase ">{{$vacante->MP_VAC_DISP}}</td>
                            <td>
                                <!-- MODAL: Editar vacante -->
                                <button type="button" class="btn-edit-vac bg-transparent border-0 text-primary"
                                data-modal-vacante-id={{$vacante->MP_VAC_ID}}
                                data-modal-vacante-grado={{$vacante->grado->MP_GRA_GRADO}}
                                data-modal-vacante-seccion={{$vacante->seccion->MP_SEC_NOMBRE}}
                                data-modal-vacante-local={{$vacante->local->MP_LOC_NOM}}
                                data-modal-vacante-nivel={{$vacante->nivel->MP_NIV_NIVEL}}
                                data-modal-vacante-vac-totales={{$vacante->MP_VAC_TOT}}>
                                <i class="fas fa-edit    "></i>
                                </button>
                                <!-- MODAL: Eliminar vacante -->
                                <button type="button"
                                    class="btn-del-vac bg-transparent border-0 text-danger btn-alert-modal"
                                    data_modal_alerta_mensaje="¿ Esta seguro de eliminar las vacantes para {{$vacante->grado->MP_GRA_GRADO}}
                                    '{{$vacante->seccion->MP_SEC_NOMBRE}}' de nivel {{$vacante->nivel->MP_NIV_NIVEL}}?
                                        <br><br>
                                        <p  class='small text-danger text-right'><span>Una vez eliminado, no hay vuelta atras</span></p>
                            "
                                    data_modal-alert-target="{{ route('vacantes.delete', ['id'=>$vacante->MP_VAC_ID]) }}
                                    ">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <br>
                @include('modal.modal_vacante_edit')
                @include('modal.modal_alerta_confirmacion')
                @else
                <h5 class="lead p-5 text-center "> <span class="border-bottom border-1 border-secondary"> No hay vacantes
                        registradas</span></h5>
                @endif
            </div>
            @else
            <h5 class="lead p-5 text-center col-12">Tiene mas de un año academico activo, para acceder<b> seleccione un año en especifico</b> </h5>
            @endif
        </div>
    </div>
    <!--end::Container-->
</div>
@endsection

@section('scripts')
    <script>
        $(() => {
            //alert("asdas")
            $(".aside-menu .menu-item .menu-link ").removeClass('active');
            $("#menu_item_vacantes").addClass('active');
        })
    </script>
    <script src="{{ asset('js/vacante.js') }}"></script>
    <script src="{{ asset('js/alerta.js') }}"></script>
@endsection
