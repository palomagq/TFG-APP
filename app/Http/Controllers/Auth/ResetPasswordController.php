<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;
use Validator;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function admin(Request $request){
        //Session::flash('active','Jefes');

       //$request->user()->authorizeRoles(['admin','jefe']);
      // $gimnasios = DB::select('select * from gimnasio');
      $message='';

       return view('auth.passwords.reset',compact('message'));
    }

    public function resetPassword(Request $request){

        $email = DB::select("select * from usuarios where email='".$request->email."'");
        if(count($email) > 0){

            $details = [
                'pass' => $email[0]->dni,
            ];

            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

            try {
                DB::update('update usuarios set password = ? , cambiarPassword = ? where id = ?', [bcrypt($email[0]->dni),1,$email[0]->id]);      
               // dd('Actualiza');

            }catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex);
                Session::flash('error','Se ha producido un error al actualizar la nueva contraseña');
                return view('auth.passwords.reset');
               
            }

        }else{   
            Session::flash('error','Se ha producido un error al no existir el email');
            return view('auth.passwords.reset');
        }

        return view('auth.login');
    }

    public function updatePassword(Request $request){

        try {
            DB::update('update usuarios set password = ? , cambiarPassword = ? where id = ?', [bcrypt($request->new_pass),0,Session('idUsuario')]);      
        }catch(\Illuminate\Database\QueryException $ex){ 
            Session::flash('error','Se ha producido un error al actualizar la nueva contraseña');
            //return view('auth.passwords.reset');
        }
        Session::put('cambiarPass',0);// no muestra el modal al cambiar la contraseña
        
        return back();


        //return view('auth.login');
    }
}
