@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Clases en el Gimnasio</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Gimnasio</th>
                                            <th>Clase</th>
                                            <th>Sala</th>
                                            <th>Fecha</th>
                                            <th>Hora inicio</th>
                                            <th>Hora fin</th>
                                            <th>Monitor</th>
                                            <th>ID</th>

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
        <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal">
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
            <h1>Añadir Horario/Clase</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdataHorarioClase')}}" method="POST" > <!--onsubmit = "return validaedad(document.getElementById('fechanaci').value)"-->
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="listado_gimnasio"><b>Listado Gimnasio</b></label>

                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_gimnasio" required>
                                            <option value=""></option>
                                        @foreach($gimnasios as $g)
                                            <option value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                        @endforeach                                           
                                </select>
                        </div>

                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; display:none;" id="listado_salas" for="listado_salas"><b>Listado Salas</b></label>
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control" style=" display:none;" id="id_label_salas" required>
                                            <option value=""></option>                              
                                    </select>
                                    
                                </div>
                            </div>  
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; display:none;" id="listado_clases" for="listado_clases"><b>Listado Clases</b></label>
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;display:none;" id="id_label_clases" required>
                                            <option value=""></option>                            
                                    </select>
                                </div>
                            </div>
                                                    
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px; display:none;" id="listado_monitores" for="listado_monitores"><b>Listado Monitores</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;display:none;" id="id_label_monitores" required>
                                        <option value=""></option>                            
                                </select>
                        </div>

                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px" for="fecha_inicio_clase"><b>Fecha Inicio</b></label>
                            <input class="form-control form-control-border border-width-2" type="date" placeholder="Fecha Inicio de Clase" name="fecha_inicio_clase" id="fecha_inicio_clase"  required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px" for="fecha_fin_clase"><b>Fecha Fin </b></label>
                                    <input class="form-control form-control-border border-width-2" style="margin-left: 0.4em;" type="date" placeholder="Fecha Fin de Clase" name="fecha_fin_clase" id="fecha_fin_clase"  required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_inicio" class="col-md-6"><b>Hora Inicio</b></label>
                                    <input class="form-control form-control-border border-width-2" type="time" placeholder="Hora Inicio" name="hora_inicio" id="hora_inicio"  required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_fin" class="col-md-6"><b>Hora Fin</b></label>
                                    <input class="form-control form-control-border border-width-2" style="margin-left: 0.4em;" type="time" placeholder="Hora Fin" name="hora_fin" id="hora_fin" required>
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
    <div class="modal-content"  style="min-width: 650px">
        <div class="modal-header">
        <h1>Actualizar Horario/Clase</h1>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" style=" margin-top: -2em;">
        
            <form method="POST" id="updateModal" name="updateModal"> 
                @csrf
                <hr>
                <div class="card-body" style="padding: 0;">
                    <div class="form-group">
                        <label style="font-size:13px" for="listado_gimnasio"><b>Listado Gimnasio</b></label>

                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_gimnasio_update" required>
                                    <option value=""></option>
                                    @foreach($gimnasios as $g)
                                        <option value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                    @endforeach                                        
                            </select>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px"  id="listado_salas_update" for="listado_salas"><b>Listado Salas</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_salas_update" required>
                                        <option value=""></option>
                                                                           
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px"  id="listado_clases_update" for="listado_clases"><b>Listado Clases</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;" id="id_label_clases_update" required>
                                        <option value=""></option>                                      
                                </select>
                            </div>
                        </div>
                                                  
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px"  id="listado_monitores_update" for="listado_monitores"><b>Listado Monitores</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;" id="id_label_monitores_update" required>
                                        <option value=""></option>                                      
                                </select>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="fecha_claseEditar"><b>Fecha de la Clase</b></label>
                        <input class="form-control form-control-border border-width-2" type="date" placeholder="Fecha de la Clase" name="fecha_claseEditar" id="fecha_claseEditar"  required>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px;" for="hora_inicioEditar" class="col-md-6"><b>Hora Inicio</b></label>
                                <input class="form-control form-control-border border-width-2" type="time" onchange="getCheckTimeMin()"  placeholder="Hora Inicio" name="hora_inicioEditar" id="hora_inicioEditar"  required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px;" for="hora_finEditar" class="col-md-6"><b>Hora Fin</b></label>
                                <input class="form-control form-control-border border-width-2" style="margin-left: 0.4em;" onchange="getCheckTimeMax()" type="time" placeholder="Hora Fin" name="hora_finEditar" id="hora_finEditar" required>
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
            <h1>Eliminar Clase del Horario</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div class="modal-body" style="margin-top:-2em">
        
            <form method="POST"> 
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
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('selectdataHorarioClase')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "id_gimnasio": function() { 
                        console.log($('#id_gimnasio_selected_calendario').val());
                        return $('#id_gimnasio_selected_calendario').val() 
                    },
                },
                //dataSrc:""
                                       
            },
            columnDefs: [
                                {
                                    target: [ 7 ],
                                    visible: false
                                }
                        ], 
            responsive: true,

            columns: [{ data: "nombregimnasio_localidad" }, { data: "nombre_clase" }, { data: "nombre_sala" }, { data: "fecha_clase", render: DataTable.render.datetime( 'D/M/YYYY' ) }, { data: "hora_inicio" }, { data: "hora_fin" }, {data:"nombreapellidos_monitor"},{data:"clase_planificada_id"} ]
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
            if (//datatable te da una funcion que te dice si el responsive esta activado o no
                datatable.responsive.hasHidden() ) {
                //no muestres el modal
                e.stopPropagation();
            } 
        } );

        var data = null
        
        $('#table_id tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index

            console.log(data)
       
                    $.ajax({
                        url: "{{ route('getEditarDataHorarioClase') }}",
                        type: "POST",
                        cache: false,

                        data:{
                            _token:'{{ csrf_token() }}',
                            id: data["clase_planificada_id"]
                        },
                      
                   
                        success: function(dataResult){

                            console.log(dataResult)
                            dataJson=JSON.parse(dataResult)
                            //console.log(dataJson[0][0])

                            $("#id_label_gimnasio_update").val(dataJson[0][0]["gimnasio_id"]);     
                            actualizarDatos(dataJson[0][0]["gimnasio_id"],dataJson[0][0]["sala_id"],dataJson[0][0]["clases_id"],dataJson[0][0]["monitor_id"]);                  
                            document.getElementById('fecha_claseEditar').value=dataJson[0][0]["fecha_clase"];
                            document.getElementById('hora_inicioEditar').value=dataJson[0][0]["hora_inicio"];
                            document.getElementById('hora_finEditar').value=dataJson[0][0]["hora_fin"];

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
                url: "{{route('deletedataHorarioClase')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["clase_planificada_id"]

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
            //console.log($('select[name="duallistbox_gimnasio[]"]').val())
            
            // se comprueba si las fechas se cruzan 
            var beginningDate = moment(document.getElementById('fecha_inicio_clase').value); //YY-m-d
            var endDate = moment(document.getElementById('fecha_fin_clase').value);
  
            //console.log(beginningDate.isSameOrBefore(endDate))
            if(beginningDate.isSameOrBefore(endDate)){
           
                $.ajax({
                    url: "{{route('insertdataHorarioClase')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        fecha_inicio_clase: $("#fecha_inicio_clase").val(),
                        fecha_fin_clase: $("#fecha_fin_clase").val(),
                        hora_inicio: $("#hora_inicio").val(),
                        hora_fin: $("#hora_fin").val(),
                        sala_id : $("#id_label_salas").val(),
                        clases_id : $("#id_label_clases").val(),
                        nombregimnasio_localidad: $("#id_label_gimnasio").val(),
                        monitor_id: $("#id_label_monitores").val(),                  
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
            }else{
                msgError("Las fechas no pueden cruzarse")
            }
        }); 

        //updatedata
        $("#updateDataButton").click(function(e){

            // se comprueba si las horas se cruzan 
            var beginningTime = moment(document.getElementById('hora_inicioEditar').value, 'hh:mm');
            var endTime = moment(document.getElementById('hora_finEditar').value, 'hh:mm');


            if(beginningTime.isSameOrBefore(endTime)){
                
                $.ajax({
                    url: "{{route('updatedataHorarioClase')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        sala_id: $('#id_label_salas_update').val(),
                        clases_id: $('#id_label_clases_update').val(),
                        fecha_clase: $('#fecha_claseEditar').val(),
                        hora_inicio: $('#hora_inicioEditar').val(),
                        hora_fin: $('#hora_finEditar').val(), 
                        nombregimnasio_localidad: $("#id_label_gimnasio_update").val(),
                        monitor_id: $("#id_label_monitores_update").val(),
                        clase_planificada_id: data["clase_planificada_id"]
                    },

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
            }else{
                msgError("Las horas no pueden cruzarse")
            }

           
        }); 




        $('#id_label_gimnasio').on('change',  function (e) {
            $.ajax({
                url: "{{route('getEditarDataGimnasioSalaClaseMonitores')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    //id del gimnasio seleccionada
                    id: $('#id_label_gimnasio').val(),
                },

                success: function(dataResult){
                    //borrado previo de lo anterior

                    console.log(dataResult)

                    $('#id_label_salas option').each(function() {
                        $(this).remove();
                    });

                    $('#id_label_clases option').each(function() {
                        $(this).remove();
                    });
                    
                    $('#id_label_monitores option').each(function() {
                        $(this).remove();
                    });

                    //rellenar el select con los datos de las salas que me da el controlador (dataresult)
                    dataJson=JSON.parse(dataResult)

                    $('#id_label_salas').append('<option value=""></option>');
                    for (var index = 0; index < dataJson[0].length; index++) {
                        $('#id_label_salas').append('<option value="' + dataJson[0][index].sala_id + '">' + dataJson[0][index].nombre + '</option>');
                    }

                    //display block del select
                    $("#listado_salas").css("display", "block");   
                    $("#id_label_salas").css("display", "block");        
                   
                    //rellenar el select con los datos de las clases que me da el controlador (dataresult)

                    $('#id_label_clases').append('<option value=""></option>');   
                    for (var index = 0; index < dataJson[1].length; index++) {
                        $('#id_label_clases').append('<option value="' + dataJson[1][index].clases_id + '">' + dataJson[1][index].nombre + '</option>');
                    }                   
                     //display block del select            
                    $("#listado_clases").css("display", "block");   
                    $("#id_label_clases").css("display", "block");
                    

                    //rellenar el select con los datos de los monitores que me da el controlador (dataresult)
                    $('#id_label_monitores').append('<option value=""></option>');
                    for (var index = 0; index < dataJson[2].length; index++) {
                        $('#id_label_monitores').append('<option value="' + dataJson[2][index].id + '">' + dataJson[2][index].nombre +  ' ' +  dataJson[2][index].apellidos + '</option>');
                    }

                    //display block del select            
                    $("#listado_monitores").css("display", "block");   
                    $("#id_label_monitores").css("display", "block");
                    
           
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        });



        function actualizarDatos(gym,sala,clase,monitor){
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

                    $('#id_label_monitores_update option').each(function() {
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
                    



                    $('#id_label_monitores_update').append('<option value=""></option>');
                    for (var index = 0; index < dataJson[2].length; index++) {
                        $('#id_label_monitores_update').append('<option value="' + dataJson[2][index].id + '">' + dataJson[2][index].nombre + ' ' + dataJson[2][index].apellidos  +'</option>');
                    }

                    $("#listado_monitores_update").css("display", "block"); 


                    
                    
                    $("#id_label_salas_update").val(sala);                   
                    $("#id_label_clases_update").val(clase); 
                    $("#id_label_monitores_update").val(monitor);                   
   
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