
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
  <link rel="stylesheet" href="assets/css/main.min.css">
</head>

<body>
  <section class="container-fluid vh-100 bg-gradient-brand">
    <div class="row justify-content-md-center h-100">
      <div class="col-12 col-md-7 col-lg-5 d-flex align-items-center">
        <div class="w-100">
          <div class="card border-0 rounded-4 shadow">
            <img src="assets/img/logos-lerma.png" class="card-img-top m-auto mt-5" alt="lerma" style="max-width: 15rem;">
            <div class="card-body p-5">
              <h5 class="card-title mb-3">Iniciar Sesión</h5>


              <form 
              action="{{route('validar')}}" method="POST">
              {{csrf_field()}}

                <div class="mb-3">
                  <label for="idu" class="form-label mb-0 text-accent">Correo Electrónico
                  @if($errors->first('email'))
                      <p class='text-daner'>{{$errors->first('email')}}</p>
                      @endif
                  </label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>

                <div class="mb-3">
                  <label for="pass" class="form-label mb-0 text-accent">Contraseña
                  @if($errors->first('pass'))
                      <p class='text-daner'>{{$errors->first('pass')}}</p>
                      @endif
                  </label>
                  <input type="password" name="pass" id="pass" class="form-control" placeholder="******" required>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                  <a href="{{route('registro_user')}}" class="btn btn-primary">Registrarse</a>
                  <button class="btn btn-success" type="submit">Acceder</button>
                </div>
              </form>


              <br>
              <br>
                @if(Session::has('mensaje'))
                <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                @endif
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-dark p-2">
    <p class="text-center text-white mb-0"><a class="text-white"
        href="https://lerma.gob.mx/ayuntamiento/aviso-de-privacidad/">Aviso de Privacidad</a>
      &nbsp;&nbsp; Derechos Reservados ©2022</p>

  </footer>
</body>

</html>