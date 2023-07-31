<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use App\Personal; 
use App;
use Hash;
use Carbon\Carbon;
use Session;
use Cookie;
use Illuminate\Database\DatabaseManager\InvalidArgumentException;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        Session::forget('msg');
        return redirect('/');
    }

    public function showLoginForm(){
        //si intentas iniciar sesión con este ojo
        Auth::logout();
        return view('auth.login');
    }

    public function pagenotfound(){
        return view('error');
    }

    public function login(Request $request)
    {
        Session::forget('msg');
        //dd($request->all());
        $email=$request->email;
        $password=$request->password;

        $sqlUser="
        SELECT * FROM `usuarios` u inner join role_user r on u.id=r.user_id
        where email='".$email."'";

        try{
            $user=DB::select(DB::raw($sqlUser));

        } catch (\Illuminate\Database\QueryException $exception) {
            
            Session::put('msg','Excepción en la obtención datos del usuario. Por favor contacte con el servicio técnico.');
            return redirect('/login');        
        }

        if(!empty($user))
            $user=$user[0];
           
        if($user==null){
            Session::put('msg','Error en la autenticación. Credenciales incorrectas.');
            return redirect('/');
        }
        else
            $hashedPass=$user->password;

            //comprueba si la traduccion de la pass coincide con la que se introduce
        if (Hash::check($password, $hashedPass) && $user) {

            auth()->loginUsingId($user->id); //logea el usuario
            Session::put('idUsuario',$user->id);
            Session::put('nombre',$user->nombre);
            Session::put('email',$user->email);
            Session::put('idRole',$user->role_id);
            Session::put('cambiarPass',$user->cambiarPassword);

        }
        else{
            Session::put('msg','Credenciales incorrectas');
            return back();
        }

            $user_pago=DB::select("select count(*) pagado FROM usuarios as u inner join role_user as ru on u.id=ru.user_id 
            inner join roles as r on ru.role_id=r.id inner JOIN
            usuario_pagos as up on u.id=up.usuario_id where r.name='Socio' 
            and up.fecha_pago>=str_to_date(concat('01/',DATE_FORMAT(curdate(),'%m/%Y')),'%d/%m/%Y') and 
            u.id=".Session('idUsuario'));


       

        //obtenemos la tabla de ejercicios que ha introducido hoy -> esto es por si se nos va la sesión
        $tblEjercicios=DB::select("SELECT tabla_de_ejercicios_id 
        FROM `evolucion_ejercicios` 
        where fecha_registro=curdate() and usuario_id=".Session('idUsuario'));

        if(count($tblEjercicios)>0){

            $tblEjercicios=$tblEjercicios[0]->tabla_de_ejercicios_id;
            Session::put('idTablaEjercicios',$tblEjercicios);
        }
        
        if($user_pago[0]->pagado==0 && $user->role_id==5 ){
            Session::put('pagado',0);
            return redirect('checkout');
        }


        //usuario que pertenece a un gimnasio
        $user_gimnasio=DB::select("SELECT u.id,g.gimnasio_id,g.nombre as nombre_gimnasio
        FROM usuarios as u inner join usuario_gimnasio as ug on u.id=ug.usuarios_id inner join gimnasio as g on ug.gimnasio_id=g.gimnasio_id 
        where  u.id=".Session('idUsuario'));

        Session::put('id_user_gimnasio',$user_gimnasio[0]->nombre_gimnasio);
        Session::put('id_gimnasio',$user_gimnasio[0]->gimnasio_id);


        if($user->role_id==1){
            //user
            return redirect('listarUsuarios');
        }else if($user->role_id==2){
            return redirect('listarJefes'); //creo q deberia ir al listado de personal o de recepcionista
        }else if($user->role_id==3){
            return redirect('listarPersonal');    
        }else if($user->role_id==4){
            return redirect('listarSocios');
        }else if($user->role_id==5){
            return redirect('CalendarioHorarioClase');
            //return route('name')
        }                
        
    }
}
