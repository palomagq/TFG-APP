<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;
use Validator;

class HistorialdePagoController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','HistorialdePago');

       $request->user()->authorizeRoles(['admin','recepción']);
      // $gimnasios = DB::select('select * from gimnasio');

        
       return view('admin.historialdepago');
    }

    public function selectdataHistorialdePago(Request $request){
        try{
            $historialpago = DB::select("select up.usuario_pagos_id,u.nombre,u.apellidos,u.dni,up.fecha_pago,up.cuota_pago 
            FROM usuarios as u inner join role_user as ru on u.id=ru.user_id inner join roles as r 
            on ru.role_id=r.id inner JOIN usuario_pagos as up on u.id=up.usuario_id 
            where r.name='Socio' and
            up.fecha_pago>=str_to_date(concat('01/',DATE_FORMAT(curdate(),'%m/%Y')),'%d/%m/%Y')");

            $data = array(
                'data' => $historialpago
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){            
            //dd($ex->getMessage());
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar el historial de pago ".$ex->getMessage()];//500;          
        }
    }
}
