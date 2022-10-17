@extends ('index')
@section ('contenido')

<div class="container">
	<h2>Reporte de Administradores</h2>
	<!--Agregamos un boton para direccionarnos a la vista de alta de administradores-->
	<br>
	<a href="{{route('altaAdmin')}}">	
	<button type="button" class="btn btn-primary">Alta de Administradores</button></a>

	<!--Boton para imprimir en pdf-->
	<a href="{{url('pdfadmin') }}">
	<button type="button" class="btn btn-primary" style="float: right;">Imprimir PDF</button>
	</a>
	<br>

	<!--Si existe una sesion con el valor de mensaje o con algun valor entonces imprime la sesion con el valor de mensaje-->
		@if(Session::has('mensajes'))
			<div class="alert alert-success">{{Session::get('mensajes')}}</div>
		@endif
		
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col" class="form-label mb-0 text-accent">Clave</th>
		      <th scope="col" class="form-label mb-0 text-accent">Nombre Completo</th>
		      <th scope="col" class="form-label mb-0 text-accent">Correo</th>
		      <th scope="col" class="form-label mb-0 text-accent">Cargo</th>
		      <th scope="col" class="form-label mb-0 text-accent">Opereciones</th>
		    </tr>
		  </thead>
	  <tbody>
	  	@foreach($consulta as $con)
	    <tr>
	      <th scope="row" class="form-label mb-0 text-accent">{{$con->id_administradores}}</th>
	      <td>{{$con->nombre}} {{$con->app}} {{$con->apm}}</td>
	      <td class="form-label mb-0 text-accent">{{$con->email}}</td>
	      <td>{{$con->cargo}}</td>
	      <td>
	      	<!--Aqui se agregan los botones en donde vamos a llamar otras vistas para hacer las modificaciones, desactivar, activar y eliminar-->
	      	<!--Boton para modificar----------------------------------------------->
	      	<a href="{{route('modificaAdmin',['id_administradores'=>$con->id_administradores])}}">
	      	<button type="button" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Modificar</button><br></font></font></button></a>

	      	<!--Boton para Activar y Desactivar------------------------------------------>
	      	<!--Lo que hace el if es que si en la consulta $conf el campo deleted_at tiene informacion entonces mandara a llamar el campo o boton activar, en caso de que no tenga informacion mandara el boton desactivar-->
	      	@if($con->deleted_at)
	      	<!--En el siguiente hrf se manda a llamar a la ruta, pero para que de igual manera se pueda activar se manda a llamar el id al darle click al registro seleccionado-->
	      	<a href="{{route('activaAdmin',['id_administradores'=>$con->id_administradores])}}">
	        <button type="button" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activar</font></font></button></a>

	        <a href="{{route('borraAdmin',['id_administradores'=>$con->id_administradores])}}">
          <button type="button" class="btn btn-dark"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Borrar</font></font></button></a>
	        @else
	        <!--En el siguiente hrf se manda a llamar a la ruta, pero para que de igual manera se pueda desactivar se manda a llamar el id al darle click al registro seleccionado-->
	        <a href="{{route('desactivaAdmin',['id_administradores'=>$con->id_administradores])}}">
	        <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Desactivar</font></font></button></a>

	        @endif
	      </td>
	    </tr>
	    @endforeach
	  </tbody>
	 </table>
</div>

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
@stop