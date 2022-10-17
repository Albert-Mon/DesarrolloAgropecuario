@extends ('index')
@section ('contenido')

<div class="container">
	<h2>Modificacion de Usuarios</h2>

	<form action = "{{route('guardarcambios')}}" method="POST" enctype='multipart/form-data'>
	{{csrf_field()}} 

		<br>
		<a href="{{route('reporteProduc')}}">	
		<button type="button" class="btn btn-primary">Reporte de Usuarios</button></a>
		<br>
		@if(Session::has('mensajes'))
			<div class="alert alert-success">{{Session::get('mensajes')}}</div>
		@endif

	<section class="container mb-5">
	    <div class="row justify-content-md-center p-2">
	      <div class="col-12 col-lg-10">
	        <form action=".">
	        <div class="row">
	          <div class="mb-3">

	          	<input type="text" name="id_productores" hidden value="{{$consulta->id_productores}}">

	            <label for="nombre" class="form-label mb-0 text-accent">Nombre(s):
		            @if($errors->first('nombre'))
		            	<p class='text-danger'>{{$errors->first('nombre')}}</p>
		            @endif
	        	</label>
	            <input type="text" class="form-control" name="nombre" id="nombre" 
	            value="{{$consulta->nombre}}" placeholder="Nombre o Nombres">
	          </div>

	          <div class="mb-3">
	            <label for="app" class="form-label mb-0 text-accent">Apellido Paterno:
		            @if($errors->first('app'))
		            	<p class='text-danger'>{{$errors->first('app')}}</p>
		            @endif
	        	</label>
	            <input type="text" class="form-control" name="app" id="app" 
	            value="{{$consulta->app}}" placeholder="Apellido Paterno">
	          </div>

	          <div class="mb-3">
	            <label for="apm" class="form-label mb-0 text-accent">Apellido Materno:
	            	@if($errors->first('apm'))
		            	<p class='text-danger'>{{$errors->first('apm')}}</p>
		            @endif
	            </label>
	            <input type="text" class="form-control" name="apm" id="apm" 
	            value="{{$consulta->apm}}" placeholder="Apellido Materno">
	          </div>
	         </div>

	         <div class="row">
	          <div class="mb-3">
	            <label for="fecha" class="form-label mb-0 text-accent">Fecha de Nacimiento:
	            	@if($errors->first('fecha'))
		            	<p class='text-danger'>{{$errors->first('fecha')}}</p>
		            @endif
	            </label>
	            <input type="date" class="form-control" value="{{$consulta->fecha}}" name="fecha" id="fecha" placeholder="Formato fecha">
	          </div>
	      </div>

	          <!--Radio Bottons-->
	         <div class="row">
            	<div class="col-xs-6 col-sm-6 col-md-6">
                	<label for="dni" class="form-label mb-0 text-accent">Sexo:</label>
                @if ($consulta->sexo=='F')
                	<div class="custom-control custom-radio">
                		<input type="radio" id="sexo1" name="sexo"  value = "M" class="custom-control-input">
                		<label class="custom-control-label" for="sexo1">Masculino</label>
                	</div>
	                <div class="custom-control custom-radio">
	                	<input type="radio" id="sexo2" name="sexo" value = "F" class="custom-control-input" checked="">
	                	<label class="custom-control-label" for="sexo2">Femenino</label>
	                </div>
                @else
                	<div class="custom-control custom-radio">
                		<input type="radio" id="sexo1" name="sexo"  value = "M" class="custom-control-input" checked="">
                		<label class="custom-control-label" for="sexo1">Masculino</label>
                	</div>
	                <div class="custom-control custom-radio">
	                	<input type="radio" id="sexo2" name="sexo" value = "F" class="custom-control-input">
	                	<label class="custom-control-label" for="sexo2">Femenino</label>
	                </div>
                @endif
            	</div>
            	<!---->
	        </div>
	        <br>
	          <div class="row">
	          	<div class="mb-3">
	          		<div class="form-group">
		                    <label for="email" class="form-label mb-0 text-accent">Email:
			                    @if($errors->first('email'))
					            	<p class='text-danger'>{{$errors->first('email')}}</p>
					            @endif
					        </label>
		                    <input type="email" name="email" id="email" class="form-control" placeholder="example@example" value="{{$consulta->email}}" tabindex="4">
		                </div>
		            </div>



					<div class="mb-3">
	          		<div class="form-group">
		                    <label for="pass" class="form-label mb-0 text-accent">contraseña:
			                    @if($errors->first('pass'))
					            	<p class='text-danger'>{{$errors->first('pass')}}</p>
					            @endif
					        </label>
		                    <input type="password" name="pass" id="pass" class="form-control" placeholder="***********" value="{{$consulta->pass}}" tabindex="4">
		                </div>
		            </div>

		            <div class="mb-3">
		                <div class="form-group">
		                    <label for="celular" class="form-label mb-0 text-accent">Celular:
		                    	@if($errors->first('celular'))
				            		<p class='text-danger'>{{$errors->first('celular')}}</p>
				            	@endif
		                    </label>
		                    <input type="celular" name="celular" id="celular" class="form-control" placeholder="10 Digitos" 
		                    value="{{$consulta->celular}}" tabindex="3">
		                </div>
		            </div>

		            <div class="mb-3">
		                <div class="form-group">
		                    <label for="curp" class="form-label mb-0 text-accent">CURP:
		                    	<br>
		                    	<embed src="{{asset('archivos/'.$consulta->curp)}}" height=200 width=200></embed>
		                    	@if($errors->first('curp'))
				            			<p class='text-danger'>{{$errors->first('curp')}}</p>
				            			@endif
		                    </label>
		                    <input type="file" name="curp" value="{{old('curp')}}" id="curp" class="form-control">
		                </div>
		            </div>

		            <div class="mb-3">
		                <div class="form-group">
		                    <label for="ine" class="form-label mb-0 text-accent">INE:
		                    	<br>
		                    	<embed src="{{asset('archivos/'.$consulta->ine)}}" height=200 width=200></embed>
		                    	@if($errors->first('ine'))
				            		<p class='text-danger'>{{$errors->first('ine')}}</p>
				            	@endif
		                    </label>
		                    <input type='file' name="ine" id="ine" class="form-control" tabindex="3">
		                </div>
		            </div>

		          <div class="mb-3">
		            <label for="direccion" class="form-label mb-0 text-accent">Direccion:
		            	@if($errors->first('direccion'))
			            	<p class='text-danger'>{{$errors->first('direccion')}}</p>
			            @endif
		            </label>
	             <input type="text" class="form-control" name="direccion" id="direccion" value="{{$consulta->direccion}}" placeholder="Escriba su Calle">
	            </div>

	            <div class="mb-3">
		                <div class="form-group">
		                    <label for="cp" class="form-label mb-0 text-accent">Codigo Postal:
		                    	@if($errors->first('cp'))
				            		<p class='text-danger'>{{$errors->first('cp')}}</p>
				            	@endif
		                    </label>
		                    <input type="cp" name="cp" id="cp" class="form-control" placeholder="5 Digitos" value="{{$consulta->cp}}" tabindex="3">
		                </div>
		            </div>

		            <div class="mb-3">
		                <div class="form-group">
		                    <label for="croquis" class="form-label mb-0 text-accent">Croquis:
		                    	<br>
		                    	<embed src="{{asset('archivos/'.$consulta->croquis)}}" height=200 width=200></embed>
		                    	@if($errors->first('croquis'))
				            		<p class='text-danger'>{{$errors->first('croquis')}}</p>
				            	@endif
		                    </label>
		                    <input type='file' name="croquis" id="croquis" class="form-control"
		                    tabindex="3">
		                   
		                </div>
		            </div>

		             <div class="mb-3">
		                <div class="form-group">
		                    <label for="constanciadomicilio" class="form-label mb-0 text-accent">Constancia Domiciliaria:
		                    	<br>
		                    	<embed src="{{asset('archivos/'.$consulta->constanciadomicilio)}}" height=200 width=200></embed>
		                    	@if($errors->first('constanciadomicilio'))
				            		<p class='text-danger'>{{$errors->first('constanciadomicilio')}}</p>
				            	@endif
		                    </label>
		                    <input type='file' name="constanciadomicilio" id="constanciadomicilio" class="form-control"  tabindex="3">
		                   
		                </div>
		            </div>

		          <div class="mb-3">
		          	<div class="form-group">
		          		<label for="dni" class="form-label mb-0 text-accent">Localidades:
		          			@if ($errors->first('id_localidades'))
	                    <p class='text-danger'>{{$errors->first('id_localidades')}}</p>
	                  @endif
	                </label>
	          		<select name='id_localidades' class="form-control">
	          			<option value="{{$consulta->id_localidades}}">
	          				{{$consulta->nombre_localidades}}</option>
	          			@foreach($localidades as $locali)
	          				<option value="{{$locali->id_localidades}}">{{$locali->nombre_localidades}}</option>
	          			@endforeach
	          		</select>
	          	</div>
	          </div>

	          

	           <div class="card-header mb-3" class="form-label mb-0 text-accent">Si eres Productor:</font></font></div>

	          <div class="mb-3">
		          <div class="form-group">
		            <label for="constanciaproductor" class="form-label mb-0 text-accent">Constancia de Productor:<br>
		              <embed src="{{asset('archivos/'.$consulta->constanciaproductor)}}" height=200 width=200></embed>
		                 @if($errors->first('constanciaproductor'))
				            		<p class='text-danger'>{{$errors->first('constanciaproductor')}}</p>
				             @endif
		            </label>
		              <input type='file' name="constanciaproductor" id="constanciaproductor" class="form-control"  tabindex="3">
		          </div>
		        </div>

		        <div class="card-header mb-3" class="form-label mb-0 text-accent">Datos si es que viene de alguna institución:</font></font></div>

		        	<div class="mb-3">
	            	<label for="nombrerepresentante" class="form-label mb-0 text-accent">Nombre del representante:
	            		@if($errors->first('nombrerepresentante'))
		            		<p class='text-danger'>{{$errors->first('nombrerepresentante')}}</p>
		            	@endif</label>
	            	<input type="text" name="nombrerepresentante" id="nombrerepresentante" value="{{$consulta->nombrerepresentante}}" class="form-control" placeholder="Nombre del representante.">
	          	</div>

	          	<div class="mb-3">
	            	<label for="direccioninstitucion" class="form-label mb-0 text-accent">Direccion de la Institución a la que pertenece:
	            		@if($errors->first('direccioninstitucion'))
		            		<p class='text-danger'>{{$errors->first('direccioninstitucion')}}</p>
		            	@endif</label>
	            	<input type="text" name="direccioninstitucion" id="direccioninstitucion" value="{{$consulta->direccioninstitucion}}" class="form-control" placeholder="Direccion en la que se encuentra la institución. (Calle, #)">
	          	</div>

	          	<div class="mb-3">
	            	<label for="cargo" class="form-label mb-0 text-accent">Cargo:
	            		@if($errors->first('cargo'))
		            		<p class='text-danger'>{{$errors->first('cargo')}}</p>
		            	@endif</label>
	            	<input type="text" name="cargo" id="cargo" value="{{$consulta->cargo}}" class="form-control" placeholder="Puesto que tiene">
	          	</div>

	          	<div class="mb-3">
		          	<div class="form-group">
		            	<label for="nombramiento" class="form-label mb-0 text-accent">Nombramiento (PDF o Imagen):<br>
		              	<embed src="{{asset('archivos/'.$consulta->nombramiento)}}" height=200 width=200></embed>
		                 	@if($errors->first('nombramiento'))
				            		<p class='text-danger'>{{$errors->first('nombramiento')}}</p>
				             	@endif
		            	</label>
		              	<input type='file' name="nombramiento" id="nombramiento" class="form-control"  tabindex="3">
		          	</div>
		        	</div>

		        </div>
		       

	          <!--Boton-->
	          <div class="row">
	          <div class="d-grid gap-2 mt-5 col-6 mx-auto">
	            <input type="submit" value="Actualizar Perfil" class="btn btn-danger btn-secondary " tabindex="7">
	          </div>
	          </div>

	        </form>
	      </div>
	    </div>
	  </section>


	  <footer class="bg-gradient-brand">
	    <div class="container">
	      <div class="row justify-content-md-center py-5">
	        <div class="col-12 col-md-6 text-center">
	          <img src="{{asset('assets/img/horizontal-blanco.png')}}" alt="lerma" style="max-width: 15rem;">
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
</form>
<!---->
@stop