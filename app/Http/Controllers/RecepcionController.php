<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Session;

class RecepcionController extends Controller
{
    // 
    public function admin(Request $request){
        Session::flash('active','Recepcion');

        $request->user()->authorizeRoles(['admin','personal','jefe','recepción']);
        $gimnasios = DB::select('select * from gimnasio');

       return view('admin.listarrecepcion',compact('gimnasios'));
    }

    public function selectdataRecepcion(Request $request){
        $id_gimnasio=$request->id_gimnasio;

        try{
            if($id_gimnasio==""){
                $recepcion = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Recepción'
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");
            }else{
                $recepcion = DB::select("select u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,
                case when u.sexo=0 then 'Mujer' else 'Hombre' end as sexo_nombre,
                GROUP_CONCAT(DISTINCT concat(g.nombre,' ( ', g.localidad,' ) ') SEPARATOR ' - ') as nombregimnasio_localidad 
                from usuarios as u left join role_user as ru on u.id=ru.user_id left join roles as r on ru.role_id=r.id
                left join usuario_gimnasio as ug on u.id=ug.usuarios_id left join gimnasio as g on ug.gimnasio_id=g.gimnasio_id
                where r.name='Recepción' and g.gimnasio_id=".$id_gimnasio. "
                group by u.id,u.nombre,u.apellidos,u.dni,u.usersname,u.email,u.telefono,u.fechaNac,u.sexo");
            }
            $data = array(
                'data' => $recepcion
                
            );

            echo json_encode($data);
        } catch(\Illuminate\Database\QueryException $ex){            
            //dd($ex->getMessage());
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar el recepcionista ".$ex->getMessage()];//500;          
        }
    }

    public function insertdataRecepcion(Request $request){
        /*try { 
            DB::insert('insert into usuarios (nombre, apellidos, dni, usersname, sexo, email, telefono, fechaNac,password) 
            values (?,?,?,?,?,?,?,?,?) ' ,[$request->nombre,$request->apellidos,$request->dni,$request->usersname,
            $request->sexo,$request->email,$request->telefono,$request->fechaNac,bcrypt($request->password)]);

        } catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el recepcionista"];//500;
        }
        
        return ["code"=>200, "msg"=>"Se ha introducido el recepcionista correctamente"];//200;*/

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
            return ["code"=>500, "msg"=>"Se ha producido un error al obtener el recepcionista creado.".$ex->getMessage()];//500;
    
        }

        try { 
            DB::insert('insert into role_user (user_id, role_id) 
            values (?,?) ' ,[$user_id,3]);

        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return ["code"=>500, "msg"=>"Se ha producido un error al crear el rol del usuario".$ex->getMessage()];//500;
        }

            try { 
                DB::insert('insert into usuario_gimnasio (gimnasio_id, usuarios_id) 
                values (?,?) ' ,[$gimnasio_id,$user_id]);
    
            } catch(\Illuminate\Database\QueryException $ex){ 
                DB::rollback();
                return ["code"=>500, "msg"=>"Se ha producido un error al asignar el gimnasio al recepcionista".$ex->getMessage()];//500;
            }

       
        DB::commit();
        //Session::flash('success','Se ha introducido el ususario correctamente');//sweetalert js
        return ["code"=>200, "msg"=>"Se ha introducido el usuario correctamente"];//200;
        //return view('admin.listarsocios');
    }

    public function deletedataRecepcion(Request $request){

        try { 
            DB::delete('delete from usuarios where id='.$request->id);
        } catch(\Illuminate\Database\QueryException $ex){ 
           
            return ["code"=>500, "msg"=>"Se ha producido un error al borrar el recepcionista"];//500;
        }
        return ["code"=>200, "msg"=>"Se ha borrado el recepcionista correctamente"];//200;
    }

     public function getEditarDataRecepcion(Request $request){
        $userData = DB::select('select * from usuarios where id='.$request->id);
        //DB::find($request->id);
        return json_encode($userData);
        //return view('admin.listarsocios',compact('userData','id'));
    }

    public function updatedataRecepcion(Request $request)
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
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el recepcionista"];//500;

            }
    
        //Session::flash('success','Se ha modificado el usuario correctamente');//sweetalert js
        //return 200;
        return ["code"=>200, "msg"=>"Se ha actualizado el recepcionista correctamente"];//200;

        //return json_encode(array('statusCode'=>200));
      
    }

}
