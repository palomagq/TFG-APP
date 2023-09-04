<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;


class EjerciciosController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','Ejercicios');

        $request->user()->authorizeRoles(['admin','personal','socio']);
        $categorias = DB::select('select distinct ce.* from categoria_ejercicio as ce inner join usuarios as u on u.id=ce.usuario_id 
        where u.id='.Session('idUsuario').'
        
        union

        select distinct ce.* from categoria_ejercicio as ce inner join  usuarios as u on u.id=ce.usuario_id inner join 
        role_user as ru on u.id=ru.user_id inner join roles as r on r.id=ru.role_id inner join usuario_gimnasio as ug 
        on ug.usuarios_id=u.id inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id
        where ru.role_id in (1,4) and g.gimnasio_id='.Session('id_gimnasio')
        );
       // $tipos = DB::select('select * from tipo_ejercicio');
        $ejercicios = DB::select('select * from ejercicio');
        return view('admin.listarejercicios',compact('categorias','ejercicios'));
     }


     public function selectdataEjercicios(Request $request){
        try { 
            $ejercicio = DB::select("select e.ejercicio_id as id,e.nombre,e.ejercicioPorDefecto,ce.nombre as nombre_categoria,
            ce.categoria_ejercicio_id, 
            case when e.ejercicioPorDefecto='1' then 'Sí' else 'No' end as pordefecto
            from ejercicio as e inner join categoria_ejercicio as ce on e.categoria_id=ce.categoria_ejercicio_id 
            where e.ejercicioPorDefecto=1    
            group by e.ejercicio_id,e.nombre,e.ejercicioPorDefecto,ce.nombre,ce.categoria_ejercicio_id
            
            union 
            
            select e.ejercicio_id as id,e.nombre,e.ejercicioPorDefecto,ce.nombre as nombre_categoria,
            ce.categoria_ejercicio_id, 
            case when e.ejercicioPorDefecto='1' then 'Sí' else 'No' end as pordefecto
            from ejercicio as e inner join categoria_ejercicio as ce on e.categoria_id=ce.categoria_ejercicio_id  inner join usuario_ejercicio as ue on 
             e.ejercicio_id=ue.ejercicio_id inner join usuarios as u on u.id=ue.usuarios_id
            where e.ejercicioPorDefecto=0  and  u.id=ue.usuarios_id and ue.usuarios_id=".session('idUsuario')."
            group by e.ejercicio_id,e.nombre,e.ejercicioPorDefecto,ce.nombre,ce.categoria_ejercicio_id");

            $data = array(
                'data' => $ejercicio
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los ejercicios"];//500;
            //return back();
        }
    }

    public function insertdataEjercicios(Request $request){
       
        if(Session('idRole') == 5){
       
            try { 
               /* if ($request->ejercicioPorDefecto == null){
                        $request->ejercicioPorDefecto.value(0);
                    }*/
                    DB::insert("insert into ejercicio (nombre,ejercicioPorDefecto,categoria_id) 
                    values (?,?,?) " ,[$request->nombre,0,$request->categoria_id]);

            } catch(\Illuminate\Database\QueryException $ex){ 
                    return ["code"=>500, "msg"=>"Se ha producido un error al crear el ejercicio".$ex->getMessage()];//500;
                    //return back();
            }
        }else{
            try { 
               /* if ($request->ejercicioPorDefecto == null){
                        $request->ejercicioPorDefecto.value(0);
                    }*/
                    DB::insert('insert into ejercicio (nombre,ejercicioPorDefecto,categoria_id) 
                    values (?,?,?) ' ,[$request->nombre,$request->ejercicioPorDefecto,$request->categoria_id]);

            } catch(\Illuminate\Database\QueryException $ex){ 
                    return ["code"=>500, "msg"=>"Se ha producido un error al crear el ejercicio xx".$ex->getMessage()];//500;
                    //return back();
            }
        }
        //obtenemos el id del ultimo user insertado por un identificador, en este caso el dni
        try{
            $ejercicio = DB::select("select ejercicio_id from ejercicio where 
            nombre='".$request->nombre."' and ejercicioPorDefecto='".$request->ejercicioPorDefecto."'
            and categoria_id='".$request->categoria_id."'");
            $user_id=session('idUsuario');
            $ejercicio_id=$ejercicio[0]->ejercicio_id;//["id"];

        }catch(\Illuminate\Database\QueryException $ex){
            return ["code"=>500, "msg"=>"Se ha producido un error al obtener el socio creado.".$ex->getMessage()];//500;
    
        }

            try { 
                DB::insert('insert into usuario_ejercicio (ejercicio_id, usuarios_id,fecha) 
                values (?,?,now()) ' ,[$ejercicio_id,$user_id]);
    
            } catch(\Illuminate\Database\QueryException $ex){ 
                return ["code"=>500, "msg"=>"Se ha producido un error al asignar el ejercicio al socio".$ex->getMessage()];//500;
            }
        
        return ["code"=>200, "msg"=>"Se ha introducido el ejercicio correctamente"];//200;
    }



    public function deletedataEjercicios(Request $request){


        try { 
            DB::delete('delete from ejercicio where ejercicio_id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el ejercicio"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado el ejercicio correctamente"];//200;
    }

    public function getEditarDataEjercicios(Request $request){
        $ejercicioData = DB::select("select e.ejercicio_id as id,e.nombre,e.ejercicioPorDefecto as ejercicioPorDefecto,ce.nombre as nombre_categoria,
        ce.categoria_ejercicio_id as categoria_id
        from ejercicio as e inner join  categoria_ejercicio as ce on e.categoria_id=ce.categoria_ejercicio_id
        where e.ejercicio_id=".$request->id. 
        " group by e.ejercicio_id,e.nombre,e.ejercicioPorDefecto,ce.nombre,ce.categoria_ejercicio_id");
  
        return json_encode($ejercicioData);
    }

    public function updatedataEjercicios(Request $request)
    {
       
        try {
            DB::update('update ejercicio set categoria_id = ? where ejercicio_id = ?', [$request->nombre_categoria,$request->id]);
            //DB::update('update ejercicio set tipo_id = ? where ejercicio_id = ?', [$request->nombre_tipo,$request->id]);
            DB::update('update ejercicio set nombre = ? where ejercicio_id = ?', [$request->nombre,$request->id]);
            if(Session('idRole') != 5){
                DB::update('update ejercicio set ejercicioPorDefecto = ? where ejercicio_id = ?', [$request->ejercicioPorDefecto,$request->id]);
            }
        
        }catch(\Illuminate\Database\QueryException $ex){ 
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el ejercicio ".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado el ejercicio correctamente"];//200;
      
    }

}
