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


        return view('admin.evolucionejercicios',compact('socios'));
     }

     public function selectdataEvolucionEjercicios(Request $request){
        try { 
            $entrenamiento_diario_tabla1 = DB::select('select distinct e.ejercicio_id,ee.tabla_de_ejercicios_id,e.nombre, are.serie as serie,
            are.repeticion as repeticion,are.distancia as distancia,ee.evolucion_ejercicios_id
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
}
