<!--Vista para Ver contenido de la solicitud -->

<!--Vista Detalles apoyo SOLICITADO desde el usuario-->

<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
      <h4 class="my-3">DETALLE DE LA SOLICITUD DEL APOYO</h4>
          @foreach($consulta as $c)
          <h5 class="my-3 form-label mb-0 text-accent">{{$c->nombreapoyo}}</h5>
          <br>
        <table class="table table-bordered">
          <tr>
            <th>Descripción</th>
            <th>Fecha de envio</th>  
            <th>Estatus</th>
          </tr>
          <tr>
            <td>{{$c->desapoyo}}</td>
            <td>{{$c->created_at}}</td>
            <td class="form-label mb-0 text-accent">{{$c->nomestatus}}</td>
          </tr>
        </table>
          @endforeach

        <div class="d-grid gap-2 col-4 mx-auto">
          <a class="btn btn-secondary btn-sm shadow my-3" href="{{route('perfil_solicitudes')}}">Regresar</a>
        </div>
      </div>
    </div>
  </section>

@stop