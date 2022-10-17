<?php

use Illuminate\Support\Facades\Route;

//Se mandan a llamar a los controladores para poder usarlos
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TipoApoyoController;
use App\Http\Controllers\SolicitudApoyoController;
use App\Http\Controllers\TipoCapacitacionController;
use App\Http\Controllers\SolicitudCapacitacionController;




//Esto manda a llamar a nuestro contolador y busca el metodo llamado mensaje
Route::get('/', function () {
    return view('welcome');
});
/*---En la primera referencia es cómo lo vamos a mandar a llamar en nuestro navegador como controlpago o mensaje...
El segundo es el metodo cómo aparece en nuestro controlador que es mensaje o pago, pero es recomendable que se llamen igual*/


//-----------------------------------OTRAS VISTAS-----------------------------
route::get('index', [UsersController::class,'index'])->name('index');
route::get('index2', [UsersController::class,'index2'])->name('index2');
route::get('aplicacion', [LoginController::class,'aplicacion'])->name('aplicacion');


//----------------------------------LOGIN DE PRODUCTORES---------------------------
route::get('login', [LoginController::class,'login'])->name('login');
route::post('validar', [LoginController::class,'validar'])->name('validar');



//----------------------------------LOGIN DE ADMINS---------------------------
route::get('login2', [LoginController::class,'login2'])->name('login2');
route::post('validar2', [LoginController::class,'validar2'])->name('validar2');



route::get('cerrar', [LoginController::class,'cerrar'])->name('cerrar');



//..................................USERS------------------------------------------------------------------
route::get('Pregfrec',[UsersController::class,'Pregfrec'])->name('Pregfrec');
route::get('registro_user',[UsersController::class,'registro_user'])->name('registro_user');
route::post('guardaruser',[UsersController::class,'guardaruser'])->name('guardaruser');
route::get('perfil_user/{id_users}',[UsersController::class,'perfil_user'])->name('perfil_user');
//route::get('perfil_user/{id_users}',[UsersController::class,'perfil_user'])->name('perfil_user')
route::post('guardarPerfil',[UsersController::class,'guardarPerfil'])->name('guardarPerfil');
//route::get('altaProdu',[UsersController::class,'altaProdu'])->name('altaProdu');
route::get('reporte_user',[UsersController::class,'reporte_user'])->name('reporte_user');
route::get('desactivauser/{id_users}',[UsersController::class,'desactivauser'])->name('desactivauser');
route::get('activausers/{id_users}',[UsersController::class,'activausers'])->name('activausers');
route::get('borrauser/{id_users}',[UsersController::class,'borrauser'])->name('borrauser');
route::get('modifica_user/{id_users}',[UsersController::class,'modifica_user'])->name('modifica_user');
route::post('guardarcambios',[UsersController::class,'guardarcambios'])->name('guardarcambios');

//---------------------Ruta para mandar a llamar la creacion del pdf-----------------------------------------------------
Route::get('pdfproduc',[UsersController::class,'getPdfProduc'])->name('pdfproduc');


//---------------------------------------ADMIN----------------------------------------------------------------------------
route::get('perfilAdmin',[AdminController::class,'perfilAdmin'])->name('perfilAdmin');
//ruta de la vista para hacer alta de admin
route::get('altaAdmin',[AdminController::class,'altaAdmin'])->name('altaAdmin');
//Ruta para que en la vista de alta de admin se guarde en la bd
route::post('guardaradmin',[AdminController::class,'guardaradmin'])->name('guardaradmin');
//Ruta para ver todos los admin registrados desde la bd 
route::get('reporteAdmin',[AdminController::class,'reporteAdmin'])->name('reporteAdmin');
//Ruta para desactivar a un usuario
route::get('desactivaAdmin/{id_administradores}',[AdminController::class,'desactivaAdmin'])->name('desactivaAdmin');
//Ruta para activar a un usuario
route::get('activaAdmin/{id_administradores}',[AdminController::class,'activaAdmin'])->name('activaAdmin');
//Ruta para eliminar al administrador
route::get('borraAdmin/{id_administradores}',[AdminController::class,'borraAdmin'])->name('borraAdmin');
//Ruta para la vista de modificacion del administrador
route::get('modificaAdmin/{id_administradores}',[AdminController::class,'modificaAdmin'])->name('modificaAdmin');
//Ruta para guardar los cambios y modificaciones
route::post('guardacambios',[AdminController::class,'guardacambios'])->name('guardacambios');
//Ruta para mandar a llamar la creacion del pdf
Route::get('pdfadmin',[AdminController::class,'getPdfAdmin'])->name('pdfadmin');
//ruta para guardar a la base de datos
route::get('eloquent',[AdminController::class,'eloquent'])->name('eloquent');








/*vista index*/
route::get('index', [TipoApoyoController::class,'index'])->name('index');
//VISTAS DEL CONTROLADOR TIPOAPOYO
/*vista index*/
route::get('Altatipoapoyo', [TipoApoyoController::class,'Altatipoapoyo'])->name('Altatipoapoyo');
//conexion al modelo para aguardar informacion
route::post('guardartipoapoyo', [TipoApoyoController::class,'guardartipoapoyo'])->name('guardartipoapoyo');
//prueba de conexion a bd 
route::get('modelo', [TipoApoyoController::class,'modelo'])->name('modelo');
route::get('reportetipoapoyo', [TipoApoyoController::class,'reportetipoapoyo'])->name('reportetipoapoyo');

//Ver Detalles de Apoyo_Admin
route::get('verapoyoadmin/{Id_tipoapoyo}', [TipoApoyoController::class,'verapoyoadmin'])->name('verapoyoadmin');
//Ver Detalles de Apoyo_User
route::get('verapoyouser/{Id_tipoapoyo}', [TipoApoyoController::class,'verapoyouser'])->name('verapoyouser');

//Desactivar/Activar/ELIMINAR Apoyo
route::get('desactivartipoapoyo/{Id_tipoapoyo}', [TipoApoyoController::class,'desactivartipoapoyo'])->name('desactivartipoapoyo');
route::get('activartipoapoyo/{Id_tipoapoyo}', [TipoApoyoController::class,'activartipoapoyo'])->name('activartipoapoyo');
route::get('eliminartipoapoyo/{Id_tipoapoyo}', [TipoApoyoController::class,'eliminartipoapoyo'])->name('eliminartipoapoyo');
//MODIFICAR
route::get('modificacion_tipoapoyos/{Id_tipoapoyo}', [TipoApoyoController::class,'modificacion_tipoapoyos'])->name('modificacion_tipoapoyos');
route::post('guardarcambiostipoapoyo', [TipoApoyoController::class,'guardarcambiostipoapoyo'])->name('guardarcambiostipoapoyo');





//------------------------------------------SOLICITUD APOYO------------------------------------------------------------------------------------------------
route::get('modelo2', [SolicitudApoyoController::class,'modelo2'])->name('modelo2');
route::post('guardarsolicitudapoyo', [SolicitudApoyoController::class,'guardarsolicitudapoyo'])->name('guardarsolicitudapoyo');
route::get('Altasolicitudapoyo', [SolicitudApoyoController::class,'Altasolicitudapoyo'])->name('Altasolicitudapoyo');
route::get('reportesolicitudapoyo', [SolicitudApoyoController::class,'reportesolicitudapoyo'])->name('reportesolicitudapoyo');
//Desactivar/Activar/ELIMINAR Apoyo
route::get('desactivarsolicitudapoyo/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'desactivarsolicitudapoyo'])->name('desactivarsolicitudapoyo');
route::get('activarsolicitudapoyo/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'activarsolicitudapoyo'])->name('activarsolicitudapoyo');
route::get('eliminarsolicitudapoyo/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'eliminarsolicitudapoyo'])->name('eliminarsolicitudapoyo');
//CANCELAR desde Perfil de solicitudes de usuario
route::get('cancelarsolicitudapoyo/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'cancelarsolicitudapoyo'])->name('cancelarsolicitudapoyo');







//---------------------------------------------SOLICITUD_ADMIN------------------------------------------------------------------
route::get('detallesolicitud_admin/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'detallesolicitud_admin'])->name('detallesolicitud_admin');
route::get('solicitarapoyo_user', [SolicitudApoyoController::class,'solicitarapoyo_user'])->name('solicitarapoyo_user');


//Alta desde User con id de Apoyos
route::get('Formulario_solicitud/{Id_tipoapoyo}', [SolicitudApoyoController::class,'Formulario_solicitud'])->name('Formulario_solicitud');
//Guardar
route::post('guardarform_Id', [SolicitudApoyoController::class,'guardarform_Id'])->name('guardarform_Id');
//VER  PERFIL DE SOLICITUDES
route::get('perfil_solicitudes', [SolicitudApoyoController::class,'perfil_solicitudes'])->name('perfil_solicitudes');
route::get('detallesolicitud_user/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'detallesolicitud_user'])->name('detallesolicitud_user');

//MODIFICAR
route::get('modificacion_solicitudapoyo/{Id_solicitudapoyo}', [SolicitudApoyoController::class,'modificacion_solicitudapoyo'])->name('modificacion_solicitudapoyo');
route::post('guardarcambiossolicitudapoyo', [SolicitudApoyoController::class,'guardarcambiossolicitudapoyo'])->name('guardarcambiossolicitudapoyo');




//---------------------------------------------- TIPO CAPACITACIONES----------------------------------------------------------------------------------
route::get('Altatipocapacitacion', [TipoCapacitacionController::class,'Altatipocapacitacion'])->name('Altatipocapacitacion');
route::post('guardartipocapacitacion', [TipoCapacitacionController::class,'guardartipocapacitacion'])->name('guardartipocapacitacion');
//reporte de capacitaciones_admin
route::get('reportetipocapacitacion', [TipoCapacitacionController::class,'reportetipocapacitacion'])->name('reportetipocapacitacion');
//desactivar/activar/eliminar
route::get('desactivartipocapacitacion/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'desactivartipocapacitacion'])->name('desactivartipocapacitacion');
route::get('activartipocapacitacion/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'activartipocapacitacion'])->name('activartipocapacitacion');
route::get('eliminartipocapacitacion/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'eliminartipocapacitacion'])->name('eliminartipocapacitacion');
//vistas de detalles de apoyo admin/user
route::get('vercapacitacionadmin/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'vercapacitacionadmin'])->name('vercapacitacionadmin');
route::get('vercapacitacionuser/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'vercapacitacionuser'])->name('vercapacitacionuser');
//Vista para solicitar Capacitacion
route::get('solicitarcapacitacion_user', [TipoCapacitacionController::class,'solicitarcapacitacion_user'])->name('solicitarcapacitacion_user');
//MODIFICAR
route::get('modificacion_tipocapacitacion/{Id_tipocapacitacion}', [TipoCapacitacionController::class,'modificacion_tipocapacitacion'])->name('modificacion_tipocapacitacion');
route::post('guardarcambiostipocapacitacion', [TipoCapacitacionController::class,'guardarcambiostipocapacitacion'])->name('guardarcambiostipocapacitacion');





//-------------------------------------------SOLICITUD CAPACITACION-----------------------------------------------------------------------------------------------------------------------------------------------
route::get('Altasolicitudcapacitacion', [SolicitudCapacitacionController::class,'Altasolicitudcapacitacion'])->name('Altasolicitudcapacitacion');
route::post('guardarsolicitudcapacitacion', [SolicitudCapacitacionController::class,'guardarsolicitudcapacitacion'])->name('guardarsolicitudcapacitacion');
//reporte de solicitudes capacitaciones_admin
route::get('reportesolicitudcapacitacion', [SolicitudCapacitacionController::class,'reportesolicitudcapacitacion'])->name('reportesolicitudcapacitacion');
//desactivar/activar/eliminar
route::get('desactivarsolicitudcapacitacion/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'desactivarsolicitudcapacitacion'])->name('desactivarsolicitudcapacitacion');
route::get('activarsolicitudcapacitacion/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'activarsolicitudcapacitacion'])->name('activarsolicitudcapacitacion');
route::get('eliminarsolicitudcapacitacion/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'eliminarsolicitudcapacitacion'])->name('eliminarsolicitudcapacitacion');
//vistas de detalles de la capacitacionadmin/user
route::get('detallecapacitacionadmin/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'detallecapacitacionadmin'])->name('detallecapacitacionadmin');
route::get('detallecapacitacionuser/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'detallecapacitacionuser'])->name('detallecapacitacionuser');
//FORMULARIO DE CAPACITACIONES DESDE USER
route::post('guardarform_Idcapacitacion', [SolicitudCapacitacionController::class,'guardarform_Idcapacitacion'])->name('guardarform_Idcapacitacion');
route::get('Formulario_solicitudcapacitacion/{Id_tipocapacitacion}', [SolicitudCapacitacionController::class,'Formulario_solicitudcapacitacion'])->name('Formulario_solicitudcapacitacion');
//PERFIL DE USUARIO CAPACITACIONES REALIZADAS
route::get('perfil_solicitudescapacitacion', [SolicitudCapacitacionController::class,'perfil_solicitudescapacitacion'])->name('perfil_solicitudescapacitacion');
//CANCELAR desde Perfil de solicitudes de usuario
route::get('cancelarsolicitudcapacitacion/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'cancelarsolicitudcapacitacion'])->name('cancelarsolicitudcapacitacion');
//MODIFICAR  
route::get('modificacion_solicitudcapacitacion/{Id_solicitudcapacitacion}', [SolicitudCapacitacionController::class,'modificacion_solicitudcapacitacion'])->name('modificacion_solicitudcapacitacion');
route::post('guardarcambioscapacitacion', [SolicitudCapacitacionController::class,'guardarcambioscapacitacion'])->name('guardarcambioscapacitacion');
