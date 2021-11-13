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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Estadisticas del año academico</small>
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Header-->
    </div>

    <div class="post d-flex flex-column-fluid row justify-content-around" id="kt_post">
        <!--begin::Container-->
        <div class="card col-md-5 border border-1 border-secondary shadow  ">
            <div class="card-header border-bottom-4 border-secondary  ">   
                <h3 class="lead text-center m-5  d-block w-100 justify-content-center">Año Academico </h3>
            </div>
            <div class="card-body bg-white">
                <div class="form-group d-flex justify-content-around">
                    <label class="col-4 text-right " for="anioRead">Año: </label>
                    <input class="col-7 disabled border-1 border-secondary border" readonly disabled type="text" id="anioRead" value="{{$anioActual->MP_ANIO_NOMBRE}}" >
                </div>
                <br>
                <div class="form-group d-flex justify-content-around">
                    <label class="col-4 text-right" for ="descripcionRead">Descripcion: </label>
                    <textarea  class="col-7 disabled border-1 border-secondary border " style="resize: none;" readonly disabled id="descripcionRead" rows="3" >{{$anioActual->MP_ANIO_DESCRIPCION}}</textarea>
                </div>
                <br>
                <div class="form-group d-flex justify-content-around">
                    <label class="col-4 text-right " for="inicioRead">Inicio: </label>
                    <input class="col-7 disabled border-1 border-secondary border" readonly disabled type="text" id="inicioRead" value="{{  Str::substr($anioActual->MP_ANIO_FECHAINICIO,0,10)}}" >
                </div>
                <br>
                <div class="form-group d-flex justify-content-around">
                    <label class="col-4 text-right " for="finRead">Fin: </label>
                    <input class="col-7 disabled border-1 border-secondary border" readonly disabled type="text" id="finRead" value="{{ Str::substr($anioActual->MP_ANIO_FECHAFIN,0,10)}}" >
                </div>

            </div>
        </div>
        <div class="card col-md-5 border border-1 border-secondary shadow  ">
            <div class="card-header border-bottom-4 border-secondary  ">   
                <h3 class="lead text-center m-5  d-block w-100 justify-content-center"> Vacantes </h3>
            </div>
            <div class="card-body bg-white">
                <form >

                    <div class="form-group d-flex justify-content-around">
                        <label for="Local"  class="col-4 text-end  ">Local</label>
                        
                        <select id="LocalForm" class="col-7">
                            @foreach ($locales as $local)
                                <option value="{{$local->MP_LOC_ID}}">{{$local->MP_LOC_NOM}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group d-flex justify-content-around">
                        <label for="nivel" class="col-4 text-end " >Nivel</label>
                        
                        <select id="nivelForm" class="col-7">
                            @foreach ($niveles as $nivel)
                                <option value="{{$nivel->MP_NIV_ID }}">{{$nivel->MP_NIV_NIVEL }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <hr>
                <div class="tableForm" id="tableFom" class="bg-dark" data-origin= {{ route('home.vacantesdashboard', ['id_anio'=> $anioActual->MP_ANIO_ID]) }} >
                    <table class="w-100 table-success table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="6">Vacantes en el año {{$anioActual->MP_ANIO_NOMBRE}}</th>
                            </tr>
                            <tr>
                                <th class="text-center">N®</th>
                                <th class="text-center">Local</th>
                                <th class="text-center">Grado</th>
                                <th class="text-center">Seccion</th>
                                <th class="text-center">V.Disponibles</th>
                                <th class="text-center">V.Ocupadas</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_vacantes">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <!--end::Container-->
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/index_dashboard.js') }}"></script>
<script>
    $(() => {
        //alert("asdas")
        $(".aside-menu .menu-item .menu-link ").removeClass('active');
        $("#menu_item_inicio").addClass('active');
    })
</script>
@endsection

