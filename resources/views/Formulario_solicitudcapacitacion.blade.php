<!--Vista para solicitar capacitacion desde usuario-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <!--Aqui va un Aviso de privacidad-->
       
<div class="card border-primary">
  <div class="card-header">Soicitar Capacitación</div>
  <div class="card-body">
      <!--ACCION DEL FORMULARIO-->
  <form action="{{route('guardarform_Idcapacitacion')}}" method = "POST">
  {{csrf_field()}} 
                <!--CAMPO OCULTO-->

                <input type="hidden"  name="Id_estatus" id="Id_estatus" value="6" readonly='readonly'class="form-control"tabindex="5">
                                                
                <div class="row">
                <div class="col-sm-6">
                <div class="mb-3">
                <label for="name" class="form-label mb-0 text-accent"> Nombre del Apoyo</label>
                    @foreach($consulta as $c)
                    <h6 class="my-3">{{$c->nombretipocapacitacion}}</h6>
                    <input type="hidden"  name="Id_tipocapacitacion" id="Id_tipocapacitacion" value="{{$c->Id_tipocapacitacion}}" readonly='readonly'class="form-control"tabindex="5">

            @endforeach   
                </div>
                </div>
                <div class="col-sm-6">
                <div class="mb-3">

                        <!--Id_perfilproductor_ Falta Concretar-->
                        <label for="name" class="form-label mb-0 text-accent"> Nombre del solicitante</label>

                        <input type="text" class="form-control" name="Id_perfilproductor"id="Id_perfilproductor" placehoslder="ID_PERFILPRODUCTOR (Nombre productor)" required>
                            </div> 
                </div>
                </div>
                <div class="mb-3">

                    <label for="name" class="form-label mb-0 text-accent">¿Qué te gustaría aprender de esta capacitación?</label>
                    <input type="text" class="form-control" name="comentario"id="comentario" required>
                        </div> 

                        <div>
                      <a href="{{route('solicitarcapacitacion_user')}}">
                    <button type="button" class="btn btn-secondary" value="cancelar">Cancelar</button></a>
                    <button type="submit" class="btn btn-primary"value="guardarsolicitud">Confirmar y Enviar</button>
                        </div>
                   
                    </div>
                                   
                   
                  
        </form>

</div>
</div>
</section>
<br>
@stop