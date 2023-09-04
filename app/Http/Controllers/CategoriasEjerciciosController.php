<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;



class CategoriasEjerciciosController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','CategoriaEjercicios');

        $request->user()->authorizeRoles(['admin','personal','socio']);
        //$gimnasios = DB::select('select * from gimnasio');
        
        return view('admin.listarcategoriasejercicios');
     }

     public function selectdataCategoriaEjercicios(Request $request){
        try { 
            $categoria = DB::select("select DISTINCT ce.categoria_ejercicio_id as id,ce.nombre,ce.usuario_id from categoria_ejercicio as ce 
            where ce.usuario_id=".Session('idUsuario'). "

            union

            select DISTINCT ce.categoria_ejercicio_id as id,ce.nombre,ce.usuario_id from categoria_ejercicio as ce 
            inner join usuarios as u on ce.usuario_id=u.id inner join role_user as ru on u.id=ru.user_id inner join roles as r
             on ru.role_id=r.id where r.name='Personal'

             union

             select DISTINCT ce.categoria_ejercicio_id as id,ce.nombre,ce.usuario_id from categoria_ejercicio as ce 
             inner join usuarios as u on ce.usuario_id=u.id inner join role_user as ru on u.id=ru.user_id inner join roles as r
              on ru.role_id=r.id where r.name='Admin'
 
            
            "
            );

            $data = array(
                'data' => $categoria
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar las categorías"];//500;
            //return back();
        }
    }

    public function insertdataCategoriaEjercicios(Request $request){
        try { 
            DB::insert('insert into categoria_ejercicio (nombre,usuario_id) 
            values (?,?) ' ,[$request->nombre,Session('idUsuario')]);

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al crear la categoría".$ex->getMessage()];//500;
            //return back();
        }
        
        return ["code"=>200, "msg"=>"Se ha introducido la categoría correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataCategoriaEjercicios(Request $request){


        try { 
            DB::delete('delete from categoria_ejercicio where categoria_ejercicio_id='.$request->id." and usuario_id=".session('idUsuario'));
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la categoría"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado la categoría correctamente"];//200;
    }

     public function getEditarDataCategoriaEjercicios(Request $request){
        $categoriaData = DB::select("select ce.nombre
        from categoria_ejercicio as ce 
         where ce.categoria_ejercicio_id=".$request->id. 
        " group by ce.nombre" );

        return json_encode($categoriaData);
    }

    public function updatedataCategoriaEjercicios(Request $request)
    {
       
        try {
            DB::update('update categoria_ejercicio set nombre = ? where categoria_ejercicio_id = ?', [$request->nombre,$request->id]);

            
        }catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex->getMessage()); //debug del msg de error
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la categoría".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado la categoría correctamente"];//200;
      
    }
}
