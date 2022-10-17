<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDF Usuarios</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>
    <body>
        <div class="container">
            <div class="container">
            <a class="navbar-brand" href="#"><img src="{{asset('assets/img/logos-lerma.png')}}" alt=""></a>
            <h2 class="mb-4">PDF Usuarios</h2>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>    
                        <th>Clave</th>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th>Direccion</th>
                        <th>Localidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pdfproduc as $con)
                        <tr>
                            <th>{{$con->id_productores}}</th>
                            <td>{{$con->nombre}} {{$con->app}} {{$con->apm}}</td>
                            <td>{{$con->email}}</td>
                            <td>{{$con->direccion}}</td>
                            <td>{{$con->id_localidades}} {{$con->nombre_localidades}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</form>

    </body>

</html>