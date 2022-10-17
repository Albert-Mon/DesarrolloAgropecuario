<!--Vista para agregar una solicitud desde Admin-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
    <!--Aqui va un Aviso de privacidad-->
       
<div class="card border-primary">
  <div class="card-header">Soicitar</div>
  <div class="card-body">
      <!--ACCION DEL FORMULARIO-->
  <form action="{{route('guardarcambiossolicitudapoyo')}}" method = "POST">
  {{csrf_field()}} 
                <!--CAMPO OCULTO-->                               
                <div class="row">
                <div class="col-sm-6">
                <div class="mb-3">
                <label for="name" class="form-label mb-0 text-accent"> Nombre del Apoyo</label>
                        <select  name="Id_tipoapoyo"class="form-control"tabindex="5"required>
                        @foreach($tipo as $t)
                        <option selected="" value="{{$t->Id_tipoapoyo}}">{{ $t->nombretipoapoyo }} </option>
                        @endforeach
                        </select>  
                </div>
                </div>
                <div class="col-sm-6">
                <div class="mb-3">
                <input type="text"  name="Id_solicitudapoyo" id="Id_solicitudapoyo" hidden value="{{$consulta ->Id_solicitudapoyo}}" class="form-control"tabindex="5">


                        <!--Id_perfilproductor_ Falta Concretar-->
                        <label for="name" class="form-label mb-0 text-accent"> Nombre del solicitante</label>
                        <input type="text" class="form-control" value="{{$consulta->Id_perfilproductor}}" name="Id_perfilproductor"id="Id_perfilproductor" required readonly>
                            </div> 
                </div>
                </div>
 
  <div class="mb-3">
                <div class="mb-3">
                <label for="name" class="form-label mb-0 text-accent"> Estado de la solicitud</label>
                        <select  name="Id_estatus"class="form-control"tabindex="5"required>
                        @foreach($estado as $e)
                        <option selected="" value="{{$e->Id_estatus}}">{{ $e->nombre_estatus}} </option>
                        @endforeach
                        </select>  
                </div>
               
                    <div>
                    <button type="button" class="btn btn-secondary"value="cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-primary"value="guardarsolicitud">Confirmar y Enviar</button>
                        </div>
                    </div>
                               <br> 
                  
        </form>

</div>
</div>
</section>
<br>
@stop