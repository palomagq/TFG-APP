<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class PersonalController extends Controller
{
    // 
    public function admin(Request $request){
        Session::flash('active','Personal');

       $request->user()->authorizeRoles(['admin','personal','jefe','recepción']);
       $gimnasios = DB::select('select * from gimnasio');

        
       return view('admin.listarpersonal',compact('gimnasios'));
    }

    public function selectdataPersonal(Request $request){
        $id_gimnasio=$request->id_gimnasio;

        try{

            if((Session('idRole') == 2) || (Session('idRole') == 3)){
                $personal = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Personal' and g.gimnasio_id=".Session('id_gimnasio'). "
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");

            }else if((Session('idRole') == 1) && ($id_gimnasio != "")){
                $personal = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Personal' and g.gimnasio_id=".$id_gimnasio. "
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");

            }else{
                $personal = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Personal'
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");
            }

            /*if($id_gimnasio==""){
                $personal = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Personal'
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");
            }else{
                $personal = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Personal' and g.gimnasio_id=".$id_gimnasio. "
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");
            }*/

            $data = array(
                'data' => $personal
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){            
            //dd($ex->getMessage());
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar el personal ".$ex->getMessage()];//500;          
        }
    }

    public function insertdataPersonal(Request $request){
        //debug de lo que viene en el formulario
        //dd($request->all());

       /* try { 
            DB::insert('insert into usuarios (nombre, apellidos, dni, usersname, sexo, email, telefono, fechaNac,password) 
            values (?,?,?,?,?,?,?,?,?) ' ,[$request->nombre,$request->apellidos,$request->dni,$request->usersname,
            $request->sexo,$request->email,$request->telefono,$request->fechaNac,bcrypt($request->password)]);

        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); //debug del msg de error

            return ["code"=>500, "msg"=>"Se ha producido un error al crear el personal".$ex->getMessage()];//500;
            //return back();
        }
        
        //Session::flash('success','Se ha introducido el ususario correctamente');//sweetalert js
        return ["code"=>200, "msg"=>"Se ha introducido el personal correctamente"];//200;
        //return view('admin.listarsocios');*/
        DB::beginTransaction();
        try { 
            DB::insert('insert into usuarios (nombre, apellidos, dni, usersname, sexo, email, telefono, fechaNac,password) 
            values (?,?,?,?,?,?,?,?,?) ' ,[$request->nombre,$request->apellidos,$request->dni,$request->usersname,
            $request->sexo,$request->email,$request->telefono,$request->fechaNac,bcrypt($request->password)]);


        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el personal".$ex->getMessage()];//500;
        }

        //obtenemos el id del ultimo user insertado por un identificador, en este caso el dni
        try{

            $usuario = DB::select("select id from usuarios where dni='".$request->dni."' ");
             $gimnasio = DB::select("select gimnasio_id from gimnasio where gimnasio_id='".$request->nombregimnasio_localidad."'");
            $user_id=$usuario[0]->id;//["id"];
            $gimnasio_id=$gimnasio[0]->gimnasio_id;//["id"];

        }catch(\Illuminate\Database\QueryException $ex){
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al obtener el personal creado.".$ex->getMessage()];//500;
    
        }

        try { 
            DB::insert('insert into role_user (user_id, role_id) 
            values (?,?) ' ,[$user_id,4]);

        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el rol del usuario".$ex->getMessage()];//500;
        }

        //foreach($gym_list as $g){
            try { 
                DB::insert('insert into usuario_gimnasio (gimnasio_id, usuarios_id) 
                values (?,?) ' ,[$gimnasio_id,$user_id]);
    
            } catch(\Illuminate\Database\QueryException $ex){ 
                DB::rollback();
                return ["code"=>500, "msg"=>"Se ha producido un error al asignar el gimnasio al personal".$ex->getMessage()];//500;
            }
       // }

       
        DB::commit();
        //Session::flash('success','Se ha introducido el ususario correctamente');//sweetalert js
        return ["code"=>200, "msg"=>"Se ha introducido el usuario correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataPersonal(Request $request){


        try { 
            DB::delete('delete from usuarios where id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); //debug del msg de error
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el personal"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado el personal correctamente"];//200;

        //Session::flash('success','Se ha borrado el usuario correctamente');//sweetalert js
        //return 200;

    }

     public function getEditarDataPersonal(Request $request){
        $userData = DB::select('select * from usuarios where id='.$request->id);
        return json_encode($userData);
    }

    public function updatedataPersonal(Request $request)
    {
        //
        //$userData->save();
        //DB::update('update users set nombe = '.$request->nombre.' where id = ?', [$request->id]);
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
                //dd($ex->getMessage()); //debug del msg de error
    
                return $ex->getMessage();
                //return 500;
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el personal"];//500;

            }
    
        //Session::flash('success','Se ha modificado el usuario correctamente');//sweetalert js
        //return 200;
        return ["code"=>200, "msg"=>"Se ha actualizado el personal correctamente"];//200;

        //return json_encode(array('statusCode'=>200));
      
    }

}
