@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Clases Matriculadas</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Gimnasio</th>
                                            <th>Nombre Clase</th>
                                            <th>Nombre Sala</th>
                                            <th>Fecha Clase</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Fecha Registro</th>
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


<!--<div>

    <div class="floating-container">
        <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal">
            +
        </div>
    </div>  
</div>-->


@endsection



@section('modal')

 <!-- Modal  Update-->

<!-- <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h1>Datos de la Clase Matriculada</h1>
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
</div>-->

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 id="modalTitle">Datos de la Clase Matriculada</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div  id="modalBody" class="modal-body" style="margin-top:-2em">
        
            <form id="addClassForm" method="POST"> <!--method="POST" -->
                @csrf
                <hr>
                <div class="container" >
                    <input type="hidden" id="clase_planificada_id">
                    <div class="form-group">
                        <label style="font-size:13px" for="listado_gimnasio"><b>Nombre Gimnasio</b></label>

                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_gimnasio_update" disabled>
                                    <option value=""></option>
                                    @foreach($gimnasios as $g)
                                        <option value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                    @endforeach                                        
                            </select>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px"  id="listado_salas" for="listado_salas"><b>Nombre Sala</b></label>
                                <!--<input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="rol-usuario" id="rol-usuario" required>-->
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_salas_update" disabled>
                                        <option value=""></option>   
                                        @foreach($salas as $s)
                                            <option value="{{$s->sala_id}}">{{$s->nombre}}</option>
                                        @endforeach                                                                      
                                </select>            
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px"  id="listado_clases" for="listado_clases"><b>Nombre Clase</b></label>
                                <!--<input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="rol-usuario" id="rol-usuario" required>-->
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;" id="id_label_clases_update" disabled>
                                        <option value=""></option> 
                                        @foreach($clases as $c)
                                            <option value="{{$c->clases_id}}">{{$c->nombre}}</option>
                                        @endforeach                                       
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label style="font-size:13px" for="fecha_clase"><b>Fecha de la Clase</b></label>
                            <input class="form-control form-control-border border-width-2" type="date" placeholder="Fecha de la Clase" name="fecha_claseEditar" id="fecha_claseEditar"  disabled>
                        </div>
    
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_inicio" class="col-md-6"><b>Hora Inicio</b></label>
                                    <input class="form-control form-control-border border-width-2" type="time"  placeholder="Hora Inicio" name="hora_inicioEditar" id="hora_inicioEditar"  disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_fin" class="col-md-6"><b>Hora Fin</b></label>
                                    <input class="form-control form-control-border border-width-2" style="margin-left: 0.4em;" type="time" placeholder="Hora Fin" name="hora_finEditar" id="hora_finEditar" disabled>
                                </div>
                            </div>
                        </div>
                                                       
                    </div>
                                       
              
                </div>
               <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                    <button type="button" class="btn btn-danger float-left"  id="" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>             
                    <!--<button type="button"   id="updateDataButton" class="btn btn-primary float-right" >Aceptar</button>-->
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
            <h1>Eliminar Clase Matriculada</h1>
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
                url: "{{route('selectdataClaseMatriculadaGETDATA')}}",
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

            columns: [{ data: "nombregimnasio_localidad" }, { data: "nombre_clase" }, { data: "nombre_sala" }, { data: "fecha_clase", render: DataTable.render.datetime( 'D/M/YYYY' ) },{ data: "hora_inicio" },{ data: "hora_fin" },{data:"fecha_registro"} ],
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

        var data = null  
        $('#table_id tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index

            $.ajax({
                url: "{{route('getEditarDataClaseMatriculada')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["clase_planificada_id"]
                },
                success: function(dataResult){
                    console.log(dataResult)
                    dataJson=JSON.parse(dataResult)

                    //console.log(dataResult[0])
                    $("#id_label_gimnasio_update").val(dataJson[0]["gimnasio_id"]);     
                            actualizarDatos(dataJson[0]["gimnasio_id"],dataJson[0]["sala_id"],dataJson[0]["clases_id"]);                  
                            document.getElementById('fecha_claseEditar').value=dataJson[0]["fecha_clase"];
                            document.getElementById('hora_inicioEditar').value=dataJson[0]["hora_inicio"];
                            document.getElementById('hora_finEditar').value=dataJson[0]["hora_fin"];
                            document.getElementById("clase_planificada_id").value=dataJson[0]["capacidad_clase_id"];
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
                url: "{{route('deletedataClaseMatriculada')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: document.getElementById("clase_planificada_id").value

                },
                success: function(dataResult){
                    console.log(dataResult)

                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#DeleteDataButtonClose').click();
                        //$('#UpdateDataButtonClose').click();
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

        
        function actualizarDatos(gym,sala,clase){
            $.ajax({
                url: "{{route('getEditarDataGimnasioSalaClaseMonitores')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    //id de la sala seleccionada
                    id: gym,
                },

                success: function(dataResult){
                    //borrado previo de lo anterior

                    $('#id_label_salas_update option').each(function() {
                        $(this).remove();
                    });

                    $('#id_label_clases_update option').each(function() {
                        $(this).remove();
                    });

                  

                    //rellenar el select con los datos de las salas que me da el controlador (dataresult)
                    dataJson=JSON.parse(dataResult)

                    $('#id_label_salas_update').append('<option value=""></option>');
                    for (var index = 0; index < dataJson[0].length; index++) {
                        $('#id_label_salas_update').append('<option value="' + dataJson[0][index].sala_id + '">' + dataJson[0][index].nombre + '</option>');
                    }

                    //display block del select
                    $("#listado_salas_update").css("display", "block");   
                    //$("#id_label_salas_update").css("display", "block");        
                   
                    //rellenar el select con los datos de las clases que me da el controlador (dataresult)

                    $('#id_label_clases_update').append('<option value=""></option>');   
                    for (var index = 0; index < dataJson[1].length; index++) {
                        $('#id_label_clases_update').append('<option value="' + dataJson[1][index].clases_id + '">' + dataJson[1][index].nombre + '</option>');
                    }                   
                     //display block del select            
                    $("#listado_clases_update").css("display", "block");   
                    //$("#id_label_clases_update").css("display", "block"); 
                               
                    
                    $("#id_label_salas_update").val(sala);                   
                    $("#id_label_clases_update").val(clase); 
   
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        }

        //hace el rellamado y filtro del gimnasio para el admin->listener
        $('#id_gimnasio_selected_calendario').on('change', function() {
            console.log("reload")
            datatable.ajax.reload();
        });

       
});
</script>

@endsection