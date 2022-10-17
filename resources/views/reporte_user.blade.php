@extends ('index')
@section ('contenido')

<div class="container">
	<h2>Productores</h2>
	<br>
	<a href="{{route('registro_user')}}">	
	<button type="button" class="btn btn-primary">Alta de Productores</button>
	</a>
	<a href="{{url('pdfproduc') }}">
	<button type="button" class="btn btn-primary" style="float: right;">Imprimir PDF</button>
	</a>

	<br>
	<br>

			@if(Session::has('mensajes'))
				<div class="alert alert-success">{{Session::get('mensajes')}}</div>
			@endif
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col" class="form-label mb-0 text-accent">Clave</th>
		      <th scope="col" class="form-label mb-0 text-accent">Nombre</th>
		      <th scope="col" class="form-label mb-0 text-accent">Correo</th>
		      <th scope="col" class="form-label mb-0 text-accent">Direccion</th>
		      <th scope="col" class="form-label mb-0 text-accent">Localidad</th>
		      <th scope="col" class="form-label mb-0 text-accent">Operaciones</th>
		    </tr>
		  </thead>
	  <tbody>
	    @foreach($consulta as $con)
	    <tr>
	      <th scope="row" class="form-label mb-0 text-accent">{{$con->id_users}}</th>
	      <td>{{$con->nombre}}</td>
	      <td class="form-label mb-0 text-accent">{{$con->email}}</td>
	      <td>{{$con->direccion}}</td>
	      <td>{{$con->loca}}</td>
	      <td>
	      	<a href="{{route('modifica_user',['id_users'=>$con->id_users]) }}">
	      	<button type="button" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Modificar</font></font></button></a><br>

	      	@if($con->deleted_at)

	      	<a href="{{route('activausers',['id_users'=>$con->id_users])}}">
	        <button type="button" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activar</font></font></button></a>

	        <a href="{{route('borrauser',['id_users'=>$con->id_users])}}">
          <button type="button" class="btn btn-dark"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Borrar</font></font></button></a>

	        @else

	        <a href="{{route('desactivauser',['id_users'=>$con->id_users])}}">
	        <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Desactivar</font></font></button></a>

	        @endif
	      </td>
	    </tr>
	   	@endforeach
	  </tbody>
	 </table>	
						
						
</div>


</form>
@stop