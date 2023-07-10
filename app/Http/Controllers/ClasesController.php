<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class ClasesController extends Controller
{
    // 
    public function admin(Request $request){
        Session::flash('active','Clases');

       $request->user()->authorizeRoles(['admin','jefe','personal','recepción']);
       $gimnasios = DB::select('select * from gimnasio');
       
       return view('admin.listarclases',compact('gimnasios'));
    }

    public function selectdataClase(Request $request){
        try { 
            $clase = DB::select("select c.clases_id as id,c.nombre,
            GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
            from clases as c left join gimnasio as g on c.gimnasio_id=g.gimnasio_id
            group by c.nombre,c.clases_id");

            $data = array(
                'data' => $clase
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar las clases"];//500;
            //return back();
        }
    }

    public function insertdataClase(Request $request){
        try { 
            DB::insert('insert into clases (nombre, gimnasio_id) 
            values (?,?) ' ,[$request->nombre,$request->nombregimnasio_localidad]);

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al crear la clase"];//500;
            //return back();
        }
        
        return ["code"=>200, "msg"=>"Se ha introducido la clase correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataClase(Request $request){


        try { 
            DB::delete('delete from clases where clases_id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la clase"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado la clase correctamente"];//200;
    }

     public function getEditarDataClase(Request $request){
        $claseData = DB::select("select c.nombre,c.gimnasio_id
        from clases as c left join gimnasio as g on c.gimnasio_id=g.gimnasio_id  where c.clases_id=".$request->id. 
        " group by c.nombre,c.gimnasio_id" );

        return json_encode($claseData);
    }

    public function updatedataClase(Request $request)
    {
       
        try {
            DB::update('update clases set nombre = ? where clases_id = ?', [$request->nombre,$request->id]);
            DB::update('update clases set gimnasio_id = ? where clases_id = ?', [$request->nombregimnasio_localidad,$request->id]);

            
        }catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex->getMessage()); //debug del msg de error
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la clase".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado la clase correctamente"];//200;
      
    }

}
