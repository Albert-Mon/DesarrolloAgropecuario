<!--Vista para Ver contenido del apoyo-->

<!--Vista Detalles apoyo SOLICITADO-->

<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
      <h3 class="my-3">SOLICITUD DE LA CAPACITACIÓN</h3>
          @foreach($consulta as $c)
          <h5 class="my-3 form-label mb-0 text-accent">{{$c->nombrecap}}</h5>
        <h5 class="my-3">Nombre del Solicitante: {{$c->Id_perfilproductor}}</h5>
        <P class="form-label mb-0 text-accent"> Estatus: {{$c->nomestatus}}</P>
        <table class="table table-hover">
          <tr>
            <th>Descripcion</th>
            <th>Categoría</th>
            <th>Lugar</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Hora</th>
          </tr>
          <tr>
            <td>{{$c->descap}}</td>
            <td>{{$c->cat}}</td>
            <td>{{$c->lugar}}</td> 
            <td>{{$c->fechainicio}}</td>
            <td>{{$c->fechafinal}}</td>
            <td>{{$c->hora}}</td> 
          </tr>
        </table>
        <label class="form-label mb-0 text-accent">Aprendizaje esperado:</label>
        <textarea readonly='readonly'class="form-control"tabindex="5">{{$c->comentario}}</textarea>
        @endforeach

        <div class="d-grid gap-2 col-4 mx-auto">
          <a class="btn btn-secondary btn-sm shadow my-3" href="{{route('reportesolicitudcapacitacion')}}">Regresar</a>
          <a class="btn btn-success btn-sm shadow my-3" href="#">Imprimir</a>

        </div>
      </div>
    </div>
  </section>

@stop