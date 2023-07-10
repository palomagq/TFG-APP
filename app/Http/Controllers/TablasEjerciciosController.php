<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;


class TablasEjerciciosController extends Controller
{
    //
    public function admin(Request $request){

        Session::flash('active','TabladeEjercicios');
        $request->user()->authorizeRoles(['admin','socio','personal']);
        $categorias = DB::select('select * from categoria_ejercicio');
        $tipos = DB::select('select * from tipo_ejercicio');
        $ejercicios = DB::select("
         
         select e.ejercicio_id,e.nombre as nombreEjercicio
            from ejercicio as e inner join categoria_ejercicio as ce on e.categoria_id=ce.categoria_ejercicio_id 
            where e.ejercicioPorDefecto=1    
            group by e.ejercicio_id,e.nombre,e.ejercicioPorDefecto,ce.nombre,ce.categoria_ejercicio_id
            
            union 
            
            select e.ejercicio_id,e.nombre as nombreEjercicio
            from ejercicio as e inner join categoria_ejercicio as ce on e.categoria_id=ce.categoria_ejercicio_id  inner join usuario_ejercicio as ue on       e.ejercicio_id=ue.ejercicio_id inner join usuarios as u on u.id=ue.usuarios_id
            where e.ejercicioPorDefecto=0  and  u.id=ue.usuarios_id and ue.usuarios_id=".session('idUsuario')."
            group by e.ejercicio_id,e.nombre,e.ejercicioPorDefecto,ce.nombre,ce.categoria_ejercicio_id
         
         
         
         ");
        return view('admin.listartablasejercicios',compact('categorias','tipos','ejercicios'));
     }


     public function selectdataTablaEjercicios(Request $request){
        try { 
            $ejercicio = DB::select("select te.tabla_de_ejercicios_id as id,te.nombre_rutina_ejercicio,e.nombre, are.serie as serie_objetivo,
            are.repeticion as repeticion_objetivo,are.distancia as distancia_objetivo,e.ejercicio_id
            FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
            are.tabla_de_ejercicios_id=te.tabla_de_ejercicios_id inner join ejercicio as e 
            on e.ejercicio_id=are.ejercicio_id left join usuario_ejercicio as ue on 
            ue.ejercicio_id=e.ejercicio_id
            where te.usuario_id=".Session('idUsuario'));

            $data = array(
                'data' => $ejercicio
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar las tablas de los ejercicios"];//500;
            //return back();
        }
    }

   public function insertdataTablaEjercicios(Request $request){

        $listadoEjercicios=$request->id_label_ejercicio;
        DB::beginTransaction();
        try { 
            if(Session('idRole') == 1 || Session('idRole') == 5){
                try{
                    DB::insert('insert into tabla_de_ejercicios (nombre_rutina_ejercicio,usuario_id) 
                    values (?,?) ' ,[$request->nombre_rutina_ejercicio,Session('idUsuario')]);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    DB::rollback();
                    return ["code"=>500, "msg"=>"Se ha producido un error al crear la tabla de ejercicios".$ex->getMessage()];//500;
                }

                try{
                    $tabla_de_ejercicio = DB::select("select te.tabla_de_ejercicios_id
                    FROM  tabla_de_ejercicios as te
                    where te.nombre_rutina_ejercicio='".$request->nombre_rutina_ejercicio."' and te.usuario_id=".Session('idUsuario')."
                    group by te.tabla_de_ejercicios_id");
                }catch(\Illuminate\Database\QueryException $ex){
                    DB::rollback();
                    return ["code"=>500, "msg"=>"Se ha producido un error al obtener la tabla de ejercicios creada.".$ex->getMessage()];//500;           
                }

                try{
                    for($i=0; $i<count($listadoEjercicios);$i++){
                        DB::insert('insert into asignacion_rutina_ejercicios (tabla_de_ejercicios_id,ejercicio_id) 
                        values (?,?) ' ,[$tabla_de_ejercicio[0]->tabla_de_ejercicios_id,$listadoEjercicios[$i]]);
                    }
                } catch(\Illuminate\Database\QueryException $ex){ 
                    DB::rollback();
                    return ["code"=>500, "msg"=>"Se ha producido un error al crear la asignacion de la tabla de ejercicios".$ex->getMessage()];//500;
                }        
            }else{
                return ["code"=>500, "msg"=>"No tiene permiso para crear las tablas de ejercicios"];//500;
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al crear la tabla de ejercicios".$ex->getMessage()];//500;
            //return back();
        }
        DB::commit();
        return ["code"=>200, "msg"=>"Se ha introducido la tabla de ejercicios correctamente"];//200;
    }


    public function deletedataTablaEjercicios(Request $request){


        try { 
            DB::delete('delete from asignacion_rutina_ejercicios where ejercicio_id='.$request->ejercicio_id.' and tabla_de_ejercicios_id='.$request->id );
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la tabla de ejercicios"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado la tabla de ejercicios correctamente"];//200;
    }
    
    public function getEditarDataTablaEjercicios(Request $request){
        $tablaEjercicioData = DB::select("select te.tabla_de_ejercicios_id as id,te.nombre_rutina_ejercicio,e.ejercicio_id as ejercicio_id,e.nombre,
         are.serie as serie_objetivo,
        are.repeticion as repeticion_objetivo,are.distancia as distancia_objetivo
        FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on are.tabla_de_ejercicios_id=te.tabla_de_ejercicios_id 
        inner join ejercicio as e on e.ejercicio_id=are.ejercicio_id 
        left join usuario_ejercicio as ue on ue.ejercicio_id=e.ejercicio_id
        where e.ejercicio_id=".$request->id);
  
        return json_encode($tablaEjercicioData);
    }

    public function updatedataTablaEjercicios(Request $request)
    {
       
        try {
            DB::update('update asignacion_rutina_ejercicios set serie = ? where ejercicio_id = ? and tabla_de_ejercicios_id = ?', [$request->serie_objetivo,$request->ejercicio_id,$request->id]);
            DB::update('update asignacion_rutina_ejercicios set repeticion = ? where ejercicio_id = ? and tabla_de_ejercicios_id = ?', [$request->repeticion_objetivo,$request->ejercicio_id,$request->id]);
            DB::update('update asignacion_rutina_ejercicios set distancia = ? where ejercicio_id = ? and tabla_de_ejercicios_id = ?', [$request->distancia_objetivo,$request->ejercicio_id,$request->id]);

        }catch(\Illuminate\Database\QueryException $ex){ 
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la tabla de ejercicios ".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado la tabla de ejercicios correctamente"];//200;
      
    }

}
