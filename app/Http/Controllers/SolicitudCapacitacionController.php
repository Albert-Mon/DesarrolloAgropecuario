<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipocapacitaciones;
use App\Models\solicitudcapacitaciones;
use App\Models\estatus;
use App\Models\users;
use Session;

class SolicitudCapacitacionController extends Controller
{
    //ALTA DESDE ADMIN
    public function Altasolicitudcapacitacion()
    {
        $consulta = solicitudcapacitaciones::orderBy('Id_solicitudcapacitacion','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->Id_solicitudcapacitacion + 1;
        }
        $consulta2 = tipocapacitaciones::all();

        return view('Altasolicitudcapacitacion')
        ->with('consulta2',$consulta2)
                ->with('idsigue', $idsigue);

    }

//Guardar los datos

public function guardarsolicitudcapacitacion(Request $request){


//Guardar Datos en BD
$solicitudcapacitaciones = new solicitudcapacitaciones;
//campos de solo lectura (llaves foreaneas)
$solicitudcapacitaciones -> Id_tipocapacitacion= $request-> Id_tipocapacitacion;
$solicitudcapacitaciones -> Id_estatus = $request-> Id_estatus;
$solicitudcapacitaciones -> Id_perfilproductor = $request-> Id_perfilproductor ;
$solicitudcapacitaciones -> comentario = $request-> comentario ;
$solicitudcapacitaciones -> save();

//mensaje flash-alta
Session::flash('mensaje', "Se ha Realizado la solicitud
                        corectamente");
    return redirect()->route('reportesolicitudcapacitacion');
    }
//Reporte de SOLICITUDES CAPACITACIONES_ADMIN
public function reportesolicitudcapacitacion(){
    $consulta = solicitudcapacitaciones::withTrashed()
    ->join('tipocapacitaciones','solicitudcapacitaciones.Id_tipocapacitacion','=','tipocapacitaciones.Id_tipocapacitacion')
    ->join('estatuses','solicitudcapacitaciones.Id_estatus','=','estatuses.Id_estatus')
    ->select('solicitudcapacitaciones.Id_solicitudcapacitacion',
            'solicitudcapacitaciones.Id_tipocapacitacion',
            'solicitudcapacitaciones.Id_perfilproductor',
            'tipocapacitaciones.nombretipocapacitacion as nombrecap',
            'estatuses.nombre_estatus as nomestatus',
            'tipocapacitaciones.categoria as cat',
            'solicitudcapacitaciones.deleted_at',
            'solicitudcapacitaciones.created_at')
    ->orderBy('Id_solicitudcapacitacion', 'DESC')
    ->get();
    return view ('reportesolicitudcapacitacion') ->with('consulta',$consulta);
}

//Desactvar solicitud de la Capacitacion
    public function desactivarsolicitudcapacitacion($Id_solicitudcapacitacion){
    $Tipoapoyos=solicitudcapacitaciones::find($Id_solicitudcapacitacion);
    $Tipoapoyos->delete();
    //mensaje flash-desactivar
    Session::flash('mensaje', "Se ha Desactivado la solicitud para la capacitación
    corectamente");
    return redirect()->route('reportesolicitudcapacitacion');
}
//Actvar solicitud de Capacitacion
public function activarsolicitudcapacitacion($Id_solicitudcapacitacion){
$consulta = solicitudcapacitaciones::withTrashed()->where('Id_solicitudcapacitacion',$Id_solicitudcapacitacion)->restore();
//mensaje flash-Activar
Session::flash('mensaje', "Se ha Activado la solicitud
corectamente");
return redirect()->route('reportesolicitudcapacitacion');

}
//Eiminar definitivamente Solicitud Capacitación en BD
public function eliminarsolicitudcapacitacion($Id_solicitudcapacitacion){
 
    $consulta = solicitudcapacitaciones::withTrashed()->find($Id_solicitudcapacitacion)->forceDelete();
    //mensaje flash-Eliminar
    Session::flash('mensaje', "Se ha Eliminado Definiitivamente la solicitud
    corectamente");
    return redirect()->route('reportesolicitudcapacitacion');
    
    }
//Eiminar/Cancelar definitivamente Solicitud Apoyo en BD desde el perfil del usuario
public function cancelarsolicitudcapacitacion($Id_solicitudcapacitacion){
        
    $consulta = solicitudcapacitaciones::withTrashed()->find($Id_solicitudcapacitacion)->forceDelete();
    //mensaje flash-Cancelar
    Session::flash('mensaje', "Haz Cancelado Definitivamente Tu Solicitud para la Capacitación");
    return redirect()->route('perfil_solicitudescapacitacion');
    
    }
//ver detalles de la solicitud desde ADMIN
public function detallecapacitacionadmin($Id_solicitudcapacitacion){
$consulta = solicitudcapacitaciones::withTrashed()->join('tipocapacitaciones','solicitudcapacitaciones.Id_tipocapacitacion','=','tipocapacitaciones.Id_tipocapacitacion')
->join('estatuses','solicitudcapacitaciones.Id_estatus','=','estatuses.Id_estatus')
->select('solicitudcapacitaciones.Id_solicitudcapacitacion','solicitudcapacitaciones.Id_tipocapacitacion',
'solicitudcapacitaciones.Id_perfilproductor','tipocapacitaciones.nombretipocapacitacion as nombrecap',
'tipocapacitaciones.descripciontipocapacitacion as descap','tipocapacitaciones.lugar as lugar','tipocapacitaciones.horario as hora',
'tipocapacitaciones.fechafinal as fechafinal','tipocapacitaciones.fechainicio as fechainicio','solicitudcapacitaciones.comentario as comentario',
'estatuses.nombre_estatus as nomestatus',
'tipocapacitaciones.categoria as cat','solicitudcapacitaciones.deleted_at','solicitudcapacitaciones.created_at')
->where('Id_solicitudcapacitacion',$Id_solicitudcapacitacion)
->get();
return view ('detallecapacitacionadmin')
->with('consulta',$consulta);
}
//ver detalles de la solicitud desde USER

public function detallecapacitacionuser($Id_solicitudcapacitacion){
    $consulta = solicitudcapacitaciones::withTrashed()->join('tipocapacitaciones','solicitudcapacitaciones.Id_tipocapacitacion','=','tipocapacitaciones.Id_tipocapacitacion')
    ->join('estatuses','solicitudcapacitaciones.Id_estatus','=','estatuses.Id_estatus')
    ->select('solicitudcapacitaciones.Id_solicitudcapacitacion','solicitudcapacitaciones.Id_tipocapacitacion',
    'solicitudcapacitaciones.Id_perfilproductor','tipocapacitaciones.nombretipocapacitacion as nombrecap',
    'tipocapacitaciones.descripciontipocapacitacion as descap','tipocapacitaciones.lugar as lugar','tipocapacitaciones.horario as hora',
    'tipocapacitaciones.fechafinal as fechafinal','tipocapacitaciones.fechainicio as fechainicio',
    'estatuses.nombre_estatus as nomestatus',
    'tipocapacitaciones.categoria as cat','solicitudcapacitaciones.deleted_at','solicitudcapacitaciones.created_at')
    ->where('Id_solicitudcapacitacion',$Id_solicitudcapacitacion)
->get();
    return view ('detallecapacitacionuser')
    ->with('consulta',$consulta);
    }

//MODIFICACIÓN 
public function modificacion_solicitudcapacitacion($Id_solicitudcapacitacion){
$consulta = solicitudcapacitaciones::withTrashed()->join('tipocapacitaciones','solicitudcapacitaciones.Id_tipocapacitacion','=','tipocapacitaciones.Id_tipocapacitacion')
->join('estatuses','solicitudcapacitaciones.Id_estatus','=','estatuses.Id_estatus')
->select('solicitudcapacitaciones.Id_solicitudcapacitacion','solicitudcapacitaciones.Id_tipocapacitacion',
'solicitudcapacitaciones.Id_perfilproductor','tipocapacitaciones.nombretipocapacitacion as nombrecap','estatuses.nombre_estatus as nomestatus',
'tipocapacitaciones.categoria as cat','solicitudcapacitaciones.deleted_at','solicitudcapacitaciones.created_at')
->where ('Id_solicitudcapacitacion',$Id_solicitudcapacitacion) 
->get();
$estado = estatus::all();
$tipo = tipocapacitaciones::all();
return view ('modificacion_solicitudcapacitacion')
->with('estado',$estado)
->with('tipo',$tipo)
->with('consulta',$consulta[0]);
}

public function guardarcambioscapacitacion(Request $request){

$solicitudcapacitaciones = solicitudcapacitaciones::withTrashed()->find($request->Id_solicitudcapacitacion);
 $solicitudcapacitaciones -> Id_tipocapacitacion= $request-> Id_tipocapacitacion;
 $solicitudcapacitaciones -> Id_estatus = $request-> Id_estatus;
 $solicitudcapacitaciones -> Id_perfilproductor = $request-> Id_perfilproductor ;
 $solicitudcapacitaciones -> save();
//mensaje flash-Modificación
Session::flash('mensaje', "Se ha Modificado la solicitud
corectamente");
return redirect()->route('reportesolicitudcapacitacion');
}  

//ALTA CON ID DE APOYO DESDE USER
public function Formulario_solicitudcapacitacion($Id_tipocapacitacion){
$consulta= tipocapacitaciones::select('tipocapacitaciones.Id_tipocapacitacion',
'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
'tipocapacitaciones.horario','tipocapacitaciones.lugar')
->where('Id_tipocapacitacion',$Id_tipocapacitacion)
->get();
return view('Formulario_solicitudcapacitacion')
->with('consulta',$consulta);

}
//GUARDAR DATOS
public function guardarform_Idcapacitacion(Request $request){
//Guardar Datos en BD
$solicitudcapacitaciones = new solicitudcapacitaciones;
//campos de solo lectura (llaves foreaneas)
$solicitudcapacitaciones -> Id_tipocapacitacion= $request-> Id_tipocapacitacion;
$solicitudcapacitaciones -> Id_estatus = $request-> Id_estatus;
$solicitudcapacitaciones -> Id_perfilproductor = $request-> Id_perfilproductor ;
$solicitudcapacitaciones -> comentario = $request-> comentario ;
$solicitudcapacitaciones -> save();
//mensaje flash-alta_USER
Session::flash('mensaje', "Se ha Enviado tu solicitud solicitud
corectamente");
return redirect()->route('perfil_solicitudescapacitacion');
}

//Perfil Solicitudes
public function perfil_solicitudescapacitacion()
{
    $consulta = solicitudcapacitaciones::withTrashed()->join('tipocapacitaciones','solicitudcapacitaciones.Id_tipocapacitacion','=','tipocapacitaciones.Id_tipocapacitacion')
    ->join('estatuses','solicitudcapacitaciones.Id_estatus','=','estatuses.Id_estatus')
    ->select('solicitudcapacitaciones.Id_solicitudcapacitacion','solicitudcapacitaciones.Id_tipocapacitacion',
    'solicitudcapacitaciones.Id_perfilproductor','tipocapacitaciones.nombretipocapacitacion as nombrecap','estatuses.nombre_estatus as nomestatus',
    'tipocapacitaciones.categoria as cat','solicitudcapacitaciones.deleted_at','solicitudcapacitaciones.created_at')
    ->orderBy('Id_solicitudcapacitacion', 'DESC')
    ->get();
    return view('perfil_solicitudescapacitacion')
    ->with('consulta',$consulta);
    
}   
}
