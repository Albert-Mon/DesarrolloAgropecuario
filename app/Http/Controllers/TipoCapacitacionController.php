<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipocapacitaciones;
use App\Models\solicitudcapacitaciones;
use Session;

class TipoCapacitacionController extends Controller
{
        //VISTA SOLICITAR CAPACITACION DESDE USER
public function solicitarcapacitacion_user(){

    $consulta2 = tipocapacitaciones::onlyTrashed()->select('tipocapacitaciones.Id_tipocapacitacion',
    'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
    'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
    'tipocapacitaciones.horario','tipocapacitaciones.lugar',
    'tipocapacitaciones.deleted_at') 
    ->get();

    $consulta = tipocapacitaciones::all();

    return view ('solicitarcapacitacion_user')
    ->with('consulta',$consulta)
    ->with('consulta2',$consulta2);
}
//ALTA DE NUEVO CAPACITACION
  
    public function altatipocapacitacion(){
        $consulta = tipocapacitaciones::orderBy('Id_tipocapacitacion','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->Id_tipocapacitacion + 1;
        }

        return view('altatipocapacitacion')
                ->with('idsigue', $idsigue);
    }
//Guardar los datos del Alta
    public function guardartipocapacitacion(Request $request){
     
        //Creaccion de Alta de Tipos de Capaitaciones
        $tipocapacitaciones = new tipocapacitaciones;
        $tipocapacitaciones -> nombretipocapacitacion = $request->nombretipocapacitacion;
        $tipocapacitaciones -> categoria = $request-> categoria;
        $tipocapacitaciones -> descripciontipocapacitacion = $request-> descripciontipocapacitacion ;
        $tipocapacitaciones -> fechainicio = $request-> fechainicio;
        $tipocapacitaciones -> fechafinal = $request-> fechafinal;
        $tipocapacitaciones -> horario = $request-> horario;
        $tipocapacitaciones -> lugar = $request-> lugar;
        $tipocapacitaciones -> save();

        //mensaje flash-alta
       Session::flash('mensaje', "Se ha Registrado una Nueva Capacitación corectamente");
         return redirect()->route('reportetipocapacitacion');
    }
//Reporte de TIPO DE Apoyos
    public function reportetipocapacitacion(){
        $consulta = tipocapacitaciones::withTrashed()->select('tipocapacitaciones.Id_tipocapacitacion',
        'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
        'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
        'tipocapacitaciones.horario','tipocapacitaciones.lugar',
        'tipocapacitaciones.deleted_at')
        ->orderBy('Id_tipocapacitacion', 'DESC')
        ->get();
        $consulta2 = tipocapacitaciones::all();
        return view ('reportetipocapacitacion')
        ->with('consulta',$consulta)
        ->with('consulta2',$consulta2);
    }
//Desactvar tipo de Capacitacion
    public function desactivartipocapacitacion($Id_tipocapacitacion){
    $tipocapacitaciones=tipocapacitaciones::find($Id_tipocapacitacion);
    $tipocapacitaciones->delete();
    //mensaje flash-desactivar
    Session::flash('mensaje', "Se ha Desactivado el Apoyo/Programa corectamente para los Productores");
    return redirect()->route('reportetipocapacitacion');
    }
//Actvar tipo de Capacitacion
    public function activartipocapacitacion($Id_tipocapacitacion){
        $consulta = tipocapacitaciones::withTrashed()->where('Id_tipocapacitacion',$Id_tipocapacitacion)->restore();
        //mensaje flash-Activar
        Session::flash('mensaje', "Se ha Activado el Apoyo/Programa corectamente para los productores");
             return redirect()->route('reportetipocapacitacion');
        
        }
//Eiminar definitivamente Tipo capacitacion en BD
    public function eliminartipocapacitacion($Id_tipocapacitacion){
        $buscartipoapoyo=solicitudcapacitaciones::where('Id_tipocapacitacion',$Id_tipocapacitacion)->get();
        $cuatossolicitudtipoapoyo=count($buscartipoapoyo);

        if($cuatossolicitudtipoapoyo==0){
        $consulta = tipocapacitaciones::withTrashed()->find($Id_tipocapacitacion)->forceDelete();
        //mensaje flash-Eliminar
        Session::flash('mensaje', "Se ha Eliminado Definitivamente la convocatoria de la capacitación correctamente");
             return redirect()->route('reportetipocapacitacion');
        
        }
        else{
            Session::flash('error', "Se han Encontrado Solicitudes Activas para esta capacitacin
            por lo que no es posible eliminarlo");
            return redirect()->route('reportetipocapacitacion');
       
        }
    }

//ver detalles de Tipo Capacitacion_ADMIN
    public function vercapacitacionadmin($Id_tipocapacitacion){
        $consulta = tipocapacitaciones::withTrashed()->select('tipocapacitaciones.Id_tipocapacitacion',
        'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
        'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
        'tipocapacitaciones.horario','tipocapacitaciones.lugar',
        'tipocapacitaciones.deleted_at')
        ->where('Id_tipocapacitacion',$Id_tipocapacitacion)
        ->get();
        return view ('vercapacitacionadmin')
        ->with('consulta',$consulta);
    }

//ver detalles de Tipo Capacitacion_USER
    public function vercapacitacionuser($Id_tipocapacitacion){
        $consulta = tipocapacitaciones::withTrashed()->select('tipocapacitaciones.Id_tipocapacitacion',
        'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
        'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
        'tipocapacitaciones.horario','tipocapacitaciones.lugar',
        'tipocapacitaciones.deleted_at')
        ->where('Id_tipocapacitacion',$Id_tipocapacitacion)
        ->get();
        return view ('vercapacitacionuser')
        ->with('consulta',$consulta);
    }

//MOLDIFICACION

    public function modificacion_tipocapacitacion($Id_tipocapacitacion){
        $consulta = tipocapacitaciones::withTrashed()->select('tipocapacitaciones.Id_tipocapacitacion',
        'tipocapacitaciones.nombretipocapacitacion','tipocapacitaciones.descripciontipocapacitacion',
        'tipocapacitaciones.categoria','tipocapacitaciones.fechainicio','tipocapacitaciones.fechafinal',
        'tipocapacitaciones.horario','tipocapacitaciones.lugar')
        ->where ('Id_tipocapacitacion',$Id_tipocapacitacion) 
        ->get();
        return view ('modificacion_tipocapacitacion')
        ->with('consulta',$consulta[0]);
    }

    public function guardarcambiostipocapacitacion(Request $request){
        
            $tipocapacitaciones = tipocapacitaciones::withTrashed()->find($request->Id_tipocapacitacion);
            $tipocapacitaciones -> nombretipocapacitacion = $request->nombretipocapacitacion;
            $tipocapacitaciones -> categoria = $request-> categoria;
            $tipocapacitaciones -> descripciontipocapacitacion = $request-> descripciontipocapacitacion ;
            $tipocapacitaciones -> fechainicio = $request-> fechainicio;
            $tipocapacitaciones -> fechafinal = $request-> fechafinal;
            $tipocapacitaciones -> horario = $request-> horario;
            $tipocapacitaciones -> lugar = $request-> lugar;
             $tipocapacitaciones -> save();

            //mensaje flash-Modificación
            Session::flash('mensaje', "Se ha Modificado corectamente");
            return redirect()->route('reportetipocapacitacion');
            
        }
}
