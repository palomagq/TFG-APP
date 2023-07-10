<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;
use Validator;

class PasareladePagoController extends Controller
{
  

    public function checkout(){   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51MtFDXHX7PLXGa17EAUqarZEOC4hg3fJzC5isDIVkSF2tHY1Kiu5kkzebx9d2pUjIjMZrUsDfVZMHGelwFqmmKJh00JolEzS8e');
        		
		$amount = 30;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Gestión Deportiva en el FitEnerGym',
			'amount' => $amount,
			'currency' => 'EUR',
			'description' => 'Mensualidad correspondiente a ' . date('m/Y'),
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;
        $amount_tmp=$amount/100;

		return view('admin.pasareladepago',compact('intent','amount_tmp'));

    }

    public function afterPayment(Request $request){
       

        //guardar en bd para un suuario su pago en una fecha
        
        try { 
            DB::insert('insert into usuario_pagos (usuario_id,fecha_pago,cuota_pago) 
            values (?,curdate(),?) ' ,[Session('idUsuario'),$request->amount]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al realizar el pago de la cuota".$ex->getMessage()];//500;
        }
        session::forget('pagado');
        session::flash('successPayment','El pago ha sido realizado correctamente (Mensualidad '.date('m/Y').').');
        return redirect('CalendarioHorarioClase');
          
    }
}
