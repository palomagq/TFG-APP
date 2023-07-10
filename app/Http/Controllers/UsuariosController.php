<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class UsuariosController extends Controller
{
    //
    public function admin(Request $request){
        Session::flash('active','Usuarios');

        $request->user()->authorizeRoles(['admin']); //solo tiene acceso los que tiene ese rol
        $roles = DB::select('select * from roles');
        $gimnasios = DB::select('select * from gimnasio');

        //dd($roles);
        return view('admin.listarusuarios',compact('roles','gimnasios'));
    }

    public function selectdata(Request $request){
        //dd($ex->getMessage());
        try { 
            $users = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,r.name,case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
            GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
            from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
             left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
             group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.sexo,u.email,u.telefono,u.fechaNac,r.name");

            $data = array(
                'data' => $users
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los usuarios",$ex->getMessage()];//500;
        }
        //return ["code"=>200, "msg"=>"Se ha mostrado los usuarios correctamente"];//200;

        //$insert="insert into tabla (id,a) values('".$request->id."','".$a."')";
    }

    public function insertdata(Request $request){
        //debug de lo que viene en el formulario
        //dd($request->all());
        $gym_list=$request->gimnasio_id;//explode(",",$request->gimnasio_id);
        //return ["code"=>500, "msg"=>$request->gimnasio_id];//500;
        DB::beginTransaction();
        try { 
            DB::insert('insert into usuarios (nombre, apellidos, dni, usersname, sexo, email, telefono, fechaNac,password) 
            values (?,?,?,?,?,?,?,?,?) ' ,[$request->nombre,$request->apellidos,$request->dni,$request->usersname,
            $request->sexo,$request->email,$request->telefono,$request->fechaNac,bcrypt($request->dni)]);


        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el usuario"];//500;
        }

        //obtenemos el id del ultimo user insertado por un identificador, en este caso el dni
        try{

            $usuario = DB::select("select id from usuarios where dni='".$request->dni."'");
            $user_id=$usuario[0]->id;//["id"];
        }catch(\Illuminate\Database\QueryException $ex){
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al obtener el usuario creado."];//500;
    
        }

        try { 
            DB::insert('insert into role_user (user_id, role_id) 
            values (?,?) ' ,[$user_id,$request->role_id]);

        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el rol del usuario"];//500;
        }


        foreach($gym_list as $g){
            try { 
                DB::insert('insert into usuario_gimnasio (gimnasio_id, usuarios_id) 
                values (?,?) ' ,[$g,$user_id]);
    
            } catch(\Illuminate\Database\QueryException $ex){ 
                DB::rollback();
                return ["code"=>500, "msg"=>"Se ha producido un error al asignar el gimnasio al usuario"];//500;
            }
        }

       
        DB::commit();
        //Session::flash('success','Se ha introducido el ususario correctamente');//sweetalert js
        return ["code"=>200, "msg"=>"Se ha introducido el usuario correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedata(Request $request){


        try { 
            DB::delete('delete from usuarios where id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); //debug del msg de error
            //deberias enviar un msg de error en el caso, flash dura un request, osea solo tiene como vida la sigueite redireccion
            //session::put() tiene como vida hasta que se acabe el inicio de sesion. La sessiones estas son como variables globales para
            //compartir datos entre diferentes vistas y controladores en su llamada
            //las recuperamos con session::get()
            //session::forget() elimina de la cache esa variable
            //Session::flash('error','Se ha producido un error al borrar el usuario');//sweetalert js
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el usuario"];//500;

            //te devuelve a la pagina anterior y ya se mostraria el msg

            //return $ex->getMessage();
            //return 500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado el usuario correctamente"];//200;

        //Session::flash('success','Se ha borrado el usuario correctamente');//sweetalert js
        //return 200;

    }

     public function getEditarData(Request $request){
        $userData = DB::select('select u.*, r.id as id_role from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id where u.id='.$request->id);
        //DB::find($request->id);
        $gymData = DB::select('select ug.*,g.* from usuario_gimnasio as ug inner join gimnasio as g on g.gimnasio_id=ug.gimnasio_id where ug.usuarios_id='.$request->id);

        return json_encode([$userData,$gymData]);
        //return view('admin.listarsocios',compact('userData','id'));
    }

    public function updatedata(Request $request)
    {
        //
        //$userData->save();
        //DB::update('update users set nombe = '.$request->nombre.' where id = ?', [$request->id]);
        $gym_list=$request->gimnasio_id;//explode(",",$request->gimnasio_id);
        DB::beginTransaction();
        try {
            DB::update('update usuarios set nombre = ? where id = ?', [$request->nombre,$request->id]);
            DB::update('update usuarios set apellidos = ? where id = ?', [$request->apellidos,$request->id]);
            DB::update('update usuarios set dni = ? where id = ?', [$request->dni,$request->id]);
            DB::update('update usuarios set sexo = ? where id = ?', [$request->sexo,$request->id]);
            DB::update('update usuarios set email = ? where id = ?', [$request->email,$request->id]);
            DB::update('update usuarios set telefono = ? where id = ?', [$request->telefono,$request->id]);
            DB::update('update usuarios set fechaNac = ? where id = ?', [$request->fechaNac,$request->id]);
            DB::update('update usuarios set usersname = ? where id = ?', [$request->usersname,$request->id]);
            //$results = DB::update( DB::raw("update usuarios set nombre='jaja' WHERE id = ".$request->id) );         
        }catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el usuario ".$ex->getMessage()];//500;
        }

        try {
            
            DB::update('update role_user set role_id = ? where user_id = ? ',  [$request->role_id,$request->id]);
                        
        }catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
                //te devuelve a la pagina anterior y ya se mostraria el msg
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el rol al usuario ".$ex->getMessage()];//500;

        }

        
        $gimnasio_lista = implode(",", $gym_list);
        //delete 
        try { 
            DB::delete('delete from usuario_gimnasio where usuario_gimnasio_id in (
                select usuario_gimnasio_id from usuario_gimnasio where usuarios_id='.$request->id.' and gimnasio_id 
                not in ('.$gimnasio_lista.') )');

        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el gimnasio del usuario ".$ex->getMessage()];//500;          
        }

        //insert
        
        try { 
            DB::insert('insert into usuario_gimnasio (usuarios_id,gimnasio_id) 
                select ' .$request->id. ' as user, g.gimnasio_id
                from gimnasio as g where g.gimnasio_id not in (
                    select usuarios_id from usuario_gimnasio where usuarios_id = '.$request->id.')
                and g.gimnasio_id in ('.$gimnasio_lista. ')
            ');

        } catch(\Illuminate\Database\QueryException $ex){ 
            
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al añadir el gimnasio al usuario ".$ex->getMessage()];//500;          
        }

        DB::commit();

        return ["code"=>200, "msg"=>"Se ha actualizado el usuario correctamente"];//200;

        //return json_encode(array('statusCode'=>200));
      
    }

}
