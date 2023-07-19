@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Entrenamiento Diario</h3>
                </div>

            <div class="card-body">
                <form action="{{route('EntrenamientoDiario')}}" name="adminEvolucion" method="GET">
                    @csrf
                    <div class="form-group row">
                        <label style="font-size:13px; align-self: center;" for="fecha_entrenamiento" class="col-md-2"><b>Fecha Entrenamiento</b></label>
                        <input class="form-control form-control-border border-width-2 col-md-3" type="date" placeholder="Fecha Entrenamiento" name="fecha" 
                            value="@php if(session::has('fecha')==0 || session('fecha')=='curdate()') echo date('Y-m-d'); else echo str_replace("'","",session('fecha')); @endphp" 
                            id="fecha_entrenamiento" required>
                        <input class="button btn btn-primary col-md-1" type="submit" value=">">
                    </div>
                </form>
            </div>

                <br/>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id_1" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Nombre Ejercicio</th>
                                            <th>Serie (Objetivo)</th>
                                            <th>Repeticiones (Objetivo)</th>
                                            <th>Distancia (Objetivo)</th>
                                          </tr>
                                          
                                    </thead>
                                </table> 
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id_2" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Nombre Ejercicio</th>
                                            <th>Serie (Real)</th>
                                            <th>Repeticiones (Real)</th>
                                            <th>Distancia (Real)</th>
                                            <th>Peso (Real)</th>
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


<div hidden>

    <div class="floating-container">
        <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal">
            +
        </div>
    </div>  
</div>

@endsection



@section('modal')

 <!-- Modal  Cargar -->
 <div class="modal fade" id="getTablaEjercicioModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 650px">
            <div class="modal-header">
            <h1>Selección de Tabla de  Ejercicios</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('cargarTablaEjercicio')}}" name="createEvolucionEjercicio" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                   
                        <div class="form-group">
                            <label style="font-size:13px" for="listado_tabla_ejercicio"><b>Listado de Tablas de Ejercicios</b></label>
    
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" name="id_label_tabla_ejercicio" id="id_label_tabla_ejercicio" required>
                                            <option value=""></option>
                                            @foreach($tablasejercicios as $te)
                                                <option value="{{$te->tabla_de_ejercicios_id}}">{{$te->nombre_rutina_ejercicio}}</option>
                                            @endforeach                                        
                                    </select>
                        </div>
                      
                   </div>
                   
                   <hr>
                    <div class="card-footer" style="background-color: white; padding: 0;">
                        <button type="button" class="btn btn-secondary float-left" id="insertDataButtonClose" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary float-right" id="insertDataButton">Aceptar</button>
                    </div>
              
                </form>
                          
            </div>
        </div>
    </div>
</div>

 <!-- Modal  Create-->
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h1>Insertar datos del Entrenamiento Diario</h1>
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
                        <label style="font-size:13px" for="listado_ejercicio"><b>Nombre del Ejercicio</b></label>
                        <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="Nombre Ejercicio" name="ejercicioNombre" id="ejercicioNombre" required disabled>

                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="series"><b>Series</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Series" name="series" id="series" min="0" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="repeticiones"><b>Repeticiones</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Repeticiones" name="repeticiones" id="repeticiones" min="0" >                                   
                            </div>
                        </div>                           
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="distancia"><b>Distancia</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Distancia" name="distancia" id="distancia" min="0">                                   
                            </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="peso"><b>Peso</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Peso" name="peso" id="peso" min="0">                                   
                            </div>
                        </div> 
                    </div>
                  
               </div>

                <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                                         
                    <button type="button" class="btn btn-danger float-left"  id="" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>             
                    <button type="button"   id="createDataButton" class="btn btn-primary float-right" >Aceptar</button>
                    <button type="button" class="btn btn-secondary float-right  mr-1"  id="CreateDataButtonClose" data-bs-dismiss="modal">Cancelar</button>

                
                </div>
              
              </form>

            </div>
        </div>
    </div>
</div>

 <!-- Modal  Update-->
 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h1>Actualizar datos del Entrenamiento Diario</h1>
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
                        <label style="font-size:13px" for="listado_ejercicio"><b>Nombre del Ejercicio</b></label>
                        <input class="form-control form-control-border border-width-2 col-md-6" type="text" placeholder="Nombre Ejercicio" name="ejercicioNombreEditar" id="ejercicioNombreEditar" required disabled>

                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="series"><b>Series</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Series" name="seriesEditar" id="seriesEditar" min="0" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="repeticiones"><b>Repeticiones</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Repeticiones" name="repeticionesEditar" id="repeticionesEditar" min="0" >                                   
                            </div>
                        </div>                           
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="distancia"><b>Distancia</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Distancia" name="distanciaEditar" id="distanciaEditar" min="0">                                   
                            </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px" for="peso"><b>Peso</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Peso" name="pesoEditar" id="pesoEditar" min="0">                                   
                            </div>
                        </div> 
                    </div>
                  
               </div>

                <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                                         
                    <button type="button"   id="updateDataButton2" class="btn btn-primary float-right" >Aceptar</button>
                    <button type="button" class="btn btn-secondary float-right  mr-1"  id="UpdateDataButtonClose2" data-bs-dismiss="modal">Cancelar</button>

                
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

    @if(Session::has('modal'))
        $('#getTablaEjercicioModal').modal('show');
    @endif

    //datatable

      //selectdata tabla_1
      var datatable = $('#table_id_1').DataTable({
             language: {
                 "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                 },

             ajax: {
                 url: "{{route('selectdataEntrenamientoDiario_tabla1')}}",
                 type: 'post',
                 data: {
                     "_token": $("meta[name='csrf-token']").attr("content"),
                 },
                 //dataSrc:""                          
             },
             responsive: true,
 
             columns: [ {data:"nombre"},{data:"serie_objetivo"},{data:"repeticion_objetivo"},{data:"distancia_objetivo"}]
         });

         
      //selectdata tabla_2
      var datatable2 = $('#table_id_2').DataTable({
             language: {
                 "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                 },

             ajax: {
                 url: "{{route('selectdataEntrenamientoDiario_tabla2')}}",
                 type: 'post',
                 data: {
                     "_token": $("meta[name='csrf-token']").attr("content")
                 },
                 //dataSrc:""                          
             },
             responsive: true,
 
             columns: [ {data:"nombre"},{data:"serie_real"},{data:"repeticion_real"},{data:"distancia_real"},{data:"peso_real"}]
         });

 
         //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
         $('#table_id_1 tbody').on('click', 'td.dtr-control', function (e) {
 
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


         //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
         $('#table_id_2 tbody').on('click', 'td.dtr-control', function (e) {
            
            //me cojo la row del td al que he dado click
            var tr = $(this).closest('tr');
            //cojo la row del datatable para ver si se ha mostrado
            var row = datatable2.row(tr);

            if (//tr.hasClass('dt-hasChild') || !row.child.isShown()
                //datatable te da una funcion que te dice si el responsive esta activado o no
                datatable2.responsive.hasHidden() ) {
                //no muestres el modal
                e.stopPropagation();
            } 
            } 
            );

        

        //modal al hacer click en el ejercicio de la tabla 1
        var data = null  
        $('#table_id_1 tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index
            document.getElementById('ejercicioNombre').value=data["nombre"];

            $('#createModal').modal('show');
        });

        //insertdata -> hace un insert internamente en el controller
        $("#createDataButton").click(function(){
            $.ajax({
                url: "{{route('insertdataEntrenamientoDiario')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $("#ejercicioNombre").val(),
                    serie_real: $("#series").val(),
                    repeticion_real: $("#repeticiones").val(),
                    distancia_real: $("#distancia").val(),
                    peso_real: $("#peso").val(),
                    ejercicio_id:data["ejercicio_id"],
                    evolucion_ejercicios_id: data["evolucion_ejercicios_id"]
                },
                success: function(dataResult){
                    console.log(dataResult)
                    if(dataResult["code"]==200){
                    msgSuccess(dataResult["msg"])                       
                        $('#UpdateDataButtonClose').click();                       
                        datatable2.ajax.reload();
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

        //obtener datos de la tabla2
        var data2 = null  
        $('#table_id_2 tbody').on('click', 'tr', function () {
            data2 = datatable2.row(this).data();
            datatable2.row(this).index
            console.log(data2)
            $.ajax({
                url: "{{route('getEditarDataEntrenamientoDiario')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    evolucion_ejercicios_datos_id: data2["evolucion_ejercicios_datos_id"]
                },
                success: function(dataResult){
                    console.log(dataResult)
                    dataJson=JSON.parse(dataResult)

                        document.getElementById('ejercicioNombreEditar').value=dataJson[0]["nombre"];
                        document.getElementById('seriesEditar').value=dataJson[0]["serie_real"];
                        document.getElementById('repeticionesEditar').value=dataJson[0]["repeticion_real"];
                        document.getElementById('distanciaEditar').value=dataJson[0]["distancia_real"];
                        document.getElementById('pesoEditar').value=dataJson[0]["peso_real"];

                        $('#updateModal').modal('show');

                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        });




        //updatedata de la tabla 2
        $("#updateDataButton2").click(function(){

            $.ajax({
                url: "{{route('updatedataEntrenamientoDiario')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',

                    nombre: $("#ejercicioNombre").val(),
                    serie_real: $("#seriesEditar").val(),
                    repeticion_real:  $('#repeticionesEditar').val(),
                    distancia_real:  $('#distanciaEditar').val(),
                    peso_real:  $('#pesoEditar').val(),

                    //ejercicio_id:data["ejercicio_id"],
                    //evolucion_ejercicios_id: data["evolucion_ejercicios_id"],

                    evolucion_ejercicios_datos_id: data2["evolucion_ejercicios_datos_id"],


                },

                success: function(dataResult){
                    //console.log(dataResult)
                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#UpdateDataButtonClose2').click();
                        datatable2.ajax.reload();
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