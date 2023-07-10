@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado del Personal</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>DNI</th>
                                            <th>Username</th>
                                            <th>Sexo</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Fecha nacimiento</th>
                                            <th>Gimnasio</th>
                                          </tr>
                                          
                                    </thead>
                                </table> 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div>

    <div class="floating-container">
        <div class="floating-button btn btn-success" type="button" data-toggle="modal" data-target="#createModal">
            +
        </div>
    </div>  
</div>


@endsection



@section('modal')

 <!-- Modal  Create-->
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 650px">
            <div class="modal-header">
            <h1>Añadir Nuevo Personal</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdataPersonal')}}" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="apellidos"><b>Apellidos</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Apellidos" name="apellidos" id="apellidos"  required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="email"><b>Email</b></label>
                            <input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px;" for="gimnasio"class="col-md-6"><b>Gimnasio</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_gimnasio_selected" required>
                                        <option value=""></option>
                                        @foreach($gimnasios as $g)
                                            <option  value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                        @endforeach       
                                </select>
                        </div>
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" for="dni" class="col-md-6"><b>DNI</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="DNI" name="dni" id="dni" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" for="sexo"class="col-md-6"><b>Sexo</b></label>
                                    <!--<input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Sexo" name="sexo" id="sexo" required>-->
                                        <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_selected_sexo" name="id_selected_sexo"required>
                                           <!-- <optgroup label="Sexo">-->
                                            <option value=""></option>
                                            <option value="0">Mujer</option>
                                            <option value="1">Hombre</option>
                                            <!--</optgroup>-->
                                        </select>
                                    
                                </div>
                            </div>                          
                        </div>

                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" for="telefono" class="col-md-6"><b>Teléfono</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Teléfono" name="telefono" id="telefono" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;
                                    text-align: center;
                                    margin-bottom: unset;" for="fechaNac" class="col-md-6"><b>Fecha nacimiento</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-6"  type="date" placeholder="Fecha nacimiento" name="fechaNac" id="fechaNac" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" for="usersname" class="col-md-6"><b>Username</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="Username" name="usersname" id="usersname" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;
                                    text-align: center;
                                    margin-bottom: unset;" for="password" class="col-md-6">Password</label>
                                    <input  class="form-control form-control-border border-width-2 col-md-6" type="password"  id="password" placeholder="Password" required />
                                </div>
                            </div>
                        </div>
                     
                   </div>
                   <hr>
                    <div class="card-footer" style="background-color: white; padding: 0;">
                        <button type="button" class="btn btn-secondary float-left" id="insertDataButtonClose" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary float-right" id="insertDataButton">Aceptar</button>
                    </div>
              
                </form>
                          
            </div>
        </div>
    </div>
</div>



 <!-- Modal  Update-->
 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h1>Actualizar datos de Personal</h1>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" style=" margin-top: -2em;">
        
            <form method="POST"> 
                @csrf
                <hr>
                <div class="card-body" style="padding: 0;">
                    <div class="form-group">
                        <label style="font-size:13px" for="nombre"><b>Nombre</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombreEditar" disabled>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="apellidos"><b>Apellidos</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Apellidos" name="apellidos" id="apellidosEditar"  disabled>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="email"><b>Email</b></label>
                        <input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="email" id="emailEditar" required>
                    </div>
                    <div class="form-group">
                           
                        <label style="font-size:13px" for="usersname"><b>Username</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Username" name="usersname" id="usersnameEditar" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px;" for="gimnasio"class="col-md-6"><b>Gimnasio</b></label>
                        <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_gimnasio_selected_update" required>
                                <option value=""></option>
                                @foreach($gimnasios as $g)
                                    <option  value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                @endforeach       
                        </select>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset; " for="dni" class="col-md-6"><b>DNI</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="DNI" name="dni" id="dniEditar" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset; " for="sexo"class="col-md-6"><b>Sexo</b></label>
                                <!--<input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Sexo" name="sexo" id="sexoEditar" disabled>-->
                                <select class="js-example-disabled js-states form-control col-md-6" id="id_selected_sexo_update" name="id_selected_sexo_update" disabled>
                                            <!-- <optgroup label="Sexo">-->
                                                <option value=""></option>
                                                <option value="0">Mujer</option>
                                                <option value="1">Hombre</option>
                                            <!--</optgroup>-->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset; " for="telefono" class="col-md-6"><b>Teléfono</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Teléfono" name="telefono" id="telefonoEditar" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset; " for="fechaNac" class="col-md-6"><b>Fecha nacimiento</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6"  type="date" placeholder="Fecha nacimiento" name="fechaNac" id="fechaNacEditar" disabled>
                            </div>
                        </div>
                    </div>
           
               </div>

                <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                                         
                    <button type="button" class="btn btn-danger float-left"  id="" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>             
                    <button type="button"   id="updateDataButton" class="btn btn-primary float-right" >Aceptar</button>
                    <button type="button" class="btn btn-secondary float-right  mr-1"  id="UpdateDataButtonClose" data-bs-dismiss="modal">Cancelar</button>

                
                </div>
              
              </form>

            </div>
        </div>
    </div>
</div>


 <!-- Modal  Delete-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1>Eliminar Personal</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div class="modal-body" style="margin-top:-2em">
        
            <form method="POST"> <!--method="POST" -->
                @csrf
                <hr>
                <div class="container" >
                  <div class="form-group">
                    <p>¿Deseas eliminar el registro?</p> 
                  </div>                     
              
                </div>
               <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                    <button type="button"  class="btn btn-secondary float-left"  id="DeleteDataButtonClose" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button"  id="DeleteDataButton" class="btn btn-primary float-right">Aceptar</button>
                </div>
              
              </form>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')

<script>

    $(document).ready( function () {
 
         
        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
             //$('#table_id').DataTable();
            ajax: {
                url: "{{route('selectdataPersonal')}}",//'php/identidades.php',
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },                          
            },
            responsive: true,

            columns: [{ data: "nombre" }, { data: "apellidos" }, { data: "dni" }, { data: "usersname" }, { data: "sexo_nombre" },{ data: "email" },{ data: "telefono" },{ data: "fechaNac", render: DataTable.render.datetime( 'D/M/YYYY' ) }, { data: "nombregimnasio_localidad" }]
        });

        //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
        $('#table_id tbody').on('click', 'td.dtr-control', function (e) {

            //me cojo la row del td al que he dado click
            var tr = $(this).closest('tr');
            //cojo la row del datatable para ver si se ha mostrado
            var row = datatable.row(tr);

            //de la row al que he dado click, comprueba si tiene la clase, 
            //si es el casoes que no estaba abierto y paro la propagacion del modal
            //o en el caso de que este ya abierto comprobamos con el datatable 
            if (//tr.hasClass('dt-hasChild') || !row.child.isShown()
                //datatable te da una funcion que te dice si el responsive esta activado o no
                datatable.responsive.hasHidden() ) {
                //no muestres el modal
                e.stopPropagation();
            } 
        } );

        var data = null
        $('#table_id tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index

            $.ajax({
                url: "{{route('getEditarDataPersonal')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"]
                },
                success: function(dataResult){
                    console.log(dataResult)
                    //console.log(dataResult[0])
                    dataJson=JSON.parse(dataResult)
                    document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                    document.getElementById('apellidosEditar').value=dataJson[0]["apellidos"];
                    document.getElementById('dniEditar').value=dataJson[0]["dni"];
                    //document.getElementById('#id_selected_sexo_update').value=dataJson[0]["sexo"];
                    $("#id_selected_sexo_update").val(dataJson[0]["sexo"])  
                    document.getElementById('emailEditar').value=dataJson[0]["email"];
                    document.getElementById('telefonoEditar').value=dataJson[0]["telefono"];
                    document.getElementById('fechaNacEditar').value=dataJson[0]["fechaNac"];
                    document.getElementById('usersnameEditar').value=dataJson[0]["usersname"];
                    $("#id_gimnasio_selected_update").val(dataJson[0]["gimnasio_id"]);

                    $('#updateModal').modal('show');

                },
                error: function(e){
                    console.log(e)
                }
            });
        });


        //deletedata
        $("#DeleteDataButton").click(function(){
            $.ajax({
                url: "{{route('deletedataPersonal')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"]

                },
                success: function(dataResult){
                    //console.log(dataResult)

                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#DeleteDataButtonClose').click();
                        $('#UpdateDataButtonClose').click();
                        datatable.ajax.reload();
                    }else{
                        msgError(dataResult["msg"])
                    }
                  
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        }); 

        

        //insertdata
        $("#insertDataButton").click(function(){
            //console.log($("#id_gimnasio_selected").val())

            let fecha = $('#fechaNac').val();
            let fechaNacimiento = new Date(fecha);
            let dia = fechaNacimiento.getDate() + 1;
            let mes = fechaNacimiento.getMonth() + 1;
            let ano = fechaNacimiento.getFullYear();

            let edad = obtenerEdad(dia, mes, ano);

            let mayorEdad = esMayorEdad(edad);

            if (mayorEdad) {
                $.ajax({
                    url: "{{route('insertdataPersonal')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        nombre: $("#nombre").val(),
                        apellidos: $("#apellidos").val(),
                        dni: $("#dni").val(),
                        sexo: $("#id_selected_sexo").val(),
                        email: $("#email").val(),
                        telefono: $("#telefono").val(),
                        fechaNac: $("#fechaNac").val(),
                        usersname: $("#usersname").val(),
                        password: $("#password").val(),
                        nombregimnasio_localidad: $("#id_gimnasio_selected").val(),
                    },
                    success: function(dataResult){
                        //console.log(dataResult)
                        if(dataResult["code"]==200){
                            msgSuccess(dataResult["msg"])
                            $('#insertDataButtonClose').click();
                            datatable.ajax.reload();
                        }else{
                            msgError(dataResult["msg"])
                        }

                    },
                    error: function(e){
                        console.log(e)
                        msgError("Error genérico. Por favor, inténtelo más tarde.")
                    }
                });
            } else {
                msgError("No se puede completar el registro por ser menor de edad")
            }
        }); 

        //updatedata
        $("#updateDataButton").click(function(){
            $.ajax({
                url: "{{route('updatedataPersonal')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),
                    apellidos: $('#apellidosEditar').val(),
                    dni: $('#dniEditar').val(),
                    usersname: $('#usersnameEditar').val(),
                    sexo: $('#id_selected_sexo_update').val(),
                    email: $('#emailEditar').val(),
                    telefono: $('#telefonoEditar').val(),
                    fechaNac: $('#fechaNacEditar').val(),
                    nombregimnasio_localidad: $("#id_gimnasio_selected_update").val(),
                    id: data["id"]

                },
               // $(".js-example-disabled").select2();

                success: function(dataResult){
                    //console.log(dataResult)
                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#UpdateDataButtonClose').click();
                        datatable.ajax.reload();
                    }else{
                        msgError(dataResult["msg"])
                    }         
                
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        }); 






        /*para el caso en el que no insertemos ni nada por ajax, por ejemplo un post de un formulario que devuelve el action*/
        @if(Session::has('success'))
           /* Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::has("success")}}',
                showConfirmButton: false,
                timer: 0
            });*/
        @endif

        @if(Session::has('error'))
            /*Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::has("error")}}',
                showConfirmButton: false,
                timer: 0
            });*/
        @endif
        let obtenerEdad = (dia, mes, ano) => {
        //let evento = new Date(2018, 1, 14);
        let evento = new Date();
        let eventoAno = evento.getFullYear();
        let eventoMes = evento.getMonth() + 1;
        let eventoDia = evento.getDate();

        let edad = eventoAno - ano;

        if (eventoAno - ano < 18) {
            //
        } else {
            if (eventoMes < mes) {
                edad--;
            }
            if (mes == eventoMes && eventoDia < dia) {
                edad--;
            }
        }
        return edad;
    }

    let esMayorEdad = (edad) => {
        if (edad >= 18) {
            return true;
        } else {
            return false;
        }
    }
    
    });

    
</script>

@endsection