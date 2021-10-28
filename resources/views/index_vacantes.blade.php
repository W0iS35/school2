
@extends('layout.app')
@section('titulo','Colegio cabrera - Vacantes')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center lead fs-2 p-3 bg-light text-uppercase">Vacantes</h3>  
        </div>

        <div class="p-2 text-right"> 
            Años activos:
            @foreach ($anios as $anio)
                <a class="btn btn-sm btn-primary" href="{{ route('home.vacantes', ['id_anio'=>$anio->MP_ANIO_ID]) }}">
                    {{$anio->MP_ANIO_NOMBRE}}
                </a>
            @endforeach

        </div>
        <hr>
        <div class="card-body bg-white row p-0 m-0">
            
            @if(isset($vacantes))
            <div class="col-md-3">
                <hr>
                <div class="text-center">        
                    <!-- Modal: Crear nuevo anio academico -->
                <h3 class="text-center p-1 lead">Creacion de secciones</h3>
                    @if (count($vacantes)==0)
                        <button type="button" class="btn btn-warning  btn-sm col-md-12 mb-2 " data-toggle="modal" data-target=".bd-modal-anio-academico">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Creacion Masiva)
                        </button>
                        @include('modal.modal_vacantes_masivo')                       
                    @endif

                    <button type="button" class="btn btn-success  btn-sm col-md-12 mb-2 " data-toggle="modal" data-target=".bd-modal-anio-academico">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Creacion Individual
                    </button>
                </div>
            </div>

            <div class="col-md-9 ">
                <h3 class="text-center p-1 lead ">Informacion de vacantes por secciones</h3>
                    @if (count($vacantes)>0)
                        <table class="table table-sm table-light table-striped text-center ">
                            <thead class="table-success">
                                <tr>
                                    <th colspan="7" class="text-center text-uppercase">Vacantes</th>
                                </tr>
                                <tr>
                                    <th class="">Nº</th>
                                    <th class="">Codigo</th>
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
                                        <td class="text-uppercase ">{{$vacante->seccion->MP_SEC_NOMBRE}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_SEC_ID}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_VAC_TOT}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_VAC_OCU}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_VAC_DISP}}</td>
                                        <td>
                                            <!-- MODAL: Editar vacante -->
                                            <button type="button" class="btn-edit-vac bg-transparent border-0 text-primary"> 
                                                <i class="fas fa-edit    "></i>
                                            </button>
                                        </td>
                                        <td>
                                            <!-- MODAL: Eliminar vacante -->
                                            <button type="button" class="btn-del-vac bg-transparent border-0 text-danger"> 
                                                <i class="fas fa-edit"></i>
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
                    @else
                        <h5 class="lead p-5 text-center "> <span class="border-bottom border-1 border-secondary">  No hay vacantes registradas</span></h5>
                    @endif
            </div>
            @else
                <h5 class="lead p-5 text-center col-12">Tiene mas de un año activo academico, para  <span class="border-bottom border-1 border-secondary">  acceder seleccione un año en especifico</span> </h5>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/vacante.js') }}"></script>   
@endsection



