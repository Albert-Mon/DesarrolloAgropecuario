<!--Vista para agregar otro tipo de apoyo-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container">
  
    <div class="row justify-content-sm-center">
      <div class="col-12 col-md-10">
        <div>
          <a class="btn btn-primary shadow my-3" href="{{route('reportesolicitudapoyo')}}"><strong>10</strong> Nuevas Solicitudes Realizadas</a>
        </div>
      </div>
    </div>
  </section>
  <section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
        <h4 class="my-3">Convocatorias Abiertas/Activas</h4>
        <P>Convocatorias que estan recibiendo solicitud:</P>
        @if(Session::has('mensaje'))
       <div class="alert alert-success">
        {{Session::get('mensaje')}}
       </div>
       @endif
       @if(Session::has('error'))
       <div class="alert alert-warning">
        {{Session::get('error')}}
       </div>
       @endif

          <!--Tamaño Targeta-->
          <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($consulta2 as $c)
        <div class="col">
            <div class="card h-100 rounded-4 bg-accent shadow">
              <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-info text-dark">
                <h6 class="mb-0">99+</h6>
              </span>
              <div class="card-body d-flex align-items-center">
                <div class="p-3">
                  <h4 class="text-white my-3">{{$c->nombretipoapoyo}}</h4>
                  <p class="text-white">{{$c->descripciontipoapoyo}}</p>
                  <div class="d-grid gap-2 d-flex justify-content-end">
                  <a href="{{route('verapoyoadmin',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}" class="btn btn-outline-light shadow my-3">Ver</a>
                    <a href="{{route('modificacion_tipoapoyos',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}" class="btn btn-outline-light shadow my-3">Modificar</a>
                    <a href="{{route('desactivartipoapoyo',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}" class="btn btn-outline-light shadow my-3">Desactivar</a>
                  </div>
                </div>
              </div>
            </div>     
          </div>        
          @endforeach

        </div>
      </div>      
    </div>         

  </section>
          
  <section class="">
    
    <div class="container mb-5">
    <h5> Todos los Apoyos Agropecuario</h5>

      <div class="row justify-content-md-center p-2">
      <div>
      <a class="btn btn-success" href="{{route('Altatipoapoyo')}}">Crear Nuevo</a>
      </div>
      <br></br>
  <div class="table-responsive">
  <table class="table table-bordered">
                                   
                                   <thead>
                                   <tr>
                                 
                                       <th >Nombre Apoyo/Programa</th>
                                       <th >Descripción</th>
                                       <th >Acciones</th>
                                   </tr>
                                   </thead>

                                   <tbody>
                                   <tr>
                                    @foreach ($consulta as $c)
                                       <th>{{$c -> nombretipoapoyo}}</td>
                                       <td>{{$c -> descripciontipoapoyo}}</td>
                                       <td>
                                         
                                       <a class="navbar-brand" href="{{route('verapoyoadmin',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}"> <img class="me-3" src="assets/img/ver.png" alt="Apoyo" style="max-height: 3rem;"></a>
                                           <!--BOTONES-->
                                              <a href="{{route('modificacion_tipoapoyos',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}">
                                              <button type="button" class="btn btn-info">Modificar</button>                                           
                                                @if($c ->deleted_at)
                                               <a href="{{route('activartipoapoyo',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}">
                                               <button type="button" class="btn btn-warning">Activar</button>
                                               
                                               <a href="{{route('eliminartipoapoyo',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}">
                                               <button type="button" class="btn btn-secondary">Eliminar</button>
                                               
                                               @else
                                               <a href="{{route('desactivartipoapoyo',['Id_tipoapoyo'=>$c->Id_tipoapoyo])}}">
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