<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\users;
use Session;

class LoginController extends Controller
{

    //---------------------------------------LOGIN USUARIO--------------------------------

    public function cerrar(){
        Session::forget('sessionname');
        Session::forget('sessionidp');
        Session::flush();
 
        Session::flash('mensaje', "SesionCerrada");
             return redirect()->route('login');
     
     }
 
     public function login(){
     return view ('login');
     }

     public function aplicacion(){
        return view ('aplicacion');
        }
 
     public function validar(Request $request){

         $this->validate($request,[
             'email' => 'required',
             'pass'=>'required',
         ]);
         
        $consulta2  = users::where('email', $request->email)
        ->get();
         
        /* $consulta = productores::where('email','=',$email)
                              |  ->where('pass','=',$pass)
                                      ->get();*/
 
                                      $cuantos= count($consulta2);
                                      if($cuantos==1 and Hash::check($request->pass,$consulta2[0]->pass))
                                      {
                                        Session::put('sessionname',$consulta2[0]->nombre);
                                        Session::put('sessionid',$consulta2[0]->id_users);
                                        Session::put('sessiontipo',$consulta2[0]->tipo_user);

                                          return redirect()->route('solicitarcapacitacion_user');

                                      }
                                      else{
                                        Session::flash('mensaje',"El Correo o Contraseña no son validos");
                                        return redirect()->route('login');
                                      }

        }


        


/*



        $data = User::find($id);
if( ! Hash::check( $data->password , Input::get('currPassword') ) )
{
    return Redirect::to('/admin/profile')
        ->with('message', 'Current Password Error !')
        ->withInput();
}

        $consulta = usuarios::where('mail', $request->mail)
        ->where('activo','Si')
        ->get();
        $cuantos= count($consulta);
        if($cuantos==1 and Hash::check($request->pass,$consulta[0]->pass))
        {
            echo "acceso concedido";
        }
        else{
           echo "accceso denegado";
        }
        



       
        $passwordEncriptado = Hash::make($request->pass);
        echo $passwordEncriptado;
        

        
        $consulta = usuarios::where('mail', $request->mail)
        ->where('activo','SI')
        ->get();
        $cuantos= count($consulta);
        if($cuantos==1 and Hash::check($request->pass,$consulta[0]->pass))
        {
            Session::put('sessionusuario',$consulta[0]->name);
            Session::put('sessiontipo',$consulta[0]->tipo);
            Session::put('sessionidsc',$consulta[0]->idsc);
            return redirect()->route('principal');
        }
        else{
            Session::flash('mensje',"El usuario o password no son validos");
            return redirect()->route('login');
        }
        
        }
        
        
        
        
        
        
        
        
        
         if (count($consulta)==0 )

         {
            Session::flash('mensaje', "El Correo o Contraseña no son validos");
            return redirect()->route('login');

         }
        else{
         Session::put('sessionproduc', $consulta[0]->nombre);
         Session::put('sessionidproduc', $consulta[0]->idproduc);
         Session::put('sessiontipo', $consulta[0]->tipo);
        return redirect()->route('reporteProduc');
        */
    
}
