@extends('layout.app')
@section('titulo','Colegio cabrera - Vacantes')
@section('contenido')


<div class="toolbar" id="kt_toolbar">
    <!--begin::Header-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
         <!--begin::Page title-->
         <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Facturacion
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <small class="text-muted fs-7 fw-bold my-1 ms-1">Pagos</small>
            </h1>
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Header-->
</div>

<div class="post m-2" id="kt_post">

    <!--------------------------- Begin: Container ---------------------------> 
    
    <div id="alertas" class="position-fixed d-block " style="top:10px; z-index: 1000; min-width: 500px; width: 100%;  max-width: 700px;">
    
    </div>

    <div class=" row justify-content-around">
        <!--------------------------- Begin: Registro de pagos ---------------------------> 
        <div class="col-md-6 p-3 shadow bg-white">
            <h4>Registrar pago:</h4>
            <hr>
            <div>
                <form class="p-3" id="formulario_pago" action="{{ route('pago.store') }}" method="POST">
                    <div class="mt-5 form-group ">
                    @csrf
                    <div class=" row   ">
                        <!------------------------------------------------ Begin: Meta ------------------------------------------------>
                        <input type="hidden" class="col-10 " id="anio_id" value="{{$anio->MP_ANIO_ID}}"  >
                        <input type="hidden" class="col-10 " name="cronograma_id" id="cronograma_id" value=""  >
                        <input type="hidden" class="col-10 " name="matricula_id" id="matricula_id" value=""  >
                        <!------------------------------------------------ Begin: Meta ------------------------------------------------>

                        <label for="dni_alumno" class="col-4">Documento Nacional de Identidad (DNI):  </label> 
                        <div class="col-5 p-2">
                            <input type="number" name="dni_alumno" id="dni_alumno" placeholder="123456789" class="col-12" required >
                        </div>                        
                        <div class="col-2 text-end p-0 pt-2">
                            <button class="btn btn-sm btn-primary p-5 py-1" id="btn_search" name="btn_buscar" type="submit" target-url="{{ route('home.alumno_info') }}" >
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    </div>

                    <div class="mt-5">
                        <label for="concepto_pago" class="col-4  ">Concepto de pago: </label> 
                       <select class="col-7" name="concepto_pago" id="concepto_pago">
                           <option value="1">Efectivo</option>
                           <option value="2">Deposito</option>
                       </select>
                    </div>
                    
                    <div class="pago_efectivo mt-5">
                        <label for="pago_monto" class="col-4 ">Monto</label> 
                        <input type="number" id="pago_monto" name="pago_monto" value="0" readonly disabled  class="col-7" >
                    </div>


                    <hr>

                    <div class="mt-5">
                        <label for="tipo_pago" class="col-4  ">Tipo de pago: </label> 
                       <select class="col-7" name="tipo_pago" id="tipo_pago">
                           <option value="1">Efectivo</option>
                           <option value="2">Deposito</option>
                       </select>
                    </div>

                    <!---------------------- Begin: Formas de pago --------------------------------->
                    <div class="pago_banco mt-5">
                        <label for="pago_banco" class="col-4 ">Banco: </label> 
                        <select name="pago_banco" id="pago_banco" class="col-7">
                            <option value="BCP">BCP</option>
                            <option value="BBVA">BBVA</option>
                        </select>
                        <br><br>
                        
                        <label for="numero_operacion" class="col-4 ">Numero de operacion: </label> 
                        <input type="number" id="numero_operacion" placeholder="Ingrese numero de operacion" name="numero_operacion"  class="col-7" >

                        <div class="form-group mt-5">
                            <label for="fecha_operacion" class="col-4 ">Fecha de operacion: </label> 
                            <input type="date" id="fecha_operacion" name="fecha_operacion"  class="col-7" >
                        </div>

                    </div>
                    <!---------------------- End: Formas de pago --------------------------------->
                    

                    <!----------------------------------- Begin: Fechas - Evaluar ----------------------------------->
                    <div class="form-group mt-5">
                        <label for="fecha_pago" class="col-4 ">Fecha de pago: </label> 
                        <input type="date" id="fecha_pago" name="fecha_pago"  class="col-7" >
                    </div>
                    
                    <!----------------------------------- End: Fechas - Evaluar ----------------------------------->
                    
                    <hr>
                    <div class="mt-5">
                        <label for="tipo_comprobante" class="col-4  ">Tipo de comprobante: </label> 
                        <select class="col-7" name="tipo_comprobante" id="tipo_comprobante">
                            <option value="2">Boleta</option>
                            <option value="4">Factura</option>
                        </select>
                     </div>

                     <div class="form-group mt-5 text-end">
                         <button class="btn btn-sm btn-primary" type="submit" name="btn_confirmar" data-endpoint="{{ route('pago.store') }}" id="btn-confirmar-pago" > Confirmar <i class="fas fa-save"></i> </button>
                         <button class="btn btn-sm btn-danger" type="button"  name="btn_limpiar" id="btn-confirmar-limpiar" > Limpiar <i class="fa fa-times" aria-hidden="true"></i> </button>
                     </div>


                </form>
            </div>
        </div>
        <!--------------------------- End: Registro de pagos ---------------------------> 

        <!--------------------------- Begin: Resumen pagos ---------------------------> 
        <div class="col-md-5 shadow bg-white p-0">
            <!--------------------------- Begin: Informacion de alumno ------------------------------> 

            <div class="mt-5">
                <div class="mt-5 row p-3 d-flex  ">
                    <label for="alumno_nombre" class="col-2">Alumno: </label> 
                    <input type="text" class="col-10 " name="alumno_nombre"  id="alumno_nombre"  readonly disabled>
                </div>
            </div>

            <!--------------------------- End: Informacion de alumno ------------------------------> 

            <!--------------------------- NavBar: Menu Resumen --------------------------->
            <nav class="bg-secondary border border-top-3 border-secondary">
                <button class="border-0 btn btn-sm  bg-hover-white btn-menu-facturacion bg-white" id="btn-cronograma" target="#cronograma_pagos" >   Cronograma pagos </button>
                <button class="border-0 btn btn-sm  bg-hover-white btn-menu-facturacion" id="btn-otros" target="#otros_pagos">   Otros pagos </button>
                <button class="border-0 btn btn-sm  bg-hover-white bg-warning btn-menu-facturacion" id="btn-pagos-pendientes" target="#pagos_pendientes">   Pagos pendientes </button>
            </nav>

            <div class="p-3">
                <hr>
                <!--------------------------- Begin: Cronogramas de pagos ------------------------------> 
                <div class="menu-facturacion " id="cronograma_pagos">
                    <h4>CRONOGRAMA DE PAGOS</h4>
                    <hr>
                    <div class="mt-5">
                        <table class="table table-sm table-light table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" >Concepto</th>
                                    <th class="text-center " >Tipo de deuda</th>
                                    <th class="text-center " >Estado</th>
                                    <th class="text-center" >Monto</th>
                                    <!-- <th class="text-center" >Fecha</th> -->
                                </tr>
                            </thead>
                            <tbody class="table-striped "  name="tbody_cronograma">
                                <tr>
                                    <td class="text-center" colspan="5">Introdusca los datos del alumno a buscar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--------------------------- End: Cronogramas de pagos ------------------------------> 
                
                <!--------------------------- Begin: Otros pagos ------------------------------> 
                <div class="menu-facturacion d-none" id="otros_pagos">
                    <h4>OTROS PAGOS</h4>
                    <hr>
                    <table class="table table-sm table-light table-striped table-responsive  ">
                        <thead>
                            <tr>
                                <th class="text-center">N° Pago</th>
                                <th class="text-center">Concepto</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Fecha</th>
                            </tr>
                        </thead>
                        <tbody  class="table-striped" id="tbody_otros_pagos">
                            <tr>
                                <td class="text-center" colspan="4">No se han gos realizados</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!--------------------------- End: Otros pagos ------------------------------>
            
            
                <!--------------------------- Begin: Pagos pendientes ------------------------------> 
                <div class="menu-facturacion d-none" id="pagos_pendientes">
                    <h4>PAGOS PENDIENTES</h4>
                    <hr>
                    <table class="table table-sm table-light table-striped table-responsive  ">
                        <thead>
                            <tr>
                                <th class="text-center">Tipo de deuda</th>
                                <th class="text-center">Concepto</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Fecha</th>
                            </tr>
                        </thead>
                        <tbody  class="table-striped" id="tbody_otros_pagos">
                            <tr>
                                <td class="text-center" colspan="4">No se  ha encontrado pagos pendientes...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!--------------------------- End: Pagos pendientes ------------------------------>

            </div>
        </div>    
        <!--------------------------- End: Resumen pagos ---------------------------> 
    </div>
    <!--------------------------- End: Container ---------------------------> 
</div>

<style>
    .pago_banco{
        transition: all 3s ease;
    }
    
</style>
@endsection

@section('scripts')
    <script src="{{ asset('js/facturacion.js') }}"></script>

    <script>
        $(() => {

            //alert("Modulo de facturacion");

            $(".aside-menu .menu-item .menu-link ").removeClass('active');
            $("#menu_item_pagos").addClass('active');
            
        });
    </script>
@endsection






