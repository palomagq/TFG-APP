<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class GimnasioController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','Gimnasios');

        $request->user()->authorizeRoles(['admin']);
         
        return view('admin.listargimnasios');
     }
 
     public function selectdatagimnasio(Request $request){
 
         $users = DB::select('select * from gimnasio');
 
         $data = array(
             'data' => $users
             
         );
 
         echo json_encode($data);
 
         //$insert="insert into tabla (id,a) values('".$request->id."','".$a."')";
     }
 
     public function insertdatagimnasio(Request $request){
         //debug de lo que viene en el formulario
         //dd($request->all());
 
         try { 
             DB::insert('insert into gimnasio (nombre, direccion, localidad, provincia, codigo_postal) 
             values (?,?,?,?,?) ' ,[$request->nombre,$request->direccion,$request->localidad,$request->provincia,$request->codigo_postal]);
 
         } catch(\Illuminate\Database\QueryException $ex){ 
            
             //return $ex->getMessage();
             return ["code"=>500, "msg"=>"Se ha producido un error al crear el gimnasio"];//500;
             //return back();
         }
         
         //Session::flash('success','Se ha introducido el ususario correctamente');//sweetalert js
         return ["code"=>200, "msg"=>"Se ha introducido el gimnasio correctamente"];//200;
         //return view('admin.listarsocios');
     }
 
     public function deletedatagimnasio(Request $request){
 
 
         try { 
             DB::delete('delete from gimnasio where id='.$request->id);
         } catch(\Illuminate\Database\QueryException $ex){ 
            
             return ["code"=>500, "msg"=>"Se ha producido un error al borrar el gimnasio"];//500;
             //te devuelve a la pagina anterior y ya se mostraria el msg
         }
         return ["code"=>200, "msg"=>"Se ha borrado el gimnasio correctamente"];//200;
 
         //Session::flash('success','Se ha borrado el usuario correctamente');//sweetalert js
         //return 200;
 
     }
 
      public function getEditarDatagimnasio(Request $request){
         $userData = DB::select('select * from gimnasio where gimnasio_id='.$request->id);
         //DB::find($request->id);
         return json_encode($userData);
         //return view('admin.listarsocios',compact('userData','id'));
     }
 
     public function updatedatagimnasio(Request $request)
     {
         //
         //$userData->save();
         //DB::update('update users set nombe = '.$request->nombre.' where id = ?', [$request->id]);
         try {
             DB::update('update gimnasio set nombre = ? where gimnasio_id = ?', [$request->nombre,$request->id]);
             DB::update('update gimnasio set direccion = ? where gimnasio_id = ?', [$request->direccion,$request->id]);
             DB::update('update gimnasio set localidad = ? where gimnasio_id = ?', [$request->localidad,$request->id]);
             DB::update('update gimnasio set provincia = ? where gimnasio_id = ?', [$request->provincia,$request->id]);
             DB::update('update gimnasio set codigo_postal = ? where gimnasio_id = ?', [$request->codigo_postal,$request->id]);

             //$results = DB::update( DB::raw("update usuarios set nombre='jaja' WHERE id = ".$request->id) );
 
             
         }catch(\Illuminate\Database\QueryException $ex){ 
                 //dd($ex->getMessage()); //debug del msg de error
                 //deberias enviar un msg de error en el caso, flash dura un request, osea solo tiene como vida la sigueite redireccion
                 //session::put() tiene como vida hasta que se acabe el inicio de sesion. La sessiones estas son como variables globales para
                 //compartir datos entre diferentes vistas y controladores en su llamada
                 //las recuperamos con session::get()
                 //session::forget() elimina de la cache esa variable
                 //Session::flash('error','Se ha producido un error al modificar el usuario');//sweetalert js
     
                 //te devuelve a la pagina anterior y ya se mostraria el msg
     
                 return $ex->getMessage();
                 //return 500;
                 return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el gimnasio"];//500;
 
             }
     
         //Session::flash('success','Se ha modificado el usuario correctamente');//sweetalert js
         //return 200;
         return ["code"=>200, "msg"=>"Se ha actualizado el gimnasio correctamente"];//200;
 
         //return json_encode(array('statusCode'=>200));
       
     }
}
