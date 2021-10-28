<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome\css\all.css') }}">
    <title>@yield('titulo')</title>
  </head>
  <body>

    <div class="container-fluid mt-3">
        <h1 class="pt-md-3 pb-md-3 lead text-uppercase" style="font-size: 2.75em;">Colegio cabrera</h1>
        <div class="row  bg-secondary border border-1 border-secondary shadow">
            
            <div class="col-md-3 bg-light p-4">
                <h3 class="p-3 pl-0 lead ">Menu de opciones</h3>
                    <ul style="list-style-type: none">
                        <li><a class="btn btn-primary col-12  text-left  mb-1s"  href="{{ route('home.anio') }}">Año academico</a></li>
                        <li><a class="btn btn-primary col-12 text-left  mb-1s"  href="{{ route('home.vacantes') }}">Vacantes</a></li>
                        <li><a class="btn btn-primary col-12 text-left  mb-1s"  href="{{ route('home.conceptos') }}">Conceptos de pago</a></li>
                    </ul>
            </div>

            <div class="col-md-9 bg-white border-1 border-secondary border-left">
                @yield('contenido')
            </div>
            
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    @yield('scripts')

</body>
</html>