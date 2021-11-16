@extends('layout.app')
@section('titulo','Erro 404')

@section('contenido')
    
    <div class="post flex-column-fluid " >
        <!--Begin   ::Container-->
        <div class="w-md-50 text-center mx-auto ">
            <h3 class="lead  fs-3hx">Error 404</h3>
            <span>
                No se encuentra la pagina a la que desea acceder. 
                <br> 
                <br> 
                <br> 
                <b>Vuelva a intentarlo en otro momento</b>
                <br>
                <br>
                <img src="{{ asset('images/colegio/error404.jpg') }}" class="col-10" alt="" srcset="">
            </span>
        </div>
        <!--End::Container-->
    </div>
@endsection
