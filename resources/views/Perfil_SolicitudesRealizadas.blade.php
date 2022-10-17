<!--Vista para VER SOLICITUDES REALIZADAS USER-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
        <h4 class="my-3">Solicitudes Realizadas</h4>
        <P>Estas son tus Solicitudes que has realizado hasta la fecha.</P>
         <!--NOTIFIICACIÓN FLASH-->
          @if(Session::has('mensaje'))
       <div class="alert alert-success">
        {{Session::get('mensaje')}}
       </div>
       @endif
          <table  class="table table-bordered">
  <tr>
    <th>Nombre del Apoyo</th>
    <th>Fecha de Envio</th>
    <th>Estatus</th>
    <th>Ver/Imprimrir</th>
    <th>Cancelar</th>

  </tr>
  <tr>
    @foreach($consulta as $c)
    <td>{{$c->nombreapoyo}}</td>
    <td>{{$c->created_at}}</td>
    <td>{{$c->nomestatus}}</td>
    <td>
    <a class="navbar-brand" href="{{route('detallesolicitud_user',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}"> <img class="me-3" src="assets/img/ver.png" alt="Apoyo" style="max-height: 3rem;"></a>
    <a href="#">
      <button type="button" class="btn btn-secondary">Imprimir</button>
      </a>
  </td>
    <td>
      <!--PARA ELIMINAR DESDE EL PERFIL DE LAS SOLICITUDES DEL USUARIO -->
    <a href="{{route('cancelarsolicitudapoyo',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}">
      <button type="button" class="btn btn-danger">Cancelar</button>
      </a>
    </td>
  </tr>
 @endforeach
</table>








          
      </div>
    </div>
  </section>
  
@stop