<?php
$sessionname = session('sessionname');
$sessionid = session('sessionid'); 
$sessiontipo = session('sessiontipo'); 
?>

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

       
      @if($sessiontipo=="admin")

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">    
        
        <ul class="navbar-nav p-2 p-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Home</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('reporte_user')}}">Productores</a></li>
                  <li><a class="dropdown-item" href="{{route('reportesolicitudapoyo')}}">Solicitud de apoyo</a></li>
                  <li><a class="dropdown-item" href="{{route('reportesolicitudcapacitacion')}}">Solicitud de Capacitacion</a></li>
                  <li><a class="dropdown-item" href="{{route('reportetipoapoyo')}}">Tipo de Apoyos</a></li>
                  <li><a class="dropdown-item" href="{{route('reportetipocapacitacion')}}">Tipo de Capacitaciones</a></li>
                </ul>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link active" aria-current="page" href="#">
                Preguntas Frecuentes</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('perfil_user',['id_users'])}}">Perfil  </a>
            </li>
            
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('cerrar')}}">Cerrar Sesión</a>
            </li>

        </ul>
      </div>

      </div>
    </nav>
    <nav class="bg-light">
      <div class="container">
        <p class="p-2">Bienvenido <?php echo $sessionname ?></p>
          
              </div>
    </nav>
  </header>



      @else


      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav p-2 p-lg-0">
          
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Home</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('solicitarapoyo_user')}}">Apoyos</a></li>
                  <li><a class="dropdown-item" href="{{route('solicitarcapacitacion_user')}}">Capacitaciones</a></li>
                  <li><a class="dropdown-item" href="{{route('perfil_solicitudescapacitacion')}}">Solicitudes de Capacitacion Relizadas</a></li>
                  <li><a class="dropdown-item" href="{{route('solicitarcapacitacion_user')}}">Capacitaciones</a></li>
            </li>
            

        </ul>
      
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('perfil_user',['id_users'=>$c->id_users])}}">{{$c->id_users}}  </a>
            </li>
     
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('Pregfrec')}}">Preguntas Frecuentes</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link" href="{{route('cerrar')}}">Cerrar Sesión</a>
            </li>
          </ul>
        </div>

        </div>
    </nav>
    <nav class="bg-light">
      <div class="container">
        <p class="p-2">Bienvenido <?php echo $sessionname ?></p>
                                          
      </div>
    </nav>
  </header>

  
    @endif




    
      
     
  <!--Seccion a la que agregamos el parametro contenido para que otras vistas lo manden a llamar-->
  <!-- Content -->
  <div id='content'>
    <div class='panel panel-default'>
      @yield('contenido')
    </div>
  </div>

  <footer class="bg-gradient-brand">
    <div class="container">
      <div class="row justify-content-md-center py-5">
        <div class="col-12 col-md-6 text-center">
          <img src="assets/img/horizontal-blanco.png" alt="lerma" style="max-width: 15rem;">
        </div>
        <div class="col-12 col-md-6">
          <div class="text-center text-md-start">
            <h4 class="text-white mt-3 mt-md-0">AYUNTAMIENTO DE LERMA</h4>
            <address class="text-white mb-0">
              <strong>Contactanos</strong><br>
              728 11 96244 ext. 1103 <br>
              agropecuario@lerma.gob.mx <br>
              Av Miguel Hidalgo No 36, Centro, Lerma.
            </address>
          </div>

        </div>
      </div>
    </div>
  </footer>
  <footer class="bg-dark p-2">
    <p class="text-center text-white mb-0"><a class="text-white"
        href="https://lerma.gob.mx/ayuntamiento/aviso-de-privacidad/">Aviso de Privacidad</a>
      &nbsp;&nbsp; Derechos Reservados ©2022</p>
  </footer>

  <script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>