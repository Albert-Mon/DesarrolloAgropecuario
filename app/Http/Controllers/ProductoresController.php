<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exports\AdminExport;
use App\Imports\AdminImport;
use DataTables;
use PDF;
use App\Models\productores;
use App\Models\localidades;
use Session;

class ProductoresController extends Controller
{
    
    public function index2(){
        return view ('index2');
        }



    public function registro(){
        return view('registro');
    }  

    public function registroProdu(){
        $consulta = productores::orderBy('id_productores','DESC')
                    ->take(1)
                    ->get();
                    //return $consulta;
        $cuantos = count($consulta);
        if($cuantos==0){
            $idsigue = 1;

        }else{
            $idsigue = $consulta[0]->id_productores + 1;
        }

        //$localidades = localidades::orderBy('nombre_localidades', 'ASC')->get();
        return view ('registroProdu')
                //->with('localidades',$localidades)
                ->with('idsigue',$idsigue);
    }

    public function guardarproductor(Request $request){
        $this -> validate($request, [
            'nombre'   => 'required|regex:/^[A-Z, a-z, ][A-Z, a-z, ,á,é,í,ó,ú,ñ]+$/',
            'email'    => 'required|email',
            'pass'     => 'required',
          
        ]);

        $productores = new productores;
        $productores-> id_productores = $request->id_productores;
        $productores-> nombre   = $request->nombre;
        $productores-> email    = $request->email;
        $productores-> pass = Hash::make($request->pass);
        $productores->save();
        //return $localidades;
        Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido dado de alta correctamente");
        return redirect()->route('aplicacion');
    }









    public function reporteProduc(){

        $sessionid = session('sessionid');
        if($sessionid<>""){

        $consulta = productores::withTrashed()
        ->join('localidades','productores.id_localidades','=','localidades.id_localidades')
        ->select('productores.id_productores','productores.nombre','productores.app'
            ,'productores.apm','productores.fecha','productores.sexo','productores.email'
            ,'productores.celular','productores.curp','productores.ine'
            ,'productores.direccion','productores.cp','productores.croquis'
            ,'productores.constanciadomicilio','productores.cargo'
            ,'localidades.nombre_localidades as loca','productores.deleted_at'
            ,'productores.constanciaproductor','productores.nombrerepresentante'
            ,'productores.direccioninstitucion','productores.nombramiento')
        ->orderBy('productores.id_productores')
        ->get();
        return view('reporteProduc')->with('consulta',$consulta);

        }else{
            Session::flash('mensaje',"loguearse antes de continuar");
            return redirect()->route('login2');
        }
    }


    public function desactivaProduc($id_productores){
        $productores = productores::find($id_productores);
        $productores->delete();

         Session::flash('mensajes', "El Usuario ha sido desactivado correctamente");
        return redirect()->route('reporteProduc');
    }

    public function activaProduc($id_productores){

        productores::withTrashed()->where('id_productores',$id_productores)->restore();

         Session::flash('mensajes', "El Usuario ha sido activado correctamente");
        return redirect()->route('reporteProduc');
    }

    public function borraProduc($id_productores){

         $productores = productores::withTrashed()
         ->find($id_productores)->forceDelete();

        Session::flash('mensajes', "El Usuario ha sido eliminado correctamente");
        return redirect()->route('reporteProduc');
    }









    public function perfilProdu($id_productores){
        $consulta = productores::select('productores.id_productores',
            'productores.nombre',
            'productores.email',
            'productores.pass')
        ->where('id_productores',$id_productores)
        ->get();

        $localidades = localidades::orderBy('nombre_localidades', 'ASC')->get();
        return view('perfilProdu')
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
        $curp2 = $request->id_productores . "_CURP_" . $curp;
        \Storage::disk('local')->put($curp2, \File::get($file));

        $file = $request->file('ine');
        $ine = $file->getClientOriginalName();
        $ine2 = $request->id_productores."_INE_".$ine;
        \Storage::disk('local')->put($ine2, \File::get($file));

        $file = $request->file('croquis');
        $croquis = $file->getClientOriginalName();
        $croquis2 = $request->id_productores."_CROQUIS_".$croquis;
        \Storage::disk('local')->put($croquis2, \File::get($file));


        $file = $request->file('constanciadomicilio');
        $constanciadomicilio = $file->getClientOriginalName();
        $constanciadomicilio2 = $request->id_productores."_CONSTANCIADOMICILIARIA_".
        $constanciadomicilio;
        \Storage::disk('local')->put($constanciadomicilio2, \File::get($file));

        $file = $request->file('constanciaproductor');
        if($file<>"")
        {
        $constanciaproductor  = $file->getClientOriginalName();
        $constanciaproductor2 = $request->id_productores."_CONSTANCIAPRODUCTOR_".
        $constanciaproductor;
        \Storage::disk('local')->put($constanciaproductor2, \File::get($file));
        }else{
            $constanciaproductor2 = "sinfoto.jpg";
        }

        $file = $request->file('nombramiento');
        if($file<>"")
        {
        $nombramiento = $file->getClientOriginalName();
        $nombramiento2 = $request->id_productores."_NOMBRAMIENTO_".
        $nombramiento;
        \Storage::disk('local')->put($nombramiento2, \File::get($file));
        }else{
            $nombramiento2 = "sinfoto.jpg";
        }

        $productores = productores::withTrashed()->find($request->id_productores);
        $productores-> id_productores = $request->id_productores;
        $productores-> nombre   = $request->nombre;
        $productores-> app      = $request->app;
        $productores-> apm      = $request->apm;
        $productores-> fecha    = $request->fecha;
        $productores-> sexo     = $request->sexo;
        $productores-> email    = $request->email;
        $productores->pass = Hash::make($request->pass);
        $productores-> celular  = $request->celular;
        $productores-> curp     = $curp2;
        $productores-> ine      = $ine2;
        $productores-> direccion=$request->direccion;
        $productores-> cp       = $request->cp;
        $productores-> croquis  = $croquis2;
        $productores-> constanciadomicilio  = $constanciadomicilio2;
        $productores-> id_localidades       = $request->id_localidades;
        $productores-> constanciaproductor  = $constanciaproductor2;
        $productores-> nombrerepresentante  = $request->nombrerepresentante;
        $productores-> direccioninstitucion = $request->direccioninstitucion;
        $productores-> nombramiento         = $nombramiento2;
        $productores-> cargo    = $request->cargo;
        $productores->save();
        //return $localidades;
        Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido dado de alta correctamente");
        return redirect()->route('reporteProduc');

    }










    public function modificaProduc($id_productores){
        $consulta = productores::withTrashed()
        ->join('localidades','productores.id_localidades','=','localidades.id_localidades')
        ->select('productores.id_productores','productores.nombre','productores.app'
            ,'productores.apm','productores.fecha','productores.sexo','productores.email'
            ,'productores.pass'
            ,'productores.celular','productores.curp' ,'productores.ine'
            ,'productores.direccion','productores.cp','productores.croquis'
            ,'productores.constanciadomicilio','productores.cargo'
            ,'localidades.nombre_localidades as loca','localidades.id_localidades'
            ,'productores.constanciaproductor','productores.nombrerepresentante'
            ,'productores.direccioninstitucion','productores.nombramiento')
        ->where('id_productores',$id_productores)
        ->get();
        $localidades = localidades::all();
        return view('modificaProduc')
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
        $curp2 = $request->id_productores."_CURP_".$curp;
        \Storage::disk('local')->put($curp2, \File::get($file));
        }

        $file = $request->file('ine');
        if($file<>""){
        $ine = $file->getClientOriginalName();
        $ine2 = $request->id_productores."_INE_".$ine;
        \Storage::disk('local')->put($ine2, \File::get($file));
        }

        $file = $request->file('croquis');
        if($file<>""){ 
        $croquis = $file->getClientOriginalName();
        $croquis2 = $request->id_productores."_CROQUIS_".$croquis;
        \Storage::disk('local')->put($croquis2, \File::get($file));
        }

        $file = $request->file('constanciadomicilio');
        if($file<>""){
        $constanciadomicilio = $file->getClientOriginalName();
        $constanciadomicilio2 = $request->id_productores."_CONSTANCIADOMICILIARIA_"
        .$constanciadomicilio;
        \Storage::disk('local')->put($constanciadomicilio2, \File::get($file)); 
        }

        $file = $request->file('constanciaproductor');
        if($file<>"")
        {
        $constanciaproductor  = $file->getClientOriginalName();
        $constanciaproductor2 = $request->id_productores."_CONSTANCIAPRODUCTOR_".
        $constanciaproductor;
        \Storage::disk('local')->put($constanciaproductor2, \File::get($file));
        }else{
            $constanciaproductor2 = "sinfoto.jpg";
        }

        $file = $request->file('nombramiento');
        if($file<>"")
        {
        $nombramiento = $file->getClientOriginalName();
        $nombramiento2 = $request->id_productores."_NOMBRAMIENTO_".
        $nombramiento;
        \Storage::disk('local')->put($nombramiento2, \File::get($file));
        }else{
            $nombramiento2 = "sinfoto.jpg";
        }
        
        $productores = productores::withTrashed()->find($request->id_productores);
        $productores-> id_productores = $request->id_productores;
        $productores-> nombre   = $request->nombre;
        $productores-> app      = $request->app;
        $productores-> apm      = $request->apm;
        $productores-> fecha    = $request->fecha;
        $productores-> sexo     = $request->sexo;
        $productores-> email    = $request->email;
        $productores->pass = Hash::make($request->pass);
        $productores-> celular  = $request->celular;

        if($file<>"")
        {
        $productores-> curp     = $curp2;
        }

        if($file<>"")
        {
        $productores-> ine      = $ine2;
        }

        if($file<>"")
        {
        $productores-> croquis  = $croquis2;
        }

        if($file<>"")
        {
        $productores-> constanciadomicilio  = $constanciadomicilio2;
        }

        if($file<>"")
        {
        $productores-> constanciaproductor  = $constanciaproductor2;
        }

        if($file<>"")
        {
        $productores-> nombramiento  = $nombramiento2;
        }

        $productores-> direccion= $request->direccion;
        $productores-> cp       = $request->cp;
        $productores-> id_localidades   = $request->id_localidades;
        $productores-> cargo    = $request->cargo;
        $productores-> nombrerepresentante = $request->nombrerepresentante;
        $productores-> direccioninstitucion = $request->direccioninstitucion;
        
        $productores->save();
        
       Session::flash('mensajes', "El Usuario $request->nombre
            $request->app $request->apm ha sido modificado correctamente");
        return redirect()->route('reporteProduc');
    }

    public function getPdfProduc(){
        $pdfproduc = productores::all();
        $pdf = PDF::loadView('pdfproduc', compact('pdfproduc'));
        return $pdf->download('pdf_usuarios.pdf');
    }
}
