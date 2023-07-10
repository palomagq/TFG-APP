@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Gimnasios</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Localidad</th>
                                            <th>Provincia</th>
                                            <th>Código Postal</th>
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
            <h1>Añadir Gimnasio</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdatagimnasio')}}" name="createGimnasio" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="direccion"><b>Dirección</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Dirección" name="direccion" id="direccion"  required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="localidad"><b>Localidad</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Localidad" name="localidad" id="localidad" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="provincia"><b>Provincia</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Provincia" name="provincia" id="provincia" required>   
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="codigo_postal"><b>Código Postal</b></label>
                            <input class="form-control form-control-border border-width-2" type="number" placeholder="Código Postal" name="codigo_postal" id="codigo_postal" required>   
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
        <h1>Actualizar Gimnasio</h1>
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
                        <label style="font-size:13px" for="direccion"><b>Dirección</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Apellidos" name="direccion" id="direccionEditar"  disabled>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="localidad"><b>Localidad</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Localidad" name="localidad" id="localidadEditar" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="provincia"><b>Provincia</b></label>
                         <input class="form-control form-control-border border-width-2" type="text" placeholder="Provincia" name="provincia" id="provinciaEditar" required>
                    </div> 
                    <div class="form-group">
                        <label style="font-size:13px" for="codigo_postal"><b>Código Postal</b></label>
                        <input class="form-control form-control-border border-width-2" type="number" placeholder="Código Postal" name="codigo_postal" id="codigo_postalEditar" required>   
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
            <h1>Eliminar Gimnasio</h1>
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
        /*$(".js-example-basic-single").select2({
        width: 'resolve' // need to override the changed default
        //dropdownParent: $("#createModal")
        });*/
       /* $("#id_label_single").select2({
            dropdownParent: $("#createModal")
            //placeholder: 'Seleccione una opción'
            
        });*/

        /*$("#id_label_single").select2({
            dropdownParent: $("#createModal"),
                placeholder: "Select an option",
                allowClear: true,
                width: '50%'
         });*/



         
        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
             //$('#table_id').DataTable();
            ajax: {
                url: "{{route('selectdatagimnasio')}}",//'php/identidades.php',
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },                          
            },
            responsive: true,

            columns: [{ data: "nombre" }, { data: "direccion" }, { data: "localidad" }, { data: "provincia" }, { data: "codigo_postal" }],
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
            if(data['gimnasio_id']==undefined)
                data['gimnasio_id']="-1"
            datatable.row(this).index
            //console.log( datatable.row(this).hasClass('testCVs'));
             //console.log(data)
            //alert('You clicked on ' + data["id"] + "'s row");
            $.ajax({
                url: "{{route('getEditarDatagimnasio')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["gimnasio_id"]
                },
                success: function(dataResult){
                    console.log(dataResult)
                    //console.log(dataResult[0])
                    dataJson=JSON.parse(dataResult)
                    document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                    document.getElementById('direccionEditar').value=dataJson[0]["direccion"];
                    document.getElementById('localidadEditar').value=dataJson[0]["localidad"];
                    document.getElementById('provinciaEditar').value=dataJson[0]["provincia"];
                    document.getElementById('codigo_postalEditar').value=dataJson[0]["codigo_postal"];

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
                url: "{{route('deletedatagimnasio')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["gimnasio_id"]

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
            $.ajax({
                url: "{{route('insertdatagimnasio')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $("#nombre").val(),
                    direccion: $("#direccion").val(),
                    localidad: $("#localidad").val(),  
                    provincia: $("#provincia").val(),
                    codigo_postal: $("#codigo_postal").val()
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
        }); 

        //updatedata
        $("#updateDataButton").click(function(){
            console.log(data)
            $.ajax({
                url: "{{route('updatedatagimnasio')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),
                    direccion: $('#direccionEditar').val(),
                    localidad: $('#localidadEditar').val(),
                    provincia: $('#provinciaEditar').val(),
                    codigo_postal: $('#codigo_postalEditar').val(),
                    id: data["gimnasio_id"]

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

    });

    
</script>

@endsection