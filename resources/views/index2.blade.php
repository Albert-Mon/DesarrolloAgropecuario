

<!DOCTYPE html>
<html lang="es">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index,follow">
  <meta name="Description" content="Ayuntamiento de Lerma">
  <meta name="Keywords" content="podemos mas, lerma, ayuntamiento, municipio">
  <title>Agropecuario - Ayuntamiento de Lerma</title>
  <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
</head>

<body>
  <header class="shadow">
    <!--nav-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('assets/img/logos-lerma.png')}}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          
        
        <ul class="navbar-nav p-2 p-lg-0">
            <li class="nav-item px-lg-2">
              <a class="nav-link active" aria-current="page" href="#">
                Preguntas Frecuentes</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reportes</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('reporteAdmin')}}">Administrador</a></li>
                  <li><a class="dropdown-item" href="{{route('reporte_user')}}">Productor</a></li>
                  <li><a class="dropdown-item" href="{{route('reportesolicitudapoyo')}}">Solicitud de apoyo</a></li>
                  <li><a class="dropdown-item" href="{{route('reportesolicitudcapacitacion')}}">Solicitud de Capacitacion</a></li>
                  <li><a class="dropdown-item" href="{{route('reportetipoapoyo')}}">Tipo de Apoyos</a></li>
                  <li><a class="dropdown-item" href="{{route('reportetipocapacitacion')}}">Tipo de Capacitaciones</a></li>
                </ul>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('cerrar')}}">Cerrar Sesión</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Link</a></li>
                  <li><a class="dropdown-item" href="#">Another link</a></li>
                  <li><a class="dropdown-item" href="#">A third link</a></li>
                </ul>
            </li>

        </ul>



      </div>
      
      </div>
    </nav>
    <nav class="bg-light">
      <div class="container">
        <p class="p-2">Bienvenido<?php $sessionname ?></p>
                          

      </div>
    </nav>


    
  </header>

















  

  <!--Seccion a la que agregamos el parametro contenido para que otras vistas lo manden a llamar-->
  <!-- Content -->
  <div id='content'>
    <div class='panel panel-default'>
      @yield('contenido2')
    </div>
  </div>

  <script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>