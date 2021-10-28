@extends('layout.app')
@section('titulo','Colegio cabrera - Año academico')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center lead fs-2 p-3 bg-light text-uppercase">Año Academico</h3>  
        </div>
        <div class="card-body bg-white row">
            <div class="col-md">
                <h3 class="text-center p-1 lead">Crear nuevo año academico</h3>
                <hr>
                <div class="text-center">        
                    <!-- Modal: Crear nuevo anio academico -->
                    <button type="button" class="btn btn-primary  btn-sm9" data-toggle="modal" data-target=".bd-modal-anio-academico">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Crear Año Academico
                    </button>
                </div>
            
            </div>
            <div class="col-md m-3">
                <h3 class="text-center p-1 lead ">Años Academicos</h3>
                    <table class="table table-sm table-light table-striped text-center">
                        <thead class="table-dark">
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
                                <td class="bg-white text-left ">
                                    <button type="button" class="btn btn-sm bg-transparent text-success edit-m" 
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
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    @include('modal.modal_anio_academico')
    @include('modal.modal_anio_academico_edit')
@endsection

@section('scripts')
    <script src="{{ asset('js/anio.js') }}"></script>   
@endsection



