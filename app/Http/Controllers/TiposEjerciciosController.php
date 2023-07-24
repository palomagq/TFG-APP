<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;



class TiposEjerciciosController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','TipoEjercicios');

        $request->user()->authorizeRoles(['admin','personal','socio']);
        //$gimnasios = DB::select('select * from gimnasio');
        
        return view('admin.listartipoejercicios');
     }

     public function selectdataTipoEjercicios(Request $request){
        try { 
            $tipo = DB::select("select te.tipo_ejercicio_id as id,te.nombre
            from tipo_ejercicio as te 
            group by te.nombre,te.tipo_ejercicio_id");

            $data = array(
                'data' => $tipo
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos"];//500;
            //return back();
        }
    }

    public function insertdataTipoEjercicios(Request $request){
        try { 
            DB::insert('insert into tipo_ejercicio (nombre) 
            values (?) ' ,[$request->nombre]);

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al crear el tipo"];//500;
            //return back();
        }
        
        return ["code"=>200, "msg"=>"Se ha introducido el tipo correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataTipoEjercicios(Request $request){


        try { 
            DB::delete('delete from tipo_ejercicio where tipo_ejercicio_id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el tipo"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado el tipo correctamente"];//200;
    }

     public function getEditarDataTipoEjercicios(Request $request){
        $tipoData = DB::select("select te.nombre
        from tipo_ejercicio as te 
         where te.tipo_ejercicio_id=".$request->id. 
        " group by te.nombre" );

        return json_encode($tipoData);
    }

    public function updatedataTipoEjercicios(Request $request)
    {
       
        try {
            DB::update('update categoria_ejercicio set nombre = ? where clases_id = ?', [$request->nombre,$request->id]);

            
        }catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex->getMessage()); //debug del msg de error
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado el tipo correctamente"];//200;
      
    }
}
