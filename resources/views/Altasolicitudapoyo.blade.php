<!--Vista para agregar una solicitud desde Admin-->
<!--Carga la vista pricipal "index.blade.php"-->
@extends ('index')
<!--LLama todo lo que tenemos en contenido de la plantilla-->
@section ('contenido')

<!--Aqui los contenidos especificos-->
<section class="container mb-5">
<div class="card border-primary">
  <div class="card-header">Soicitar</div>
  <div class="card-body">
      <!--ACCION DEL FORMULARIO-->
  <form action="{{route('guardarsolicitudapoyo')}}" method = "POST">
  {{csrf_field()}} 
                <!--CAMPO OCULTO-->
                <input type="hidden"  name="Id_estatus" id="Id_estatus" value="6" readonly='readonly'class="form-control"tabindex="5">
                                                
                <div class="row">
                <div class="col-sm-6">
                <div class="mb-3">
                <label for="name" class="form-label mb-0 text-accent"> Nombre del Apoyo</label>
                        <select  name="Id_tipoapoyo"class="form-control"tabindex="5" required >
                        <option value="">--Selecciona--</option>
                        @foreach($consulta2 as $c)
                        <option value="{{$c->Id_tipoapoyo}}">{{ $c->nombretipoapoyo }} </option>
                        @endforeach
                        </select>  
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
               
                    <div>
                    <a href="{{route('reportesolicitudapoyo')}}">

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