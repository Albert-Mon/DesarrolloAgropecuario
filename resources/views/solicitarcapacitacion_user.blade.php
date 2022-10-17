 <!--Vista para solicitar una capacitacion-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container">
    <div class="row justify-content-sm-center p-2">
      <div class="col-12 col-md-10">
        <div>
          <a class="btn btn-primary shadow my-3" href="#"><strong>10</strong> Solicitudes Realizadas</a>
        </div>
      </div>
    </div>
  </section>
  <section class="container mb-5">
    <div class="row justify-content-md-center p-2">
      <div class="col-12 col-lg-10">
        <h4 class="my-3">Convocatorias Abiertas para Capacitaciones</h4>
        <P>Estas Capacitaciones estan disponibles ahora.</P>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($consulta as $c)

          <div class="col">
            <div class="card h-100 rounded-4 bg-accent shadow">
              <div class="card-body d-flex align-items-center">
                <div class="p-3">
                  <h4 class="text-white my-3">{{$c->nombretipocapacitacion}}</h4>
                  <p class="text-white">Categoría: {{$c->categoria}}</p>
                  <div class="d-grid gap-2">
                    <a class="btn btn-light btn-sm shadow my-3" href="{{route('Formulario_solicitudcapacitacion',['Id_tipocapacitacion'=>$c->Id_tipocapacitacion])}}">Solicitar</a>
                    <a class="btn btn-light btn-sm shadow my-3" href="{{route('vercapacitacionuser',['Id_tipocapacitacion'=>$c->Id_tipocapacitacion])}}">Ver</a>

                  </div>

                </div>
              </div>
            </div>
          </div>
          @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-light">
    <div class="container">
      <div class="row justify-content-md-center p-2">
        <div class="col-12 col-lg-10 py-5">
          <h4>Apoyos Agropecuario</h4>
          <P>Otros apoyos en espera. </P>
            @foreach($consulta2  as $c)
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
              <img class="me-3" src="assets/img/replantar.png" alt="Apoyo" style="max-height: 2rem;">
                {{$c->nombretipocapacitacion}}
            </li>
          </ul>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@stop