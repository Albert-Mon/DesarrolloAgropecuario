<!--Vista para agregar otro tipo de apoyo-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
  <section class="container">
    <div class="container mb-3">
      <div class="row justify-content-md-center p-6">
          <h4>Solicitudes de Apoyos Agropecuario</h4>
          <div> 
         <!--Aqui va la notificación flash-->
       @if(Session::has('mensaje'))
       <div class="alert alert-success">
        {{Session::get('mensaje')}}
       </div>
       @endif
      <a class="btn btn-success" href="{{route('Altasolicitudapoyo')}}">Crear Nuevo</a>
      </div>
      <br></br>
      
  <div class="table-responsive">
  <table class="table table-bordered">
                                   <thead>
                                   <tr>
                                 
                                       <th >#</th>
                                       <th >Tipo de Apoyo</th>
                                       <th >Productor</th>
                                       <th >Fecha y Hora de Creación</th>
                                       <th >Documentos</th>
                                       <th >Estatus</th>
                                       <th >Acciones</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                   @foreach ($consulta as $c)
                                       <th>{{$c->Id_solicitudapoyo}}</td>
                                       <th>{{$c->nombreapoyo}}</td>
                                       <td>{{$c->username}}</td>
                                       <td>{{$c->created_at}}</td>
                                       <td>
                                       <a href="#">
                                               <button type="button" class="btn btn-warning">Ver en Perfil</button>
                                               
                                       </td>
                                       <td class="form-label mb-0 text-accent">{{$c->nomestatus}}</td>

                                       <td>
                                       <a class="navbar-brand" href="{{route('detallesolicitud_admin',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}"> <img class="me-3" src="assets/img/ver.png" alt="Apoyo" style="max-height: 3rem;"></a>
                                           
                                       <a href="{{route('modificacion_solicitudapoyo',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}">
                                        <button type="button" class="btn btn-info">Modificar</button>  </a>                                        
                                           @if($c ->deleted_at)
                                               <a href="{{route('activarsolicitudapoyo',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}">
                                               <button type="button" class="btn btn-warning">Activar</button>
                                               
                                               <a href="{{route('eliminarsolicitudapoyo',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}">
                                               <button type="button" class="btn btn-secondary">Eliminar</button>
                                               
                                               @else
                                               <a href="{{route('desactivarsolicitudapoyo',['Id_solicitudapoyo'=>$c->Id_solicitudapoyo])}}">
                                               <button type="button" class="btn btn-danger">Desactivar</button>
                                               </a>
                                                 @endif                                     
                                       </td>
                                   </tr>
                                   @endforeach

                                   </tbody>
                               </table>
                             </div>   
                              </div>
        
                            </div>  
            </section>

@stop