<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class ClasesMatriculadasController extends Controller
{
    // 
    public function admin(Request $request){
        Session::flash('active','ClasesMatriculadas');

       $request->user()->authorizeRoles(['admin','socio']);
       $gimnasios = DB::select('select * from gimnasio');
       $clases = DB::select('select * from clases');
       $salas = DB::select('select * from sala');
       $monitores = DB::select("select u.* from usuarios as u left join role_user as ru on u.id=ru.user_id 
       left join roles as r on ru.role_id=r.id where r.name='Personal'");       
       return view('admin.listarclasesmatriculadassocio',compact('clases','gimnasios','salas','monitores'));
    }

    public function selectdataClaseMatriculadaGETDATA(Request $request){
        $id_gimnasio=$request->id_gimnasio;

        try { 

            if($id_gimnasio==""){
                $clase = DB::select("select GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ')
                as nombregimnasio_localidad, s.nombre as nombre_sala,c.nombre as nombre_clase, cp.fecha_clase,cp.hora_inicio, 
                cp.hora_fin,cc.fecha_registro , cp.clase_planificada_id
                from gimnasio as g inner join sala as s on s.gimnasio_id=g.gimnasio_id inner join 
                clases as c on c.gimnasio_id=g.gimnasio_id inner join clase_planificada as cp on c.clases_id=cp.clases_id and s.sala_id=cp.sala_id inner join
                capacidad_clase as cc on cc.clase_planificada_id=cp.clase_planificada_id 
                group by s.nombre,c.nombre, cp.fecha_clase,cp.hora_inicio, cp.hora_fin,cc.fecha_registro,cp.clase_planificada_id");
            }else{
                $clase = DB::select("select GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ')
                as nombregimnasio_localidad, s.nombre as nombre_sala,c.nombre as nombre_clase, cp.fecha_clase,cp.hora_inicio, 
                cp.hora_fin,cc.fecha_registro , cp.clase_planificada_id
                from gimnasio as g inner join sala as s on s.gimnasio_id=g.gimnasio_id inner join 
                clases as c on c.gimnasio_id=g.gimnasio_id inner join clase_planificada as cp on c.clases_id=cp.clases_id and s.sala_id=cp.sala_id inner join
                capacidad_clase as cc on cc.clase_planificada_id=cp.clase_planificada_id 
                where  g.gimnasio_id=".$id_gimnasio."
                group by s.nombre,c.nombre, cp.fecha_clase,cp.hora_inicio, cp.hora_fin,cc.fecha_registro,cp.clase_planificada_id");
            }
            $data = array(
                'data' => $clase
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar las clases matriculadas"];//500;
        }
    }

    public function deletedataClaseMatriculada(Request $request){


        try { 
            DB::delete('delete from capacidad_clase where capacidad_clase_id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la clase matriculada"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado la clase matriculada correctamente"];//200;
    }

     public function getEditarDataClaseMatriculada(Request $request){
        $claseMatriculadaData = DB::select("select GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ')
        as nombregimnasio_localidad, s.nombre as nombre_sala,c.nombre as nombre_clase, cp.fecha_clase,cp.hora_inicio, 
        cp.hora_fin,cc.fecha_registro,g.gimnasio_id,s.sala_id,c.clases_id,cc.capacidad_clase_id
        from gimnasio as g inner join sala as s on s.gimnasio_id=g.gimnasio_id inner join 
        clases as c on c.gimnasio_id=g.gimnasio_id inner join clase_planificada as cp on c.clases_id=cp.clases_id and s.sala_id=cp.sala_id inner join
         capacidad_clase as cc on cc.clase_planificada_id=cp.clase_planificada_id 
         where cp.clase_planificada_id=".$request->id."
         group by s.nombre,c.nombre, cp.fecha_clase,cp.hora_inicio, cp.hora_fin,cc.fecha_registro,g.gimnasio_id,s.sala_id,c.clases_id,cc.capacidad_clase_id" );

        return json_encode($claseMatriculadaData);
    }

    public function updatedataHorarioClaseMatriculada(Request $request)
    {
       
        try {
            DB::update('update clase_planificada set sala_id = ? where clase_planificada_id = ?', [$request->sala_id,$request->id]);
            DB::update('update clase_planificada set clases_id = ? where clase_planificada_id = ?', [$request->clases_id,$request->id]);
            DB::update('update clase_planificada set fecha_clase = ? where clase_planificada_id = ?', [$request->fecha_clase,$request->id]);
            DB::update('update clase_planificada set hora_inicio = ? where clase_planificada_id = ?', [$request->hora_inicio,$request->id]);
            DB::update('update clase_planificada set hora_fin = ? where clase_planificada_id = ?', [$request->hora_fin,$request->id]);

        }catch(\Illuminate\Database\QueryException $ex){ 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la clase matriculada".$ex->getMessage()];//500;
        }

        return ["code"=>200, "msg"=>"Se ha actualizado el horario de la clase matriculada correctamente"];//200;      
    }


}


