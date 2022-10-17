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
  <section class="container-fluid vh-800 bg-gradient-brand">
    <div class="row justify-content-md-center h-50">
      <div class="col-12 col-md-7 col-lg-5 d-flex align-items-center">
        <div class="w-100">
          <div class="card border-0 rounded-4 shadow">
            <img src="assets/img/logos-lerma.png" class="card-img-top m-auto mt-5" alt="lerma"
              style="max-width: 15rem;">
            <div class="card-body p-5">
              <h5 class="card-title mb-3">Registrarse</h5>
              <form action = "{{route('guardaruser')}}" method="POST" enctype='multipart/form-data'>
              	{{csrf_field()}} 

                 

                  @if(Session::has('mensajes'))
                    <div class="alert alert-success">{{Session::get('mensajes')}}</div>
                  @endif
                  <br>



                  <div class="row">
                    <div class="mb-3">
                      <label for="nombre" class="form-label mb-0 text-accent">Nombre(s):
                        @if($errors->first('nombre'))
                          <p class='text-danger'>{{$errors->first('nombre')}}</p>
                        @endif
                    </label>
                      <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre')}}" placeholder="Nombre o Nombres">
                    </div>


                <div class="mb-3">
	          		<div class="form-group">
		                    <label for="email" class="form-label mb-0 text-accent">Email:
			                    @if($errors->first('email'))
					            	<p class='text-danger'>{{$errors->first('email')}}</p>
					            @endif
					        </label>
		                    <input type="email" name="email" id="email" class="form-control" placeholder="example@example" value="{{old('email')}}" tabindex="4">
		                </div>
		            </div>


				    	<div class="mb-3">
	          		<div class="form-group">
		                    <label for="pass" class="form-label mb-0 text-accent">contraseña:
			                    @if($errors->first('pass'))
					            	<p class='text-danger'>{{$errors->first('pass')}}</p>
					            @endif
					        </label>
		                    <input type="password" name="pass" id="pass" class="form-control" placeholder="******" value="{{old('pass')}}" tabindex="4">
		                </div>
		            </div>


                <div class="mb-3">
                  <label for="pwd" class="form-label mb-0 text-accent">Verificar Contraseña</label>
                  <input type="password" id="pwd" class="form-control" placeholder="******" required>
                </div>

                <p>Al dar click en registrarme estas aceptando los <a href="#" class="fw-bold">términos
                    y condiciones</a> de uso del municipio de Lerma.</p>

                <div class="d-grid gap-2 mb-3">
                  <button class="btn btn-success" type="submit">Registrarse</button>
                </div>

                <p class="text-center my-3">
                  Si ya tienes cuenta Inicia Sesión<a href="{{route('login')}}" class="fw-bold"> aquí</a>.
                </p>
                
              </form>
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