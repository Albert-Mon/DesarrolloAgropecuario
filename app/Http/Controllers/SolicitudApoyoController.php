<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoapoyos;
use App\Models\solicitudapoyos;
use App\Models\estatus;
use App\Models\users;
use Session;

class SolicitudApoyoController extends Controller
{
        
    //ALTA DESDE ADMIN
    public function Altasolicitudapoyo()
    {
        $consulta = solicitudapoyos::orderBy('Id_solicitudapoyo','DESC')
                                    ->take(1)->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else{
            $idsigue = $consulta[0]->Id_solicitudapoyo + 1;
        }
        $consulta2 = tipoapoyos::all();

        return view('Altasolicitudapoyo')
        ->with('consulta2',$consulta2)
                ->with('idsigue', $idsigue);


       
    }
    
//Guardar los datos

       public function guardarsolicitudapoyo(Request $request){


        //Guardar Datos en BD
        $Solicitudapoyos = new solicitudapoyos;
        //campos de solo lectura (llaves foreaneas)
        $Solicitudapoyos -> Id_tipoapoyo = $request-> Id_tipoapoyo ;
        $Solicitudapoyos -> Id_estatus = $request-> Id_estatus;
        $Solicitudapoyos -> Id_perfilproductor = $request-> Id_perfilproductor ;
        $Solicitudapoyos -> save();

    //mensaje flash-alta
    Session::flash('mensaje', "Se ha Realizado la solicitud
                            corectamente");
            return redirect()->route('reportesolicitudapoyo');
        }
//Reporte de SOLICITUDES_ADMIN
    public function reportesolicitudapoyo(){
        $consulta = solicitudapoyos::withTrashed()
        ->join('tipoapoyos','solicitudapoyos.Id_tipoapoyo','=','tipoapoyos.Id_tipoapoyo')
        ->join('estatuses','solicitudapoyos.Id_estatus','=','estatuses.Id_estatus')
        ->join('users','solicitudapoyos.id_users','=','users.id_users')
        ->select('solicitudapoyos.Id_solicitudapoyo',
                 'solicitudapoyos.Id_tipoapoyo',
                 'solicitudapoyos.id_users',
                'tipoapoyos.nombretipoapoyo as nombreapoyo',
                'estatuses.nombre_estatus as nomestatus',
                'users.nombre as username',
                'solicitudapoyos.deleted_at',
                'solicitudapoyos.created_at')
        ->orderBy('Id_solicitudapoyo', 'DESC')
        ->get();
        return view ('reportesolicitudapoyo') ->with('consulta',$consulta);
    }


    

//Desactvar solicitud del Apoyo
    public function desactivarsolicitudapoyo($Id_solicitudapoyo){
    $Tipoapoyos=solicitudapoyos::find($Id_solicitudapoyo);
    $Tipoapoyos->delete();
    //mensaje flash-desactivar
    Session::flash('mensaje', "Se ha Desactivado la solicitud
    corectamente");
    return redirect()->route('reportesolicitudapoyo');
    }
//Actvar solicitud de Apoyo
    public function activarsolicitudapoyo($Id_solicitudapoyo){
        $consulta = solicitudapoyos::withTrashed()->where('Id_solicitudapoyo',$Id_solicitudapoyo)->restore();
        //mensaje flash-Activar
        Session::flash('mensaje', "Se ha Activado la solicitud
        corectamente");
        return redirect()->route('reportesolicitudapoyo');
        
        }
//Eiminar definitivamente Solicitud Apoyo en BD
        public function eliminarsolicitudapoyo($Id_solicitudapoyo){
         
            $consulta = solicitudapoyos::withTrashed()->find($Id_solicitudapoyo)->forceDelete();
            //mensaje flash-Eliminar
            Session::flash('mensaje', "Se ha Eliminado Definiitivamente la solicitud
            corectamente");
            return redirect()->route('reportesolicitudapoyo');
            
            }
//Eiminar/Cancelar definitivamente Solicitud Apoyo en BD desde el perfil del usuario
    public function cancelarsolicitudapoyo($Id_solicitudapoyo){
            
        $consulta = solicitudapoyos::withTrashed()->find($Id_solicitudapoyo)->forceDelete();
        //mensaje flash-Cancelarr
        Session::flash('mensaje', "Haz Cancelado Definiitivamente Tu Solicitud");
        return redirect()->route('perfil_solicitudes');
        
        }
//ver detalles de la solicitud desde ADMIN
    public function detallesolicitud_admin($Id_solicitudapoyo){
    $consulta = solicitudapoyos::withTrashed()->join('tipoapoyos','solicitudapoyos.Id_tipoapoyo','=','tipoapoyos.Id_tipoapoyo')
    ->join('estatuses','solicitudapoyos.Id_estatus','=','estatuses.Id_estatus')
    ->select('solicitudapoyos.Id_solicitudapoyo','solicitudapoyos.Id_tipoapoyo',
    'solicitudapoyos.Id_perfilproductor','tipoapoyos.nombretipoapoyo as nombreapoyo','estatuses.nombre_estatus as nomestatus',
    'tipoapoyos.descripciontipoapoyo as desapoyo','solicitudapoyos.created_at as created_at',
    'solicitudapoyos.deleted_at')
    ->where('Id_solicitudapoyo',$Id_solicitudapoyo)
   ->get();
    return view ('detallesolicitud_admin')
    ->with('consulta',$consulta);
    }
//ver detalles de la solicitud desde USER

    public function detallesolicitud_user($Id_solicitudapoyo){
        $consulta = solicitudapoyos::withTrashed()->join('tipoapoyos','solicitudapoyos.Id_tipoapoyo','=','tipoapoyos.Id_tipoapoyo')
        ->join('estatuses','solicitudapoyos.Id_estatus','=','estatuses.Id_estatus')
        ->select('solicitudapoyos.Id_solicitudapoyo','solicitudapoyos.Id_tipoapoyo',
        'solicitudapoyos.Id_perfilproductor','tipoapoyos.nombretipoapoyo as nombreapoyo','estatuses.nombre_estatus as nomestatus',
        'tipoapoyos.descripciontipoapoyo as desapoyo','solicitudapoyos.created_at as created_at',
        'solicitudapoyos.deleted_at')
        ->where('Id_solicitudapoyo',$Id_solicitudapoyo)
       ->get();
        return view ('detallesolicitud_user')
        ->with('consulta',$consulta);
        }
//PRUEBA BD
    public function modelo2(){
        $consulta= solicitudapoyos::all();
        return $consulta;
    }
//MODIFICACIÓN 
    public function modificacion_solicitudapoyo($Id_solicitudapoyo){
    $consulta = solicitudapoyos::withTrashed()->join('tipoapoyos','solicitudapoyos.Id_tipoapoyo','=','tipoapoyos.Id_tipoapoyo')
    ->join('estatuses','solicitudapoyos.Id_estatus','=','estatuses.Id_estatus')
    ->select('solicitudapoyos.Id_solicitudapoyo','solicitudapoyos.Id_tipoapoyo',
    'solicitudapoyos.Id_perfilproductor','tipoapoyos.nombretipoapoyo as nombreapoyo','estatuses.nombre_estatus as nomestatus',
    'solicitudapoyos.deleted_at','solicitudapoyos.created_at')
    ->where ('Id_solicitudapoyo',$Id_solicitudapoyo) 
    ->get();
    $estado = estatus::all();
    $tipo = tipoapoyos::all();
    return view ('modificacion_solicitudapoyo')
    ->with('estado',$estado)
    ->with('tipo',$tipo)
    ->with('consulta',$consulta[0]);
    }

    public function guardarcambiossolicitudapoyo(Request $request){
    
        $Solicitudapoyos = solicitudapoyos::withTrashed()->find($request->Id_solicitudapoyo);
         $Solicitudapoyos -> Id_tipoapoyo = $request-> Id_tipoapoyo ;
         $Solicitudapoyos -> Id_estatus = $request-> Id_estatus;
         $Solicitudapoyos -> Id_perfilproductor = $request-> Id_perfilproductor ;
         $Solicitudapoyos -> save();
        //mensaje flash-Modificación
        Session::flash('mensaje', "Se ha Modificado la solicitud
        corectamente");
        return redirect()->route('reportesolicitudapoyo');
    }  
//VISTA SOLICITAR APOYO DESDE USER
    public function solicitarapoyo_user(){

        $consulta2 = tipoapoyos::onlyTrashed()->select('tipoapoyos.Id_tipoapoyo','tipoapoyos.nombretipoapoyo',
        'tipoapoyos.descripciontipoapoyo','tipoapoyos.deleted_at')
        ->get();

        $consulta = tipoapoyos::all();

        return view ('solicitarapoyo_user')
        ->with('consulta',$consulta)
        ->with('consulta2',$consulta2);
    }

//ALTA CON ID DE APOYO DESDE USER


    public function Formulario_solicitud($Id_tipoapoyo){
        
        $sessionid = session('sessionid');
        if($sessionid<>""){


            $consulta= tipoapoyos::select('tipoapoyos.Id_tipoapoyo','tipoapoyos.nombretipoapoyo',
            'tipoapoyos.descripciontipoapoyo', 'tipoapoyos.deleted_at','tipoapoyos.created_at'//,'tipoapoyos.sessionid'
            )
            ->where('Id_tipoapoyo',$Id_tipoapoyo)
            ->get();
            return view('Formulario_solicitud')
            ->with('consulta',$consulta);
        }else{
            Session::flash('mensaje',"loguearse antes de continuar");
            return redirect()->route('login');}
    }


//GUARDAR DATOS
    public function guardarform_Id(Request $request){
        //Guardar Datos en BD

        $solicitudapoyos = new solicitudapoyos;
        //campos de solo lectura (llaves foreaneas)
        $solicitudapoyos -> Id_tipoapoyo = $request-> Id_tipoapoyo ;
        $solicitudapoyos -> Id_estatus = $request-> Id_estatus;
        $solicitudapoyos -> Id_perfilproductor = $request-> Id_perfilproductor ;
        $solicitudapoyos -> save();
        //mensaje flash-alta_USER
        Session::flash('mensaje', "Se ha Enviado tu solicitud solicitud
        corectamente");
        return redirect()->route('perfil_solicitudes');
        }



       





//Perfil Solicitudes
    public function perfil_solicitudes()
    {
        $consulta = solicitudapoyos::withTrashed()->join('tipoapoyos','solicitudapoyos.Id_tipoapoyo','=','tipoapoyos.Id_tipoapoyo')
        ->join('estatuses','solicitudapoyos.Id_estatus','=','estatuses.Id_estatus')
        ->select('solicitudapoyos.Id_solicitudapoyo','solicitudapoyos.Id_tipoapoyo',
        'solicitudapoyos.Id_perfilproductor','tipoapoyos.nombretipoapoyo as nombreapoyo','estatuses.nombre_estatus as nomestatus',
        'solicitudapoyos.deleted_at','solicitudapoyos.created_at')
        ->orderBy('Id_solicitudapoyo', 'DESC')
        ->get();
        return view('Perfil_SolicitudesRealizadas')
        ->with('consulta',$consulta);
        
    }
}
