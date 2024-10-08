<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;


class EntrenamientoDiarioController extends Controller
{
    //

    public function admin(Request $request){
        $request->user()->authorizeRoles(['admin','socio']);

        //para filtrar las fechas, si no hay fecha muestra el dia de hoy
        if($request->fecha==null){
            $fecha='curdate()';
        }else{
            $fecha="'".$request->fecha."'";
        }

        session::put('fecha',$fecha);

        Session::flash('active','EntrenamientoDiario');

        $existtablasejercicios = DB::select('select * from evolucion_ejercicios as ee where ee.fecha_registro='.$fecha.'
        and ee.usuario_id='.Session('idUsuario'));

        if(count($existtablasejercicios) == 0 ){
            Session::flash('modal',1);
        }

        //$tablasejercicios = DB::select('select tabla_de_ejercicios_id,nombre_rutina_ejercicio from tabla_de_ejercicios where usuario_id='.Session('idUsuario'));
        $tablasejercicios = DB::select("select distinct te.tabla_de_ejercicios_id,te.nombre_rutina_ejercicio 
        from tabla_de_ejercicios as te inner join usuarios as u on te.usuario_id=u.id 
        inner join usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id
        where te.usuario_id=".Session('idUsuario')."

        UNION

        select distinct te.tabla_de_ejercicios_id,te.nombre_rutina_ejercicio
        from tabla_de_ejercicios as te inner join
        usuarios as u on te.usuario_id=u.id 
        inner join usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id 
        inner join role_user as ru on
        ru.user_id=u.id inner join roles as r on r.id=ru.role_id
        where r.name in ('Personal','Admin') and g.gimnasio_id=".Session('id_gimnasio')
            );
        return view('admin.entrenamientodiario',compact('tablasejercicios'));
     }



     public function cargarTablaEjercicio(Request $request){
        $request->user()->authorizeRoles(['admin','socio']);

        Session::flash('active','EntrenamientoDiarioController');
        session::put('idTablaEjercicios',$request->id_label_tabla_ejercicio);

        
        try { 

            $existtablasejercicios = DB::select('select * from evolucion_ejercicios as ee where ee.fecha_registro=curdate() 
            and ee.usuario_id='.Session('idUsuario'));

            if(count($existtablasejercicios) == 0 ){
                DB::insert('insert into evolucion_ejercicios (fecha_registro,tabla_de_ejercicios_id,usuario_id) 
                values (curdate(),?,?) ' ,[$request->id_label_tabla_ejercicio,Session('idUsuario')]);
            }      

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al cargar las tablas de ejercicios"];//500;
            //return back();
        }
        
        $ejercicios = DB::select('select e.ejercicio_id,e.nombre, are.serie as serie_objetivo,
        are.repeticion as repeticion_objetivo,
        eed.serie as serie_real,
        eed.repeticion as repeticion_real,eed.peso as peso_real
        FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
        te.tabla_de_ejercicios_id=are.tabla_de_ejercicios_id inner JOIN ejercicio as e on 
        are.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on 
        te.tabla_de_ejercicios_id=ee.tabla_de_ejercicios_id and te.usuario_id=ee.usuario_id 
        left join evolucion_ejercicios_datos as eed on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id 
        where te.usuario_id='.Session('idUsuario').' and ee.tabla_de_ejercicios_id='.$request->id_label_tabla_ejercicio);


       $tablasejercicios = DB::select('select tabla_de_ejercicios_id,nombre_rutina_ejercicio from tabla_de_ejercicios
         where usuario_id='.Session('idUsuario'));
        /* $tablasejercicios = DB::select("select te.tabla_de_ejercicios_id,te.nombre_rutina_ejercicio,g.nombre 
         from tabla_de_ejercicios as te inner join usuarios as u on te.usuario_id=u.id 
         inner join usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id
         where te.usuario_id=".Session('idUsuario')."
        
            UNION

        select te.tabla_de_ejercicios_id,te.nombre_rutina_ejercicio,g.nombre 
        from tabla_de_ejercicios as te inner join
        usuarios as u on te.usuario_id=u.id 
        inner join usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id 
        inner join role_user as ru on
        ru.user_id=u.id inner join roles as r on r.id=ru.role_id
        where r.name in ('Socio','Admin') and g.gimnasio_id=".Session('id_gimnasio')
        
        );*/
        return view('admin.entrenamientodiario',compact('tablasejercicios','ejercicios'));
     }

     public function selectdataEntrenamientoDiario_tabla1(Request $request){
        try { 
            $entrenamiento_diario_tabla1 = DB::select('select distinct e.ejercicio_id,ee.tabla_de_ejercicios_id,e.nombre, are.serie as serie_objetivo,
            are.repeticion as repeticion_objetivo,ee.evolucion_ejercicios_id
            FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
            te.tabla_de_ejercicios_id=are.tabla_de_ejercicios_id inner JOIN ejercicio as e on 
            are.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on 
            te.tabla_de_ejercicios_id=ee.tabla_de_ejercicios_id and te.usuario_id=ee.usuario_id 
            left join evolucion_ejercicios_datos as eed on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id and eed.ejercicio_id=e.ejercicio_id
            where te.usuario_id='.Session('idUsuario').' and ee.tabla_de_ejercicios_id='.session('idTablaEjercicios').' 
            and ee.fecha_registro='.session('fecha'));
            
            $data = array(
                'data' => $entrenamiento_diario_tabla1
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los entrenamientos diarios. ".$ex->getMessage()];//500;
            //return back();
        }
    }

    public function selectdataEntrenamientoDiario_tabla2(Request $request){
        try { 
            $entrenamiento_diario_tabla2 = DB::select('select distinct e.ejercicio_id,ee.tabla_de_ejercicios_id,e.nombre, eed.serie as serie_real,
            eed.repeticion as repeticion_real,eed.peso as peso_real,ee.tabla_de_ejercicios_id,eed.evolucion_ejercicios_datos_id
            FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
            te.tabla_de_ejercicios_id=are.tabla_de_ejercicios_id inner JOIN ejercicio as e on 
            are.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on 
            te.tabla_de_ejercicios_id=ee.tabla_de_ejercicios_id and te.usuario_id=ee.usuario_id 
            left join evolucion_ejercicios_datos as eed on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id and eed.ejercicio_id=e.ejercicio_id
            where te.usuario_id='.Session('idUsuario').' and ee.tabla_de_ejercicios_id='.session('idTablaEjercicios').'
            and ee.fecha_registro='.session('fecha'));
            
            $data = array(
                'data' => $entrenamiento_diario_tabla2
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los entrenamientos diarios. ".$ex->getMessage()];//500;
            //return back();
        }
    }

    public function insertdataEntrenamientoDiario(Request $request){

        $serie_real=$request->serie_real;
        $repeticion_real=$request->repeticion_real;
        //$distancia_real=$request->distancia_real;
        $peso_real=$request->peso_real;
        $ejercicio_id=$request->ejercicio_id;
        $evolucion_ejercicios_id=$request->evolucion_ejercicios_id;

        try { 

            DB::insert("INSERT INTO `evolucion_ejercicios_datos` (`serie`, `repeticion`, `peso`, `ejercicio_id`, `evolucion_ejercicios_id`) 
            VALUES (?, ?, ?, ?, ?)",[$serie_real,$repeticion_real,$peso_real,$ejercicio_id,$evolucion_ejercicios_id]);
        

        } catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al crear el entrenamiento diario".$ex->getMessage()];//500;
            //return back();
        }


        return ["code"=>200, "msg"=>"Datos insertados correctamentes"];//500;

    }

       
    public function getEditarDataEntrenamientoDiario(Request $request){
        $evolucion_ejercicios_tabla2 = DB::select('select distinct e.ejercicio_id,ee.tabla_de_ejercicios_id,e.nombre, eed.serie as serie_real,
        eed.repeticion as repeticion_real,eed.peso as peso_real,ee.tabla_de_ejercicios_id
        FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
        te.tabla_de_ejercicios_id=are.tabla_de_ejercicios_id inner JOIN ejercicio as e on 
        are.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on 
        te.tabla_de_ejercicios_id=ee.tabla_de_ejercicios_id and te.usuario_id=ee.usuario_id 
        left join evolucion_ejercicios_datos as eed on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id and eed.ejercicio_id=e.ejercicio_id
        where eed.evolucion_ejercicios_datos_id='.$request->evolucion_ejercicios_datos_id);
        
        return json_encode($evolucion_ejercicios_tabla2);
    }

    public function updatedataEntrenamientoDiario(Request $request)
    {
       
        try {
            DB::update('update evolucion_ejercicios_datos set serie = ? where evolucion_ejercicios_datos_id = ?', [$request->serie_real,$request->evolucion_ejercicios_datos_id]);
            DB::update('update evolucion_ejercicios_datos set repeticion = ? where evolucion_ejercicios_datos_id = ?', [$request->repeticion_real,$request->evolucion_ejercicios_datos_id]);
           // DB::update('update evolucion_ejercicios_datos set distancia = ? where evolucion_ejercicios_datos_id = ?', [$request->distancia_real,$request->evolucion_ejercicios_datos_id]);
            DB::update('update evolucion_ejercicios_datos set peso = ? where evolucion_ejercicios_datos_id = ?', [$request->peso_real,$request->evolucion_ejercicios_datos_id]);

        }catch(\Illuminate\Database\QueryException $ex){ 
 
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el entrenamiento diario ".$ex->getMessage()];//500;

            }
    
        return ["code"=>200, "msg"=>"Se ha actualizado el entrenamiento diario correctamente"];//200;
      
    }
 
}
