<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;
use Validator;

class CalendarioHorarioClasesController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','CalendarioHorarioClases');

        $request->user()->authorizeRoles(['admin','jefe','personal','recepción','socio']); //solo tiene acceso los que tiene ese rol
        $gimnasios = DB::select('select * from gimnasio');
        $clases = DB::select('select * from clases');
        $salas = DB::select('select * from sala');
        $monitores = DB::select("select u.* from usuarios as u left join role_user as ru on u.id=ru.user_id 
        left join roles as r on ru.role_id=r.id where r.name='Personal'");
        return view('admin.calendariohorarioclases',compact('clases','gimnasios','salas','monitores'));
    }


        //muestra las clases visualizadas en el calendario
        public function CalendarioHorarioClaseGETDATA(Request $request){

            try { 

                if(Session('idRole') == 1){
                    $horario_clases = DB::select("select concat(c.nombre,' - ',s.nombre) as title,concat(cp.fecha_clase,'T',cp.hora_inicio) as start, 
                    concat(cp.fecha_clase,'T',cp.hora_fin) as end
                    ,case when s.nombre='Sala 1' then '#3498DB'
                    when s.nombre='Sala 2' then '#2ECC71'
                    when s.nombre='Sala 3' then '#E74C3C'
                    else '#F4D03F' end as color, cp.clase_planificada_id as myId
                    FROM clase_planificada as cp left join clases as c on cp.clases_id=c.clases_id left join sala as s on cp.sala_id=s.sala_id 
                    left join gimnasio as g on c.gimnasio_id=g.gimnasio_id   
                    where c.gimnasio_id=".$request->id."  ");
                }else{
                    $horario_clases = DB::select("select concat(c.nombre,' - ',s.nombre) as title,concat(cp.fecha_clase,'T',cp.hora_inicio) as start, 
                    concat(cp.fecha_clase,'T',cp.hora_fin) as end
                    ,case when s.nombre='Sala 1' then '#3498DB'
                    when s.nombre='Sala 2' then '#2ECC71'
                    when s.nombre='Sala 3' then '#E74C3C'
                    else '#F4D03F' end as color, cp.clase_planificada_id as myId
                    FROM clase_planificada as cp left join clases as c on cp.clases_id=c.clases_id left join sala as s on cp.sala_id=s.sala_id 
                    left join gimnasio as g on c.gimnasio_id=g.gimnasio_id   
                    where  g.gimnasio_id=".Session('id_gimnasio'));
                }
    
                echo json_encode($horario_clases);

            } catch(\Illuminate\Database\QueryException $ex){ 
                return ["code"=>500, "msg"=>"Se ha producido un error al mostrar el calendario de las clases(".$request->id.") ".$ex->getMessage()];//500;
            }
        }

        public function inscribeClaseMatriculadaGETDATA(Request $request){
            try { 
                $clase_matriculada = DB::select("

                select cp.clase_planificada_id,s.capacidad-(select count(*) from capacidad_clase c where c.clase_planificada_id=cp.clase_planificada_id) as capacidad,cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre as nombre_clase, 
                s.nombre as nombre_sala ,g.gimnasio_id,c.clases_id,s.sala_id,cp.monitor_id, cc.capacidad_clase_id
                FROM clase_planificada as cp inner join clases as c on cp.clases_id=c.clases_id inner join 
                sala as s on cp.sala_id=s.sala_id and s.gimnasio_id=c.gimnasio_id inner join gimnasio as g 
                on g.gimnasio_id=c.gimnasio_id and g.gimnasio_id=s.gimnasio_id left join usuarios as u on u.id=cp.monitor_id
                inner join usuario_gimnasio as ug on g.gimnasio_id=ug.gimnasio_id
                 left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id 
                 left join capacidad_clase cc on cc.clase_planificada_id=cp.clase_planificada_id and cc.usuario_id=".Session::get("idUsuario")."
                 where cp.clase_planificada_id=".$request->id."
                 group by cp.clase_planificada_id,s.capacidad,cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre,s.nombre,
                 g.gimnasio_id,c.clases_id,s.sala_id,cp.monitor_id,cc.capacidad_clase_id
                ");

            } catch(\Illuminate\Database\QueryException $ex){ 
                return ["code"=>500, "msg"=>"Se ha producido un error al mostrar la clase a inscribirse(".$request->id.") ".$ex->getMessage()];//500;
            }
            return ["code"=>200, "data"=>$clase_matriculada];//200;

        }

        public function deletedataClaseMatriculada(Request $request){


            try { 
                DB::delete('delete from capacidad_clase where capacidad_clase_id='.$request->id);
            } catch(\Illuminate\Database\QueryException $ex){ 
               
                return ["code"=>500, "msg"=>"Se ha producido un error al borrar la clase matriculada"];//500;
            }
            return ["code"=>200, "msg"=>"Se ha borrado la clase matriculada correctamente"];//200;
        }

        public function insertClaseMatriculada(Request $request){
            try { 
              //if($this->comprobacionInscripcion($request)){
                    DB::insert('insert into capacidad_clase (clase_planificada_id,usuario_id,fecha_registro) 
                    values (?,?,CURDATE()) ' ,[$request->clase_planificada_id,Session::get('idUsuario')]);
              //}
            } catch(\Illuminate\Database\QueryException $ex){ 
    
                return ["code"=>500, "msg"=>"Se ha producido un error al añadir la clase matriculada.".$ex->getMessage()];//500;
            }
           //return redirect('selectdataClaseMatriculadaGETDATA');

            return ["code"=>200, "msg"=>"Se ha introducido la clase matriculada correctamente"];//200;
        }
}
