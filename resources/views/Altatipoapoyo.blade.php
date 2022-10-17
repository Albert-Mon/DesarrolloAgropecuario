    <!--Vista para agregar otro tipo de apoyo-->
    <!--Carga la vista pricipal "index.blade.php"-->
    @extends ('index')
    <!--LLama todo lo que tenemos en contenido de la plantilla-->
    @section ('contenido')

    <!--Aqui los contenidos especificos-->
    <section class="container mb-5">
    <div class="card border-primary">
      <div class="card-header">Activar un nuevo Apoyo/Programa</div>
      <div class="card-body">
          <!--ACCION DEL FORMULARIO-->
      <form action="{{route('guardartipoapoyo')}}" method = "POST">
      {{csrf_field()}}        

    <!--Id_tipoapoyo
        <span class="badge bg-secondary" name="Id_tipoapoyo" id="Id_tipoapoyo" value="{{$idsigue}}"></span>
    --->
        <div class="mb-3">
                <label for="name" class="form-label mb-0 text-accent">Nombre del Apoyo/Programa:</label>
                <input type="text" class="form-control" name="nombretipoapoyo"id="nombretipoapoyo" placeholder="Nombre del Apoyo/Programa" required>
              </div>
            
              <div class="mb-3">
                <label for="descripcion" class="form-label mb-0 text-accent">Descripción:</label>
                <input type="text"name="descripciontipoapoyo" id="descripciontipoapoyo" class="form-control" placeholder="Decripción que contiene el Apoyo/Programa" required>
            
              </div>
              <a href="{{route('reportetipoapoyo')}}">
              <button type="button" class="btn btn-secondary"value="cancelar">Cancelar</button></a>

              <button type="submit" class="btn btn-primary"value="guardartipoApoyo">Guardar</button>
            </form>

    </div>
    </div>
    </section>
    <br>
    @stop