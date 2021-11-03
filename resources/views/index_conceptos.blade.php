@extends('layout.app')
@section('titulo','Colegio cabrera - Vacantes')
@section('contenido')

    <div class="toolbar" id="kt_toolbar">
        <!--begin::Header-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="col-12">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 ">Conceptos de pago
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <div class=" text-muted fs-7 fw-bold p-2  col-9 text-end" >
                            Años activos:
                            @foreach ($anios as $anioAc)
                            <a class="btn btn-sm btn-primary" href="{{ route('home.conceptos', ['id_anio'=>$anioAc->MP_ANIO_ID]) }}">
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

    <div class="post " id="kt_post">
        <!--begin::Container-->
            
        <div class="card">
           
          
            <div class="card-body bg-white row p-0 m-0">

                @if(isset($conceptosPago))
                <div class="col-md-3">
                    <hr>
                    <div class="text-center">
                        <!-- Modal: Crear nuevo anio academico -->
                        <h3 class="text-center p-1 lead">Creacion de conceptos</h3>
                        @if (count($conceptosPago)==0)
                        <button type="button" class="btn btn-warning  btn-sm col-md-12 mb-2 " data-toggle="modal"
                            data-target="">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Creacion Masiva
                        </button>
                        @endif

                        <button type="button" id="btn_conceptos_individual" class="btn btn-success  btn-sm col-md-12 mb-2 " data-toggle="modal">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Creacion Individual
                        </button>
                        
                    </div>
                </div>

                <div class="col-md-9 ">
                    <h3 class="text-center p-1 lead ">Informacion de conceptos de pago</h3>
                    @if (count($conceptosPago)>0)
                    <table class="table table-sm table-light table-striped text-center ">
                        <thead class="table-success">
                            <tr>
                                <th colspan="6" class="text-center text-uppercase">Conceptos de pago</th>
                            </tr>
                            <tr>
                                <th class="">Nº</th>
                                <th class="">Codigo</th>
                                <th class="">Nivel</th>
                                <th class="">Tipo Concepto</th>
                                <th class="">Monto</th>
                                <th class="">Local</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php $n = 1; ?>
                            @foreach ($conceptosPago as $concepto)
                            <tr>
                                <td class="text-lowercase  ">{{$n++}}</td>
                                <td class="text-lowercase ">{{$concepto->MP_CONPAGO_ID}}</td>
                                <td class="text-capitalize ">{{Str::lower($concepto->nivel?$concepto->nivel->MP_NIV_NIVEL:"-")}}</td>
                                <td class="text-capitalize text-start">{{Str::lower($concepto->concepto->MP_CON_CONCEPTO)}}</td>
                                <td class="text-lowercase ">{{$concepto->MP_CONPAGO_MONTO}}</td>
                                <td class="text-lowercase ">{{$concepto->local? $concepto->local->MP_LOC_NOM:"-"}}</td>
                                <td>
                                    <!-- MODAL: Editar concepto -->
                                    <button type="button" class=" bg-transparent border-0 text-primary conceptos_pago_update">
                                    <i class="fas fa-edit "></i>
                                    </button>
                                    <!-- MODAL: Eliminar concepto -->
                                    <button type="button"
                                        class="btn-del-vac bg-transparent border-0 text-danger btn-alert-modal">
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

                        @include('modal.modal_conceptos_pago_crear')
                        @include('modal.modal_conceptos_pago_modificar')

                        
                    @else
                    <h5 class="lead p-5 text-center "> <span class="border-bottom border-1 border-secondary"> No se ha encontrado conceptos de pago para el año seleccionado
                            </span></h5>
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
            $("#menu_item_conceptos").addClass('active');

        })
    </script>
    <script src="{{ asset('js/alerta.js') }}"></script>
    <script src="{{ asset('js/conceptos.js') }}"></script>
@endsection
