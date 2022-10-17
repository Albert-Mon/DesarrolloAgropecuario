     <!--Vista para MODIFICAR tipo de apoyo-->
    <!--Carga la vista pricipal "index.blade.php"-->
    @extends ('index')
    <!--LLama todo lo que tenemos en contenido de la plantilla-->
    @section ('contenido')

    <!--Aqui los contenidos especificos-->
    <section class="container mb-5">
    <div class="card border-primary">
      <div class="card-header"> Editar Programa/Apoyo</div>
      <div class="card-body">
          <!--ACCION DEL FORMULARIO PARA MODIFICAR-->
      <form action="{{route('guardarcambiostipoapoyo')}}" method = "POST">
      {{csrf_field()}}        

        <div class="mb-3">
        <input type="text"  name="Id_tipoapoyo" id="Id_tipoapoyo" hidden value="{{$consulta ->Id_tipoapoyo}}" class="form-control"tabindex="5">

                <label for="name" class="form-label mb-0 text-accent">Nombre del Apoyo/Programa:</label>
                <input type="text" class="form-control" value= "{{$consulta ->nombretipoapoyo}}" name="nombretipoapoyo"id="nombretipoapoyo" placeholder="Nombre del Apoyo/Programa" required>
              </div>
            
              <div class="mb-3">
                <label for="descripcion" class="form-label mb-0 text-accent">Descripción:</label>
                <input type="text" value= "{{$consulta ->descripciontipoapoyo}}" name="descripciontipoapoyo" id="descripciontipoapoyo" class="form-control" placeholder="Decripción que contiene el Apoyo/Programa" required>
            
              </div>
              <a href="{{route('reportetipoapoyo')}}">
              <button type="button" class="btn btn-secondary"value="cancelar">Cancelar</button></a>

              <button type="submit" class="btn btn-primary"value="guardarcambiostipoapoyo">Guardar</button>
            </form>

    </div>
    </div>
    </section>
    <br>
    @stop