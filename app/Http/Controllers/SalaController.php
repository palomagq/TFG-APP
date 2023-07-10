<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class SalaController extends Controller
{
    // 
    public function admin(Request $request){
        Session::flash('active','Sala');

       $request->user()->authorizeRoles(['admin','jefe','personal','recepción']);
       $gimnasios = DB::select('select * from gimnasio');
       
       return view('admin.listarsala',compact('gimnasios'));
    }

    public function selectdataSala(Request $request){
        try { 
            $sala = DB::select("select s.sala_id as id,s.nombre,s.capacidad, 
            GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
            from sala as s left join gimnasio as g on s.gimnasio_id=g.gimnasio_id
            group by s.nombre,s.capacidad,s.sala_id");

            $data = array(
                'data' => $sala
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); //debug del msg de error

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar las salas"];//500;
            //return back();
        }

    }

    public function insertdataSala(Request $request){

        try { 
            DB::insert('insert into sala (nombre, capacidad, gimnasio_id) 
            values (?,?,?) ' ,[$request->nombre,$request->capacidad,$request->nombregimnasio_localidad]);

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al crear la sala"];//500;
            //return back();
        }
        
        return ["code"=>200, "msg"=>"Se ha introducido la sala correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataSala(Request $request){


        try { 
            DB::delete('delete from sala where id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); //debug del msg de error
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la sala"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado la sala correctamente"];//200;

    }

     public function getEditarDataSala(Request $request){
        $salaData = DB::select("select s.nombre,s.capacidad,s.gimnasio_id
        from sala as s left join gimnasio as g on s.gimnasio_id=g.gimnasio_id where sala_id=".$request->id."
        group by s.nombre,s.capacidad,s.gimnasio_id");
        //DB::find($request->id);
        return json_encode($salaData);
    }

    public function updatedataSala(Request $request)
    {
      
        try {
            DB::update('update sala set nombre = ? where sala_id = ?', [$request->nombre,$request->id]);
            DB::update('update sala set capacidad = ? where sala_id = ?', [$request->capacidad,$request->id]);
            DB::update('update sala set gimnasio_id = ? where sala_id = ?', [$request->nombregimnasio_localidad,$request->id]);
            
        }catch(\Illuminate\Database\QueryException $ex){ 
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la sala".$ex->getMessage()];//500;
        }

        return ["code"=>200, "msg"=>"Se ha actualizado la sala correctamente"];//200;
      
    }

}
