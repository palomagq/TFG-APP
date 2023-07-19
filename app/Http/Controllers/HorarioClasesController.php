<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;
use Validator;


class HorarioClasesController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','HorarioClases');

        $request->user()->authorizeRoles(['admin','jefe','personal','recepción']); //solo tiene acceso los que tiene ese rol
        $clases = DB::select('select * from clases');
        $salas = DB::select('select * from sala');
        $monitores = DB::select("select * from usuarios as u left join role_user as ru on u.id=ru.user_id 
        left join roles as r on ru.role_id=r.id where r.name='Personal'");

        $gimnasios = DB::select('select * from gimnasio');

        //dd($roles);
        return view('admin.listarhorarioclases',compact('clases','gimnasios','salas','monitores'));
    }

    public function selectdataHorarioClase(Request $request){
        //dd($ex->getMessage());
        $id_gimnasio=$request->id_gimnasio;

        try { 
            if($id_gimnasio==""){

                $horario_clases = DB::select(
                "select DISTINCT cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre as nombre_clase,
                s.nombre as nombre_sala,GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad,
                GROUP_CONCAT(DISTINCT concat(u.nombre,' ', u.apellidos,'  ') SEPARATOR ' ') as nombreapellidos_monitor,cp.clase_planificada_id
                FROM clases as c inner join clase_planificada as cp on cp.clases_id=c.clases_id inner join sala as s on
                s.sala_id=cp.sala_id and s.gimnasio_id=c.gimnasio_id        
                inner join gimnasio as g on g.gimnasio_id=c.gimnasio_id and g.gimnasio_id=s.gimnasio_id
                inner join usuarios as u on u.id=cp.monitor_id            
                inner join role_user as ru on u.id=ru.user_id inner join roles as r on r.id=ru.role_id
                inner join usuario_gimnasio as ug on u.id=ug.usuarios_id and ug.gimnasio_id=g.gimnasio_id     
                where r.name='Personal'
                group by cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre,s.nombre,cp.clase_planificada_id");
            }else{
                $horario_clases = DB::select(
                    "select DISTINCT cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre as nombre_clase,
                    s.nombre as nombre_sala,GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad,
                    GROUP_CONCAT(DISTINCT concat(u.nombre,' ', u.apellidos,'  ') SEPARATOR ' ') as nombreapellidos_monitor,cp.clase_planificada_id
                    FROM clases as c inner join clase_planificada as cp on cp.clases_id=c.clases_id inner join sala as s on
                    s.sala_id=cp.sala_id and s.gimnasio_id=c.gimnasio_id        
                    inner join gimnasio as g on g.gimnasio_id=c.gimnasio_id and g.gimnasio_id=s.gimnasio_id
                    inner join usuarios as u on u.id=cp.monitor_id            
                    inner join role_user as ru on u.id=ru.user_id inner join roles as r on r.id=ru.role_id
                    inner join usuario_gimnasio as ug on u.id=ug.usuarios_id and ug.gimnasio_id=g.gimnasio_id     
                    where r.name='Personal' and  g.gimnasio_id=".$id_gimnasio. "
                    group by cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre,s.nombre,cp.clase_planificada_id");
            }

            $data = array(
                'data' => $horario_clases
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar el horario de las clases",$ex->getMessage()];//500;
        }

    }

    public function insertdataHorarioClase(Request $request){

        //diferencia de fechas para que la fecha fin sea mayor o igual que la fecha inicio
        $fecha_inicio_clase= new DateTime( $request->fecha_inicio_clase);

        $fecha_fin_clase= new DateTime( $request->fecha_fin_clase);

        $diferencia_fechas = $fecha_fin_clase->diff($fecha_inicio_clase);  

        try { 

            $claseExistenteMonitor = DB::select('select * from clase_planificada where ( (? >hora_inicio and ? <=hora_fin) 
            or (? >hora_inicio and ? <=hora_fin) or ( ? <hora_inicio and ? >hora_fin))
             and monitor_id = ? and fecha_clase between ? and ?',
              [$request->hora_inicio, $request->hora_inicio,$request->hora_fin, $request->hora_fin, 
              $request->hora_inicio, $request->hora_fin,$request->monitor_id,$request->fecha_inicio_clase,
              $request->fecha_fin_clase]);


            if(count($claseExistenteMonitor)>0){
                return ["code"=>500, "msg"=>"El monitor ya tiene otra clase en la misma hora"];//500;

            }

            $claseExistenteSala = DB::select('select * from clase_planificada where ( (? >hora_inicio and ? <=hora_fin) 
            or (? >hora_inicio and ? <=hora_fin) or ( ? <hora_inicio and ? >hora_fin))
             and sala_id = ? and fecha_clase between ? and ?',
              [$request->hora_inicio, $request->hora_inicio,$request->hora_fin, $request->hora_fin, 
              $request->hora_inicio, $request->hora_fin,$request->sala_id,$request->fecha_inicio_clase,
              $request->fecha_fin_clase]);


            if(count($claseExistenteSala)>0){
                return ["code"=>500, "msg"=>"Ya hay otra clase en la misma sala y hora"];//500;

            }

        for ($i = 0; $i <= $diferencia_fechas->days; $i++){
            
            $fecha_inicio_clase_aux= new DateTime( $request->fecha_inicio_clase);

            $date_added=$fecha_inicio_clase_aux->modify("+".$i." day");

                    // Si no hay coincidencias, guardar la nueva clase en la base de datos
                    DB::insert('insert into clase_planificada (sala_id,clases_id,fecha_clase,hora_inicio,hora_fin,monitor_id) 
                    values (?,?,?,?,?,?) ' ,[$request->sala_id,$request->clases_id,$date_added->format('Y-m-d'),$request->hora_inicio,$request->hora_fin,$request->monitor_id]);
                //}
        }

        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al crear la clase planificada".$ex->getMessage()." ".$request->sala_id];//500;
        }

        return ["code"=>200, "msg"=>"Se ha introducido la clase planificada correctamente"];//200;
    }

    public function deletedataHorarioClase(Request $request){


        try { 
            DB::delete('delete from clase_planificada where clase_planificada_id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al borrar la clase en la sala asignada"];//500;

        }
        return ["code"=>200, "msg"=>"Se ha borrado la clase en la sala asignada correctamente"];//200;

    }

     public function getEditarDataHorarioClase(Request $request){
        
        $claseplanificadaData = DB::select("select cp.clase_planificada_id,cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre as nombre_clase,
        s.nombre as nombre_sala, g.gimnasio_id,c.clases_id,s.sala_id,cp.monitor_id
        FROM clase_planificada as cp inner join clases as c on cp.clases_id=c.clases_id inner join sala as s on cp.sala_id=s.sala_id 
         inner join gimnasio as g on c.gimnasio_id=g.gimnasio_id  and s.gimnasio_id=g.gimnasio_id inner join usuario_gimnasio as ug 
         on g.gimnasio_id=ug.gimnasio_id inner join
         usuarios as u on u.id=cp.monitor_id inner join role_user as ru on u.id=ru.user_id inner join roles as r on ru.role_id=r.id
         where cp.clase_planificada_id=".$request->id."
         group by cp.clase_planificada_id,cp.fecha_clase,cp.hora_inicio,cp.hora_fin,c.nombre,s.nombre,g.gimnasio_id,c.clases_id,
         s.sala_id,cp.monitor_id");

        return json_encode([$claseplanificadaData]);
    }

    public function updatedataHorarioClase(Request $request)
    {
       
        try {
            DB::update('update clase_planificada set sala_id = ? where clase_planificada_id = ?', [$request->sala_id,$request->id]);
            DB::update('update clase_planificada set clases_id = ? where clase_planificada_id = ?', [$request->clases_id,$request->id]);
            DB::update('update clase_planificada set fecha_clase = ? where clase_planificada_id = ?', [$request->fecha_clase,$request->id]);
            DB::update('update clase_planificada set hora_inicio = ? where clase_planificada_id = ?', [$request->hora_inicio,$request->id]);
            DB::update('update clase_planificada set hora_fin = ? where clase_planificada_id = ?', [$request->hora_fin,$request->id]);
            DB::update('update clase_planificada set monitor_id = ? where clase_planificada_id = ?', [$request->monitor_id,$request->id]);

        }catch(\Illuminate\Database\QueryException $ex){ 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar la clase planificada en una sala y clase ".$ex->getMessage()];//500;
        }

        return ["code"=>200, "msg"=>"Se ha actualizado el horario de la clase planificada correctamente"];//200;      
    }

    //muestra las salas,clases y monitores correspondiente al gimnasio, una vez seleccionado
    public function getEditarDataGimnasioSalaClaseMonitores(Request $request){
        $salaData = DB::select('select s.* from sala as s left join gimnasio as g on s.gimnasio_id=g.gimnasio_id where s.gimnasio_id='.$request->id);

        $claseData = DB::select('select c.* from clases as c left join gimnasio as g on c.gimnasio_id=g.gimnasio_id where c.gimnasio_id='.$request->id);

        $monitoresData = DB::select("select u.* from usuarios as u inner join role_user as ru on u.id=ru.user_id 
        inner join roles as r on ru.role_id=r.id left join usuario_gimnasio as ug on u.id=ug.usuarios_id 
        left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
         where r.name='Personal' and g.gimnasio_id=".$request->id);

        return json_encode([$salaData,$claseData,$monitoresData]);
    }



  

}
