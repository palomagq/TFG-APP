@extends('layouts.maintemplate')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Tablas de Ejercicios</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class=" dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
           
                                    <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                        <thead>
                                            <tr>
                                                <th>Nombre de la tabla/rutina de ejercicios</th> 
                                                <th>Nombre del Ejercicio</th>
                                                <th>Series</th>
                                                <th>Repeticiones</th>
                                                <!--<th>Distancia</th>-->
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
            <h1>Añadir Tabla de  Ejercicios</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdataTablaEjercicios')}}" name="createEjercicio" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombreTablaEjercicio"><b>Nombre de la Tabla de Ejercicio</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre Tabla de Ejercicio" name="nombreTablaEjercicio" id="nombreTablaEjercicio" required>
                        </div>

                        <div class="form-group">
                            <label style="font-size:13px" for="listado_ejercicio"><b>Listado de Ejercicios</b></label>
    
                                    <select multiple class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" name="id_label_ejercicio" id="id_label_ejercicio" required>
                                            <option value=""></option>
                                            @foreach($ejercicios as $e)
                                                <option value="{{$e->ejercicio_id}}">{{$e->nombreEjercicio}}</option>
                                            @endforeach                                        
                                    </select>
                        </div>

                        @if((Session('idRole') == 1) || (Session('idRole') == 4))
                            <div class="form-group">
                                <label style="font-size:13px" for="listado_socio"><b>Listado de Socios</b></label>
                             
                                    <select multiple="multiple" id="duallistbox_socio[]" name="duallistbox_socio[]" title="duallistbox_socio[]">
                                        @foreach($socios as $s)
                                                <option value="{{$s->id}}">{{$s->nombre}}  {{$s->apellidos}}</option>
                                            @endforeach          
                                      </select>
                                
                            </div>
                        @endif
                      
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
        <h1>Actualizar datos de la Tabla de Ejercicios</h1>
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
                        <label style="font-size:13px" for="nombreTablaEjercicio"><b>Nombre de la Tabla de Ejercicio</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre Tabla de Ejercicio" name="nombreTablaEjercicioEditar" id="nombreTablaEjercicioEditar" required disabled>
                    </div>

                    <div class="form-group">
                        <label style="font-size:13px" for="listado_ejercicio"><b>Listado de Ejercicios</b></label>
                        <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="Nombre Ejercicio" name="ejercicioNombreEditar" id="ejercicioNombreEditar" required disabled>

                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="series"><b>Series</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Series" name="series" id="series" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="repeticiones"><b>Repeticiones</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Repeticiones" name="repeticiones" id="repeticiones" >                                   
                            </div>
                        </div>    
                        <!--<div class="form-group col-md-4">
                            <div class="row">
                                <label style="font-size:13px" for="distancia"><b>Distancia</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Distancia" name="distancia" id="distancia" >                                   
                            </div>
                        </div>-->                        
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
            <h1>Eliminar Ejercicio de la Tabla de Ejercicio</h1>
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

        var duallistbox_socio = $('select[name="duallistbox_socio[]"]').bootstrapDualListbox();
         //var duallistbox_socio_update = $('select[name="duallistbox_gimnasio_update[]"]').bootstrapDualListbox();
        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('selectdataTablaEjercicios')}}",//'php/identidades.php',
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },                          
            },
            responsive: true,

            
            columns: [{ data: "nombre_rutina_ejercicio" }, { data: "nombre" },{data: "serie_objetivo"},{data: "repeticion_objetivo"}],
        });




        //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
        $('#table_id tbody').on('click', 'td.dtr-control', function (e) {

            //me cojo la row del td al que he dado click
            var tr = $(this).closest('tr');
            //cojo la row del datatable para ver si se ha mostrado
            var row = datatable.row(tr);

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
            console.log(data)
        
                $.ajax({
                    url: "{{route('getEditarDataTablaEjercicios')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: data["ejercicio_id"]
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        //console.log(dataResult[0])
                        dataJson=JSON.parse(dataResult)

                        document.getElementById('nombreTablaEjercicioEditar').value=dataJson[0]["nombre_rutina_ejercicio"];
                        document.getElementById('ejercicioNombreEditar').value=dataJson[0]["nombre"];
                        document.getElementById('series').value=dataJson[0]["serie_objetivo"];
                        document.getElementById('repeticiones').value=dataJson[0]["repeticion_objetivo"];
                        //document.getElementById('distancia').value=dataJson[0]["distancia_objetivo"];


                        //document.getElementById('ejercicioPorDefectoEditar').checked=dataJson[0]["ejercicioPorDefecto"];

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
                url: "{{route('deletedataTablaEjercicios')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"],
                    ejercicio_id: data["ejercicio_id"]

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
                url: "{{route('insertdataTablaEjercicios')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre_rutina_ejercicio: $("#nombreTablaEjercicio").val(),
                    id_label_ejercicio: $("#id_label_ejercicio").val(),
                    socio_id: $('select[name="duallistbox_socio[]"]').val(),


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


            $.ajax({
                url: "{{route('updatedataTablaEjercicios')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                   /* nombre_rutina_ejercicio: $('#nombreTablaEjercicioEditar').val(),
                    nombre: $("#ejercicioNombreEditar").val(),*/
                    serie_objetivo: $("#series").val(),
                    repeticion_objetivo:  $('#repeticiones').val(),
                    //distancia_objetivo:  $('#distancia').val(),

                    id: data["id"],
                    ejercicio_id: data["ejercicio_id"],


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
        }); 


});
        
</script>

@endsection