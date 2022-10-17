    <!--Vista para agregar Una capacitacion-->
    <!--Carga la vista pricipal "index.blade.php"-->
    @extends ('index')
    <!--LLama todo lo que tenemos en contenido de la plantilla-->
    @section ('contenido')

    <!--Aqui los contenidos especificos-->
    <section class="container mb-5">
    <div class="card border-primary">
      <div class="card-header"> Crear una nueva convocatoria para capacitación</div>
      <div class="card-body">
          <!--ACCION DEL FORMULARIO-->
      <form action="{{route('guardartipocapacitacion')}}" method = "POST">
      {{csrf_field()}}        


    <div class="row">
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent">Nombre de Capacitación:
                    @if($errors->first('nombretipocapacitacion'))
                              <p class='text-danger'> {{$errors->first('nombretipocapacitacion')}}</p>
                    @endif   
                    </label>
  <input type="text" class="form-control" name="nombretipocapacitacion"id="nombretipocapacitacion" placeholder="Nombre de Capacitación">
                                
  </div>
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent">Categoria:
                    @if($errors->first('categoria'))
                              <p class='text-danger'> {{$errors->first('categoria')}}</p>
                    @endif   
                    </label>
  <input type="text" class="form-control" name="categoria"id="categoria" placeholder="Ganaderia/Pecuaria/Forestal etc.">
                 
  </div>
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent">Descripción:
                    @if($errors->first('descripciontipocapacitacion'))
                              <p class='text-danger'> {{$errors->first('descripciontipocapacitacion')}}</p>
                    @endif   
                    </label>
  <input type="text" class="form-control" name="descripciontipocapacitacion"id="descripciontipocapacitacion" placeholder="Descripción.">
    
  </div>
  </div>
  <div class="row">
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent"> Fecha de Inicio:
                    @if($errors->first('fechainicio'))
                              <p class='text-danger'> {{$errors->first('fechainicio')}}</p>
                    @endif   
                    </label>
  <input type="date" class="form-control" name="fechainicio"id="fechainicio" required>
                                
  </div>
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent">Fecha de Fin:
                    @if($errors->first('fechafinal'))
                              <p class='text-danger'> {{$errors->first('fechafinal')}}</p>
                    @endif   
                    </label>
  <input type="date" class="form-control" name="fechafinal"id="fechafinal" required>
                 
  </div>
  <div class="col-sm-4">
  <label for="name" class="form-label mb-0 text-accent">Horario:
                    @if($errors->first('horario'))
                              <p class='text-danger'> {{$errors->first('horario')}}</p>
                    @endif   
                    </label>
  <input type="text" class="form-control" name="horario"id="horario" placeholder="Horario">
    
  </div>
  </div>
  
  <label for="name" class="form-label mb-0 text-accent">Lugar de Capacitación:
                    @if($errors->first('lugar'))
                              <p class='text-danger'> {{$errors->first('lugar')}}</p>
                    @endif   
                    </label>
  <input type="text" class="form-control" name="lugar"id="lugar" placeholder="Lugar de Capacitación">
                                
              <br>
              <a href="{{route('reportetipocapacitacion')}}">
              <button type="button" class="btn btn-secondary"value="cancelar">Cancelar</button></a>

              <button type="submit" class="btn btn-primary"value="guardartipoApoyo">Guardar</button>
              
            </form>

    </div>
    </div>
    </section>
    <br>
    @stop