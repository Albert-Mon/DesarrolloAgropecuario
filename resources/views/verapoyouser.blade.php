<!--Vista para Ver contenido del apoyo desde user-->
<!--Vista Detalles de Tipo de Apoyo-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
        @foreach($consulta as $c)
      <h4 class="my-3 form-label mb-0 text-accent">{{$c->nombretipoapoyo}}</h4>
      <P class="form-label mb-0 text-accent">Descripción:</P>
        <P>{{$c->descripciontipoapoyo}}</P>
        @endforeach
        <div class="d-grid gap-2 col-4 mx-auto">
          <a class="btn btn-secondary btn-sm shadow my-3" href="{{route('solicitarapoyo_user')}}">Regresar</a>
        </div>
      </div>
    </div>
  </section>

@stop