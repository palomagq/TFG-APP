@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Salas</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Capacidad</th>
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


@if((Session('idRole') == 1 ) || (Session('idRole') == 2 )  || (Session('idRole') == 3 ))

    <div>
        <div class="floating-container">
            <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal">
                +
            </div>
        </div> 
    </div>

@else
    <div  style="display: none">
        <div class="floating-container">
            <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal">
                +
            </div>
        </div>
    </div>

@endif 


@endsection



@section('modal')

 <!-- Modal  Create-->
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 650px">
            <div class="modal-header">
            <h1>Añadir Nueva Sala</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdataSala')}}" name="createSala" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="capacidad"><b>Capacidad</b></label>
                            <input class="form-control form-control-border border-width-2" type="number" placeholder="Capacidad" name="capacidad" id="capacidad"  required>
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
        <h1>Actualizar datos de la Sala</h1>
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
                        <label style="font-size:13px" for="capacidad"><b>Capacidad</b></label>
                        <input class="form-control form-control-border border-width-2" type="number" placeholder="Apellidos" name="capacidad" id="capacidadEditar"  disabled>
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
            <h1>Eliminar Sala</h1>
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
            ajax: {
                url: "{{route('selectdataSala')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "id_gimnasio": function() { 
                        console.log($('#id_gimnasio_selected_calendario').val());
                        return $('#id_gimnasio_selected_calendario').val() 
                    },
                },                          
            },
            responsive: true,

            columns: [{ data: "nombre" }, { data: "capacidad" }, { data: "nombregimnasio_localidad" }],
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

        //edit data
        @if((Session('idRole') != 5) && (Session('idRole') != 4) )
            var data = null
            $('#table_id tbody').on('click', 'tr', function () {
                data = datatable.row(this).data();
                datatable.row(this).index
                
                $.ajax({
                    url: "{{route('getEditarDataSala')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: data["id"]
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        dataJson=JSON.parse(dataResult)
                        document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                        document.getElementById('capacidadEditar').value=dataJson[0]["capacidad"];
                        $("#id_gimnasio_selected_update").val(dataJson[0]["gimnasio_id"]) 

                        $('#updateModal').modal('show');
                        
                    },
                    error: function(e){
                        console.log(e)
                    }
                });
            });

                //updatedata
                $("#updateDataButton").click(function(){
                $.ajax({
                    url: "{{route('updatedataSala')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        nombre: $('#nombreEditar').val(),
                        capacidad: $('#capacidadEditar').val(),
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
        @endif

        //deletedata
        $("#DeleteDataButton").click(function(){
            $.ajax({
                url: "{{route('deletedataSala')}}",
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
            $.ajax({
                url: "{{route('insertdataSala')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $("#nombre").val(),
                    capacidad: $("#capacidad").val(),
                    nombregimnasio_localidad: $("#id_gimnasio_selected").val(),

                    //dni: $("#dni").val(),
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

  



    //hace el rellamado y filtro del gimnasio para el admin->listener
    $('#id_gimnasio_selected_calendario').on('change', function() {
            console.log("reload")
        datatable.ajax.reload();
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