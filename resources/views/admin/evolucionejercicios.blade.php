@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Evolución de Ejercicios</h3>
                </div>

            <div class="card-body">
                <form action="{{route('EntrenamientoDiario')}}" name="adminEvolucion" method="GET">
                    @csrf

                    <div class="form-row row">
                        <div class="form-group col-md-4">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" 
                                for="fecha_inicio" class="col-md-6"><b>Fecha Inicio</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="date" placeholder="Fecha Inicio" name="fecha_inicio" id="fecha_inicio"  >
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;
                                text-align: center;
                                margin-bottom: unset;" for="fecha_fin" class="col-md-6"><b>Fecha Fin</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6"  type="date" placeholder="Fecha nacimiento" name="fecha_fin" id="fecha_fin" >
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;
                                text-align: ceenter;
                                margin-bottom: unset;" class="col-md-6" for="listado_socios"><b>Listado Socios</b></label>
    
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_label_socio">
                                        <option value=""></option>
                                        @foreach($socios as $s)
                                            <option value="{{$s->id}}">{{$s->nombre}}</option>
                                        @endforeach                                        
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

                <br/>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Nombre Ejercicio</th>
                                            <th>Serie</th>
                                            <th>Repeticiones</th>
                                            <th>Distancia</th>
                                            <th>Peso</th>
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

 

@endsection



@section('scripts')

<script>
$(document).ready( function () {


    //datatable

      //selectdata tabla_1
      var datatable = $('#table_id').DataTable({
             language: {
                 "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                 },

             ajax: {
                 url: "{{route('selectdataEvolucionEjercicios')}}",
                 type: 'post',
                 data: {
                     "_token": $("meta[name='csrf-token']").attr("content"),
                 },
                 //dataSrc:""                          
             },
             responsive: true,
 
             columns: [ {data:"fecha"},{data:"nombre"},{data:"serie"},{data:"repeticion"},{data:"distancia"},{data:'peso'}]
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