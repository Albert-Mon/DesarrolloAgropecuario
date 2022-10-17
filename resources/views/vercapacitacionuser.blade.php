 <!--Vista para Ver contenido de la capacitazcion desde admin-->

<!--Vista Detalles de Tipo de Capacitacion-->

<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
        
        @foreach($consulta as $c)
      <h3 class="my-3 form-label mb-0 text-accent">{{$c->nombretipocapacitacion}}</h3>
      <table class="table">
          <tr>
            <th>Descripcion</th>
            <th>Categoría</th>
            <th>Lugar</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Hora</th>
          </tr>
          <tr>
            <td>{{$c->descripciontipocapacitacion}}</td>
            <td>{{$c->categoria}}</td>
            <td>{{$c->lugar}}</td> 
            <td>{{$c->fechainicio}}</td>
            <td>{{$c->fechafinal}}</td>
            <td>{{$c->horario}}</td> 
          </tr>
         
        </table>
        @endforeach
        <div class="d-grid gap-2 col-4 mx-auto">
          <a class="btn btn-secondary btn-sm shadow my-3" href="{{route('solicitarcapacitacion_user')}}">Regresar</a>
        </div>
      </div>
    </div>
  </section>

@stop