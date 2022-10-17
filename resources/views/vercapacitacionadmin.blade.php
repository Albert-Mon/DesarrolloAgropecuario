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
      <h3 class="my-3">{{$c->nombretipocapacitacion}}</h3>
        <P>{{$c->descripciontipocapacitacion}}</P>
        @endforeach
        <div class="d-grid gap-2 col-4 mx-auto">
          <a class="btn btn-secondary btn-sm shadow my-3" href="{{route('reportetipocapacitacion')}}">Regresar</a>
        </div>
      </div>
    </div>
  </section>

@stop