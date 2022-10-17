<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\AdminExport;
use App\Imports\AdminImport;
use DataTables;
use PDF;
use App\Models\users;
use App\Models\localidades;
use Session;

class UsersController extends Controller
{
    
    
    public function Pregfrec(){
        return view('Pregfrec');
    }  


    public function registro(){
        return view('registro');
    }  

    public function registro_user(){
        $consulta = users::orderBy('id_users','DESC')
                    ->take(1)
                    ->get();
                    //return $consulta;
        $cuantos = count($consulta);
        if($cuantos==0){
            $idsigue = 1;

        }else{
            $idsigue = $consulta[0]->id_users + 1;
        }

        //$localidades = localidades::orderBy('nombre_localidades', 'ASC')->get();
        return view ('registro_user')
                //->with('localidades',$localidades)
                ->with('idsigue',$idsigue);
    }

    public function guardaruser(Request $request){
        $this -> validate($request, [
            'nombre'   => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
            'email'    => 'required|email',
            'pass'     => 'required',
          
        ]);

        $users = new users;
        $users-> id_users = $request->id_users;
        $users-> nombre   = $request->nombre;
        $users-> email    = $request->email;
        $users-> pass = Hash::make($request->pass);
        $users-> tipo_user = "user";
        $users->save();
        //return $localidades;
        Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido dado de alta correctamente");
        return redirect()->route('aplicacion');
    }




    





    public function reporte_user(){

        $sessionid = session('sessionid');
        if($sessionid<>""){

        $consulta = users::withTrashed()
        ->select('users.id_users'
            ,'users.nombre'
            ,'users.email'
            ,'users.direccion'
            ,'users.deleted_at')
        ->orderBy('users.id_users')
        ->get();
        return view('reporte_user')->with('consulta',$consulta);

        }else{
           Session::flash('mensaje',"loguearse antes de continuar");
           return redirect()->route('login');}
    }


    public function desactivauser($id_users){
        $users = users::find($id_users);
        $users->delete();

         Session::flash('mensajes', "El Usuario ha sido desactivado correctamente");
        return redirect()->route('reporte_user');
    }

    public function activausers($id_users){

        users::withTrashed()->where('id_users',$id_users)->restore();

         Session::flash('mensajes', "El Usuario ha sido activado correctamente");
        return redirect()->route('reporte_user');
    }

    public function borrauser($id_users){

         $users = users::withTrashed()
         ->find($id_users)->forceDelete();

        Session::flash('mensajes', "El Usuario ha sido eliminado correctamente");
        return redirect()->route('reporte_user');
    }



    public function perfil_user($id_users){
        $sessionid = session('sessionid');
        $consulta = users::select('users.id_users',//'=','sessionidp',
            'users.nombre',
            'users.email',
            'users.pass')
        //->where('id_users',$id_users)
        ->where('id_users',$sessionid)
        ->get();

        $localidades = localidades::orderBy('nombre_localidades', 'ASC')->get();
        return view('perfil_user')
        ->with('localidades',$localidades)
        ->with('consulta',$consulta[0]);
        }



    public function guardarPerfil(Request $request){

      $this -> validate($request, [
        'nombre'   => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'app'      => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'apm'      => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'fecha'    => 'required|date',
        'sexo'     => 'required',
        'email'    => 'required|email',
        'pass'     => 'required', 
        'celular'  => 'required|regex:/^[0-9]{10}$/',
        'curp'     => 'mimes:pdf,jpeg,png,jpg,PDF',
        'ine'      => 'mimes:pdf,jpeg,png,jpg,PDF',
        'direccion'=> 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'cp'       => 'required|regex:/^[0-9]{5}$/',
        'croquis'  => 'mimes:pdf,jpeg,png,jpg,PDF',
        'constanciadomicilio'=>'mimes:pdf,jpeg,png,jpg,PDF',
        'id_localidades'=>'required',
        'constanciaproductor' =>'mimes:pdf,jpg,png,jpeg',
        'nombrerepresentante' =>'nullable|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'direccioninstitucion'=>'nullable|regex:/^[A-Z, a-z, ,0-9][A-Z, a-z, ,á,é,í,ó,ú,ñ, 0-9]+$/',
        'nombramiento'        =>'mimes:pdf,jpg,png,jpeg',
        'cargo'    => 'nullable|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',

      ]);

      $file = $request->file('curp');
        $curp = $file->getClientOriginalName();
        $curp2 = $request->id_users . "_CURP_" . $curp;
        \Storage::disk('local')->put($curp2, \File::get($file));

        $file = $request->file('ine');
        $ine = $file->getClientOriginalName();
        $ine2 = $request->id_users."_INE_".$ine;
        \Storage::disk('local')->put($ine2, \File::get($file));

        $file = $request->file('croquis');
        $croquis = $file->getClientOriginalName();
        $croquis2 = $request->id_users."_CROQUIS_".$croquis;
        \Storage::disk('local')->put($croquis2, \File::get($file));


        $file = $request->file('constanciadomicilio');
        $constanciadomicilio = $file->getClientOriginalName();
        $constanciadomicilio2 = $request->id_users."_CONSTANCIADOMICILIARIA_".
        $constanciadomicilio;
        \Storage::disk('local')->put($constanciadomicilio2, \File::get($file));

        $file = $request->file('constanciaproductor');
        if($file<>"")
        {
        $constanciaproductor  = $file->getClientOriginalName();
        $constanciaproductor2 = $request->id_users."_CONSTANCIAPRODUCTOR_".
        $constanciaproductor;
        \Storage::disk('local')->put($constanciaproductor2, \File::get($file));
        }else{
            $constanciaproductor2 = "sinfoto.jpg";
        }

        $file = $request->file('nombramiento');
        if($file<>"")
        {
        $nombramiento = $file->getClientOriginalName();
        $nombramiento2 = $request->id_users."_NOMBRAMIENTO_".
        $nombramiento;
        \Storage::disk('local')->put($nombramiento2, \File::get($file));
        }else{
            $nombramiento2 = "sinfoto.jpg";
        }

        $users = users::withTrashed()->find($request->id_users);
        $users-> id_users = $request->id_users;
        $users-> nombre   = $request->nombre;
        $users-> app      = $request->app;
        $users-> apm      = $request->apm;
        $users-> fecha    = $request->fecha;
        $users-> sexo     = $request->sexo;
        $users-> email    = $request->email;
        $users-> pass = Hash::make($request->pass);
        $users-> celular  = $request->celular;
        $users-> curp     = $curp2;
        $users-> ine      = $ine2;
        $users-> direccion=$request->direccion;
        $users-> cp       = $request->cp;
        $users-> croquis  = $croquis2;
        $users-> constanciadomicilio  = $constanciadomicilio2;
        $users-> id_localidades       = $request->id_localidades;
        $users-> constanciaproductor  = $constanciaproductor2;
        $users-> nombrerepresentante  = $request->nombrerepresentante;
        $users-> direccioninstitucion = $request->direccioninstitucion;
        $users-> nombramiento         = $nombramiento2;
        $users-> cargo    = $request->cargo;
        $users->save();
        //return $localidades;
        Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido dado de alta correctamente");
        return redirect()->route('reporte_user');

    }










    public function modifica_user($id_users){
        $consulta = users::withTrashed()
        ->join('localidades','users.id_localidades','=','localidades.id_localidades')
        ->select('users.id_users','users.nombre','users.app'
            ,'users.apm','users.fecha','users.sexo','users.email'
            ,'users.pass'
            ,'users.celular','users.curp' ,'users.ine'
            ,'users.direccion','users.cp','users.croquis'
            ,'users.constanciadomicilio','users.cargo'
            ,'localidades.nombre_localidades as loca','localidades.id_localidades'
            ,'users.constanciaproductor','users.nombrerepresentante'
            ,'users.direccioninstitucion','users.nombramiento')
        ->where('id_users',$id_users)
        ->get();
        $localidades = localidades::all();
        return view('modifica_user')
        ->with('consulta',$consulta[0])
        ->with('localidades',$localidades);
    }

    public function guardarcambios(Request $request){

      $this -> validate($request, [
        'nombre'   => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'app'      => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'apm'      => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'fecha'    => 'required|date',
        'sexo'     => 'required',
        'email'    => 'required|email',
        'pass'     => 'required', 
        'celular'  => 'required|regex:/^[0-9]{10}$/',
        'curp'     => 'mimes:pdf,jpeg,png,jpg,PDF',
        'ine'      => 'mimes:pdf,jpeg,png,jpg,PDF',
        'direccion'=> 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'cp'       => 'required|regex:/^[0-9]{5}$/',
        'croquis'  => 'mimes:pdf,jpeg,png,jpg,PDF',
        'constanciadomicilio'=>'mimes:pdf,jpeg,png,jpg,PDF',
        'id_localidades'=>'required',
        'constanciaproductor' =>'mimes:pdf,jpg,png,jpeg',
        'nombrerepresentante' =>'nullable|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
        'direccioninstitucion'=>'nullable|regex:/^[A-Z, a-z, ,0-9][A-Z, a-z, ,á,é,í,ó,ú,ñ, 0-9]+$/',
        'nombramiento'        =>'mimes:pdf,jpg,png,jpeg',
        'cargo'    => 'nullable|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',

      ]);

        $file = $request->file('curp');
        if($file<>"")
        {
        $curp = $file->getClientOriginalName();
        $curp2 = $request->id_users."_CURP_".$curp;
        \Storage::disk('local')->put($curp2, \File::get($file));
        }

        $file = $request->file('ine');
        if($file<>""){
        $ine = $file->getClientOriginalName();
        $ine2 = $request->id_users."_INE_".$ine;
        \Storage::disk('local')->put($ine2, \File::get($file));
        }

        $file = $request->file('croquis');
        if($file<>""){ 
        $croquis = $file->getClientOriginalName();
        $croquis2 = $request->id_users."_CROQUIS_".$croquis;
        \Storage::disk('local')->put($croquis2, \File::get($file));
        }

        $file = $request->file('constanciadomicilio');
        if($file<>""){
        $constanciadomicilio = $file->getClientOriginalName();
        $constanciadomicilio2 = $request->id_users."_CONSTANCIADOMICILIARIA_"
        .$constanciadomicilio;
        \Storage::disk('local')->put($constanciadomicilio2, \File::get($file)); 
        }

        $file = $request->file('constanciaproductor');
        if($file<>"")
        {
        $constanciaproductor  = $file->getClientOriginalName();
        $constanciaproductor2 = $request->id_users."_CONSTANCIAPRODUCTOR_".
        $constanciaproductor;
        \Storage::disk('local')->put($constanciaproductor2, \File::get($file));
        }else{
            $constanciaproductor2 = "sinfoto.jpg";
        }

        $file = $request->file('nombramiento');
        if($file<>"")
        {
        $nombramiento = $file->getClientOriginalName();
        $nombramiento2 = $request->id_users."_NOMBRAMIENTO_".
        $nombramiento;
        \Storage::disk('local')->put($nombramiento2, \File::get($file));
        }else{
            $nombramiento2 = "sinfoto.jpg";
        }
        
        $users = users::withTrashed()->find($request->id_users);
        $users-> id_users = $request->id_users;
        $users-> nombre   = $request->nombre;
        $users-> app      = $request->app;
        $users-> apm      = $request->apm;
        $users-> fecha    = $request->fecha;
        $users-> sexo     = $request->sexo;
        $users-> email    = $request->email;
        $users->pass = Hash::make($request->pass);
        $users-> celular  = $request->celular;

        if($file<>"")
        {
        $users-> curp     = $curp2;
        }

        if($file<>"")
        {
        $users-> ine      = $ine2;
        }

        if($file<>"")
        {
        $users-> croquis  = $croquis2;
        }

        if($file<>"")
        {
        $users-> constanciadomicilio  = $constanciadomicilio2;
        }

        if($file<>"")
        {
        $users-> constanciaproductor  = $constanciaproductor2;
        }

        if($file<>"")
        {
        $users-> nombramiento  = $nombramiento2;
        }

        $users-> direccion= $request->direccion;
        $users-> cp       = $request->cp;
        $users-> id_localidades   = $request->id_localidades;
        $users-> cargo    = $request->cargo;
        $users-> nombrerepresentante = $request->nombrerepresentante;
        $users-> direccioninstitucion = $request->direccioninstitucion;
        
        $users->save();
        
       Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido modificado correctamente");
        return redirect()->route('reporte_user');
    }

    public function getPdfProduc(){
        $pdfproduc = users::all();
        $pdf = PDF::loadView('pdfproduc', compact('pdfproduc'));
        return $pdf->download('pdf_usuarios.pdf');
    }
}
