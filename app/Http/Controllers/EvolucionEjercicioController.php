<?php


namespace App\Http\Controllers;

use DateTime;
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

        $id_usuario=$request->id_usuario;

        $addConditions="";

        //si existe fecha inicio y fecha finse añade las condiciones en el where de la query
        if(isset($request->fecha_inicio) && isset ($request->fecha_fin))
        {
            $addConditions=" and ee.fecha_registro>='".$request->fecha_inicio."' and ee.fecha_registro<='".$request->fecha_fin."'";
        }

        try { 

            if(Session('idRole')==5){
                $evolucion_ejercicios = DB::select("select ee.fecha_registro as fecha,e.nombre,eed.serie,eed.repeticion,eed.distancia,eed.peso,u.nombre  as nombre_usuario,u.apellidos 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id
                inner join ejercicio as e on e.ejercicio_id=eed.ejercicio_id
                inner join usuarios as u on u.id=ee.usuario_id
                where u.id='".Session('idUsuario')."'".$addConditions);
            }else{
                $evolucion_ejercicios = DB::select("select ee.fecha_registro as fecha,e.nombre,eed.serie,eed.repeticion,eed.distancia,eed.peso,u.nombre as nombre_usuario,u.apellidos 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id
                inner join ejercicio as e on e.ejercicio_id=eed.ejercicio_id
                inner join usuarios as u on u.id=ee.usuario_id
                where u.id='".$id_usuario."'".$addConditions);
            }
            
            
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

    public function grafica(Request $request){
        $id_socio=$request->id_socio;
        $id_ejercicio=$request->id_ejercicio;

        $addConditions="";

        //si existe fecha inicio y fecha finse añade las condiciones en el where de la query
        if(isset($request->fecha_inicio) && isset ($request->fecha_fin))
        {
            $addConditions=" and ee.fecha_registro>='".$request->fecha_inicio."' and ee.fecha_registro<='".$request->fecha_fin."'";
        }

        try { 

            if((Session('idRole')== 1) || (Session('idRole')== 4)){
                $evolucion_ejercicios_fechas = DB::select("select distinct DATE_FORMAT(ee.fecha_registro, '%d/%m/%Y')  as fecha,u.nombre as nombre_usuario,
                u.apellidos,u.id,e.nombre 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee
                on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id inner join ejercicio as e
                on e.ejercicio_id=eed.ejercicio_id inner join usuarios as u on u.id=ee.usuario_id 
                where u.id=".$id_socio. " and e.nombre='".$id_ejercicio."'".$addConditions);
            }else if(Session('idRole')== 5) {
                $evolucion_ejercicios_fechas = DB::select("select distinct DATE_FORMAT(ee.fecha_registro, '%d/%m/%Y') as fecha,e.nombre,eed.serie,eed.repeticion,eed.distancia,eed.peso,u.nombre as nombre_usuario,u.apellidos 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id
                inner join ejercicio as e on e.ejercicio_id=eed.ejercicio_id
                inner join usuarios as u on u.id=ee.usuario_id
                where u.id='".Session('idUsuario')."'and e.nombre='".$id_ejercicio."'".$addConditions. "order by serie" );
            }



            if((Session('idRole')== 1) || (Session('idRole')== 4)){

                $evolucion_ejercicios_colores=DB::select("select eed.peso as peso, eed.serie as serie,COALESCE(SUM(eed.distancia),0) as suma_distancia,DATE_FORMAT(ee.fecha_registro, '%d/%m/%Y') as fecha_registro 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id
                inner join ejercicio as e on e.ejercicio_id=eed.ejercicio_id
                inner join usuarios as u on u.id=ee.usuario_id
                where u.id='".$id_socio."'".$addConditions. " and e.nombre='".$id_ejercicio."'
                group by eed.serie, ee.fecha_registro,eed.peso
                order by eed.serie,ee.fecha_registro");

            }else if (Session('idRole')== 5) {
                $evolucion_ejercicios_colores=DB::select("select eed.peso as peso, eed.serie as serie,COALESCE(SUM(eed.distancia),0) as suma_distancia,DATE_FORMAT(ee.fecha_registro, '%d/%m/%Y') as fecha_registro 
                from evolucion_ejercicios_datos as eed inner join evolucion_ejercicios ee on ee.evolucion_ejercicios_id=eed.evolucion_ejercicios_id
                inner join ejercicio as e on e.ejercicio_id=eed.ejercicio_id
                inner join usuarios as u on u.id=ee.usuario_id
                where u.id='".Session('idUsuario')."'".$addConditions. " and e.nombre='".$id_ejercicio."'                
                group by eed.serie, ee.fecha_registro,eed.peso
                order by eed.serie,ee.fecha_registro");

            }
            
            $fechas=[];

            $series=[];
            $pesos=[];
            //$distancia=[];

            foreach($evolucion_ejercicios_fechas as $e){
                array_push($fechas,$e->fecha);
                array_push($pesos,null);
            }
            
            /*"{
                label: '1',
                data: [10,15,20],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }"*/

            $serieAnt=1;
            $datasetFinal=[];
            foreach($evolucion_ejercicios_colores as $e){


                if($serieAnt!=$e->serie){
                    $serialized=json_encode($pesos);
                    $json="{
                        label: '".$serieAnt."',
                        data: ".$serialized.",
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }";
                    array_push($datasetFinal,$json);
                    $pesos=[];

                    foreach($evolucion_ejercicios_fechas as $e2){
                        array_push($pesos,null);
                    }
                }
                

                $pos=array_search($e->fecha_registro,$fechas);
                $pesos[$pos]=$e->peso;
                //$pesos = array_merge(array_slice($pesos, 0, $pos), array($e->peso), array_slice($pesos, $pos));
                $serieAnt=$e->serie;
                //array_push($series,$e->serie);
                //$series = array('serie'=> $e->serie, 'peso'=> $e->peso, 'distancia'=> $e->distancia);
            }
            $serialized=json_encode($pesos);
            $json="{
                label: '".$serieAnt."',
                data: ".$serialized.",
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }";
            array_push($datasetFinal,$json);
            
            /*foreach($evolucion_ejercicios_colores as $e){
                array_push($pesos,$e->peso);
                //$series = array('serie'=> $e->serie, 'peso'=> $e->peso, 'distancia'=> $e->distancia);
            }*/
            
           /* foreach($evolucion_ejercicios_colores as $e){
                array_push($distancia,$e->distancia);
                //$series = array('serie'=> $e->serie, 'peso'=> $e->peso, 'distancia'=> $e->distancia);
            }*/
           /* $data = array(
                'data' => $evolucion_ejercicios
                
            );*/

            //echo json_encode($data);
            return ["code"=>200, "labels"=>$fechas,"data"=>json_encode($datasetFinal)];

        }catch(\Illuminate\Database\QueryException $ex){ 

            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los entrenamientos diarios. ".$ex->getMessage()];//500;
            //return back();
        }
    }
}
