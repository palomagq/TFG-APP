<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class EvolucionEjercicioController extends Controller
{
    //

    public function admin(Request $request){
        $request->user()->authorizeRoles(['admin','socio','personal']);

        //Session::flash('active','EntrenamientoDiario');

        $socios = DB::select("select u.* from usuarios as u left join role_user as ru on u.id=ru.user_id 
        left join roles as r on ru.role_id=r.id where r.name='Socio'");   
        $gimnasios = DB::select('select * from gimnasio');



        return view('admin.evolucionejercicios',compact('socios','gimnasios'));
     }

     public function selectdataEvolucionEjercicios(Request $request){

        $id_gimnasio=$request->id_gimnasio;

        try { 
            $evolucion_ejercicios = DB::select('select distinct e.ejercicio_id,ee.tabla_de_ejercicios_id,e.nombre, are.serie as serie,
            are.repeticion as repeticion,are.distancia as distancia,ee.evolucion_ejercicios_id
            FROM tabla_de_ejercicios as te inner join asignacion_rutina_ejercicios as are on 
            te.tabla_de_ejercicios_id=are.tabla_de_ejercicios_id inner JOIN ejercicio as e on 
            are.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on 
            te.tabla_de_ejercicios_id=ee.tabla_de_ejercicios_id and te.usuario_id=ee.usuario_id 
            left join evolucion_ejercicios_datos as eed on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id and eed.ejercicio_id=e.ejercicio_id
            where te.usuario_id='.Session('idUsuario').' and ee.tabla_de_ejercicios_id='.session('idTablaEjercicios').' 
            and ee.fecha_registro='.session('fecha'));

            /*SELECT ee.fecha_registro,e.nombre,eed.serie,eed.repeticion,eed.distancia,eed.peso,u.nombre,u.apellidos 
            from usuarios as u inner join usuario_ejercicio as ue on u.id=ue.usuarios_id inner join ejercicio as e 
            on ue.ejercicio_id=e.ejercicio_id inner join evolucion_ejercicios as ee on u.id=ee.usuario_id 
            inner join evolucion_ejercicios_datos as eed on e.ejercicio_id=eed.ejercicio_id 
            where ee.fecha_registro='2023-07-19'*/ 
            
            $data = array(
                'data' => $evolucion_ejercicios
                
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los entrenamientos diarios. ".$ex->getMessage()];//500;
            //return back();
        }
    }  

    public function selectSocioGimnasio(Request $request){
        $id_gimnasio=$request->id_gimnasio;

        try { 


            if((Session('idRole') == 1) || (Session('idRole') == 4)){
                $socios_gimnasios = DB::select('select distinct u.nombre, u.apellidos,u.id FROM usuarios as u inner join
                usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on ug.gimnasio_id=g.gimnasio_id 
                inner join role_user as ru on ru.user_id=u.id inner join roles as r on ru.role_id=r.id 
                where g.gimnasio_id='. $id_gimnasio .' and r.name="Socio"');
            }
            return ["code"=>200, "data"=>$socios_gimnasios];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los socios de un gimnasio. ".$ex->getMessage()];//500;
            //return back();
        }
    }
}
