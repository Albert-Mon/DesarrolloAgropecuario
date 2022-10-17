 <!--Vista para ver solicitudes de capacitaciones-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
  <section class="container">
    <div class="container mb-3">
      <div class="row justify-content-md-center p-6">
          <h4>Solicitudes de Capacitaciones Agropecuario</h4>
          <div> 
         <!--Aqui va la notificación flash-->
       @if(Session::has('mensaje'))
       <div class="alert alert-success">
        {{Session::get('mensaje')}}
       </div>
       @endif
      <a class="btn btn-success" href="{{route('Altasolicitudcapacitacion')}}">Crear Nuevo</a>
      </div>
      <br></br>
      
  <div class="table-responsive">
  <table class="table table-bordered">
                                   <thead>
                                   <tr>
                                 
                                       <th >#</th>
                                       <th >Capacitación</th>
                                       <th >Productor</th>
                                       <th >Fecha y Hora</th>
                                       <th >Categoria</th>
                                       <th >Documentos</th>
                                       <th >Estatus</th>
                                       <th >Acciones</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                   @foreach ($consulta as $c)
                                       <th>{{$c->Id_solicitudcapacitacion}}</td>
                                       <th>{{$c->nombrecap}}</td>
                                       <td>{{$c->Id_perfilproductor}}</td>
                                       <td>{{$c->created_at}}</td>
                                       <td>{{$c->cat}}</td>

                                       <td>
                                       <a href="#">
                                               <button type="button" class="btn btn-warning">Ver en Perfil</button>
                                               
                                       </td>
                                       <td class="form-label mb-0 text-accent" >{{$c->nomestatus}}</td>

                                       <td>
                                       <a class="navbar-brand" href="{{route('detallecapacitacionadmin',['Id_solicitudcapacitacion'=>$c->Id_solicitudcapacitacion])}}"> <img class="me-3" src="assets/img/ver.png" alt="Apoyo" style="max-height: 3rem;"></a>
                                           
                                       <a href="{{route('modificacion_solicitudcapacitacion',['Id_solicitudcapacitacion'=>$c->Id_solicitudcapacitacion])}}">
                                        <button type="button" class="btn btn-info">Modificar</button>  </a>                                        
                                           @if($c ->deleted_at)
                                               <a href="{{route('activarsolicitudcapacitacion',['Id_solicitudcapacitacion'=>$c->Id_solicitudcapacitacion])}}">
                                               <button type="button" class="btn btn-warning">Activar</button>
                                               
                                               <a href="{{route('eliminarsolicitudcapacitacion',['Id_solicitudcapacitacion'=>$c->Id_solicitudcapacitacion])}}">
                                               <button type="button" class="btn btn-secondary">Eliminar</button>
                                               
                                               @else
                                               <a href="{{route('desactivarsolicitudcapacitacion',['Id_solicitudcapacitacion'=>$c->Id_solicitudcapacitacion])}}">
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