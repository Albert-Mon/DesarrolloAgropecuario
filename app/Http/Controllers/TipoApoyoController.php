<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoapoyos;
use App\Models\solicitudapoyos;
use Session;

class TipoApoyoController extends Controller
{
    //ALTA DE NUEVO APOYO/PROGRAMA
    public function index(){
        return view ('index');
    }
    public function Altatipoapoyo(){
        $consulta = tipoapoyos::orderBy('Id_tipoapoyo','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->Id_tipoapoyo + 1;
        }

        return view('Altatipoapoyo')
                ->with('idsigue', $idsigue);
    }
//Guardar los datos del Alta
    public function guardartipoapoyo(Request $request){
     
        //Creaccion de Alta de Tipos de apoyos
        $Tipoapoyos = new tipoapoyos;
        $Tipoapoyos -> nombretipoapoyo = $request-> nombretipoapoyo;
        $Tipoapoyos -> descripciontipoapoyo = $request-> descripciontipoapoyo;
        $Tipoapoyos -> save();

        //mensaje flash-alta
        Session::flash('mensaje', "Se ha Registrado un Nuevo Apoyo/Programa corectamente");
             return redirect()->route('reportetipoapoyo');
    }
//Desactvar tipo de Apoyo
    public function desactivartipoapoyo($Id_tipoapoyo){
    $Tipoapoyos=tipoapoyos::find($Id_tipoapoyo);
    $Tipoapoyos->delete();
    //mensaje flash-desactivar
    Session::flash('mensaje', "Se ha Desactivado el Apoyo/Programa corectamente para los Productores");
    return redirect()->route('reportetipoapoyo');
    }
//Actvar tipo de Apoyo
    public function activartipoapoyo($Id_tipoapoyo){
        $consulta = tipoapoyos::withTrashed()->where('Id_tipoapoyo',$Id_tipoapoyo)->restore();
        //mensaje flash-Activar
        Session::flash('mensaje', "Se ha Activado el Apoyo/Programa corectamente para los productores");
             return redirect()->route('reportetipoapoyo');
        
        }
//Eiminar definitivamente Tipo Apoyo en BD
    public function eliminartipoapoyo($Id_tipoapoyo){
        $buscartipoapoyo=solicitudapoyos::where('Id_tipoapoyo',$Id_tipoapoyo)->get();
        $cuatossolicitudtipoapoyo=count($buscartipoapoyo);

        if($cuatossolicitudtipoapoyo==0){
        $consulta = tipoapoyos::withTrashed()->find($Id_tipoapoyo)->forceDelete();
        //mensaje flash-Eliminar
        Session::flash('mensaje', "Se ha Eliminado Definitivamente el Apoyo/Programa correctamente");
             return redirect()->route('reportetipoapoyo');
        
        }
        else{
            Session::flash('error', "Se han Encontrado Solicitudes Activas para este Apoyo/Programa
            por lo que no es posible eliminarlo");
            return redirect()->route('reportetipoapoyo');
       
        }
    }
//Reporte de TIPO DE Apoyos
    public function reportetipoapoyo(){
        $consulta = tipoapoyos::withTrashed()->select('tipoapoyos.Id_tipoapoyo','tipoapoyos.nombretipoapoyo',
        'tipoapoyos.descripciontipoapoyo','tipoapoyos.deleted_at')
        ->orderBy('Id_tipoapoyo', 'DESC')
        ->get();

        $consulta2 = tipoapoyos::all();

        return view ('reportetipoapoyo')
        ->with('consulta',$consulta)
        ->with('consulta2',$consulta2);
    }
//ver detalles de Tipo Apoyo
    public function verapoyoadmin($Id_tipoapoyo){
        $consulta = tipoapoyos::withTrashed()->select('tipoapoyos.Id_tipoapoyo','tipoapoyos.nombretipoapoyo',
        'tipoapoyos.descripciontipoapoyo')
        ->where('Id_tipoapoyo',$Id_tipoapoyo)
    ->get();
        return view ('verapoyoadmin')
        ->with('consulta',$consulta);
    }
//Prueba BD
    public function modelo(){
                $consulta=tipoapoyos::all();
                return $consulta;
            }
//ver detalles de Tipo Apoyo_USER
    public function verapoyouser($Id_tipoapoyo){
        $consulta = tipoapoyos::withTrashed()->select('tipoapoyos.Id_tipoapoyo','tipoapoyos.nombretipoapoyo',
        'tipoapoyos.descripciontipoapoyo')
        ->where('Id_tipoapoyo',$Id_tipoapoyo)
        ->get();
        return view ('verapoyouser')
        ->with('consulta',$consulta);
    }

//MOLDIFICACION

    public function modificacion_tipoapoyos($Id_tipoapoyo){
        $consulta = tipoapoyos::withTrashed()->select('tipoapoyos.Id_tipoapoyo',
        'tipoapoyos.nombretipoapoyo',
        'tipoapoyos.descripciontipoapoyo','tipoapoyos.deleted_at')
        ->where ('Id_tipoapoyo',$Id_tipoapoyo) 
        ->get();
        return view ('modificacion_tipoapoyos')
        ->with('consulta',$consulta[0]);
    }

    public function guardarcambiostipoapoyo(Request $request){
        
            $Tipoapoyos = tipoapoyos::withTrashed()->find($request->Id_tipoapoyo);
            $Tipoapoyos -> Id_tipoapoyo = $request-> Id_tipoapoyo;
            $Tipoapoyos -> nombretipoapoyo = $request-> nombretipoapoyo;
            $Tipoapoyos -> descripciontipoapoyo = $request-> descripciontipoapoyo;
            $Tipoapoyos -> save();

            //mensaje flash-Modificación
            Session::flash('mensaje', "Se ha Modificado el Apoyo/Programa corectamente");
            return redirect()->route('reportetipoapoyo');
            
        }
}
