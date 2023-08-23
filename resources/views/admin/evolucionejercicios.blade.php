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
                            <div class="row" style="margin-right: 1.2em;">
                                <label style="font-size:13px; align-self: center;text-align: center; margin-bottom: unset;" 
                                for="fecha_inicio" class="col-md-6"><b>Fecha Inicio</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6" type="date" placeholder="Fecha Inicio" name="fecha_inicio" id="fecha_inicio"  >
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="row" style="margin-right: 1.2em;">
                                <label style="font-size:13px; align-self: center;
                                text-align: center;
                                margin-bottom: unset; " for="fecha_fin" class="col-md-6"><b>Fecha Fin</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-6"  type="date" placeholder="Fecha Fin" name="fecha_fin" id="fecha_fin" >
                            </div>
                        </div>

                        @if(Session('idRole') == 5 )
                            <div style="display: none">
                                <div class="form-group col-md-4">
                                    <div class="row">
                                        <label style="font-size:13px; align-self: center;
                                        text-align: ceenter;
                                        margin-bottom: unset;" class="col-md-6" for="listado_socios"><b>Listado Socios</b></label>
            
                                        <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_label_socio">
                                                <option value=""></option>
                                                @foreach($socios as $s)
                                                    <option value="{{$s->id}}">{{$s->nombre}}  {{$s->apellidos}}</option>
                                                @endforeach                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else

                            <div class="form-group col-md-4">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;
                                    text-align: ceenter;
                                    margin-bottom: unset;" class="col-md-6" for="listado_socios"><b>Listado Socios</b></label>
        
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6" id="id_label_socio">
                                            <option value=""></option>
                                            @foreach($socios as $s)
                                                <option value="{{$s->id}}">{{$s->nombre}}  {{$s->apellidos}}</option>
                                            @endforeach                                        
                                    </select>
                                </div>
                            </div>
                        @endif 
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
                                            <!--<th>Distancia</th>-->
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

    <div id="chart-container" style="display: none;">
        <canvas id="myChart"></canvas>
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




 <!-- Modal  Grafica-->

<div class="modal fade" id="chartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gráfica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" width="400" height="400">
                <canvas id="chartCanvas" ></canvas>
            </div>
        </div>
    </div>
</div>


@endsection



@section('scripts')

<script>
$(document).ready( function () {


    //datatable

      //selectdata 
      var datatable = $('#table_id').DataTable({
             language: {
                 "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                 },

             ajax: {
                 url: "{{route('selectdataEvolucionEjercicios')}}",
                 type: 'post',
                 data: {
                     "_token": $("meta[name='csrf-token']").attr("content"),
                     "id_usuario": function() { 
                        console.log($('#id_label_socio').val());
                        return $('#id_label_socio').val() 
                    },
                    "fecha_inicio": function() { 
                        console.log($('#fecha_inicio').val());
                        return $('#fecha_inicio').val() 
                    },
                    "fecha_fin": function() { 
                        console.log($('#fecha_fin').val());
                        return $('#fecha_fin').val() 
                    },
                 },
                 //dataSrc:""                          
             },
             responsive: true,
 
             columns: [ {data:"fecha", render: DataTable.render.datetime( 'D/M/YYYY' )},{data:"nombre"},{data:"serie"},{data:"repeticion"},{data:'peso'}]
         });

         let myChart;

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


            //1-llamar a un ajax para que me devuelva los atos para la grafica
            data = datatable.row(this).data();
            //console.log(data['nombre'])
            $.ajax({
                url: "{{route('grafica')}}", //return ['code'=>200,'data'=>array de datos para mostrar en la grafica]
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    fecha_inicio: $("#fecha_inicio").val(),
                    fecha_fin:$("#fecha_fin").val(),
                    id_socio:$("#id_label_socio").val(),
                    id_ejercicio: data['nombre']
                },
                success: function(dataResult){
                    console.log(dataResult)
                    if(dataResult["code"]==200){

                        //dataResult["data"]['x'] -> fechas
                        //dataResult["data"]['y'] -> peso
                        //dataResult["data"]['dataset'] -> serie
                    
                        //2-le damos los datos a la grafica y la creamos
                        var ctx = document.getElementById('chartCanvas').getContext('2d');
                            
                        // Usa los datos de la fila para generar los datos para la gráfica

      
                            var chartData = {
                                //labels: ['14/08/2023', '15/08/2023','16/08/2023'],
                               labels: dataResult['labels'],  // Etiquetas del eje X

                                datasets: dataResult['data'],
                                    
                                /* [
                                   
                                /*{
                                    label: '1',
                                    data: [10,15,20],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 1
                                },
                                {
                                label: '2',
                                data: [35,40,60],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1
                                }
                                ,
                                {
                                label: '3',
                                data: [null,null,80],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1
                                }
                            ]*/
                            };

                            if (myChart) {
                                myChart.destroy();
                            }

                            myChart = new Chart(ctx, {
                                type: 'bar',
                                data: chartData,
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Evolución del Ejercicio ' +data['nombre']+ ' de (nombre y apellidos del socio)'
                                        }
                                    }
                                }
                            });

                            //3-mostramos el modal
                            $('#chartModal').modal('show');



                    }else{
                        msgError(dataResult["msg"])
                    }
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
            
         } );

        //hace el rellamado y filtro del gimnasio para el admin->listener
        $('#id_gimnasio_selected_calendario').on('change', function() {
            console.log("reload")
            //datatable.ajax.reload();

            $.ajax({
                url: "{{route('selectSocioGimnasio')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id_gimnasio: $("#id_gimnasio_selected_calendario").val(),
                },
                success: function(dataResult){
                    console.log(dataResult)
                    if(dataResult["code"]==200){
                    
                        //console.log( dataResult["data"])
                        //se borra las opciones de los socios al seleccionar un nuevo gimnasio en el select
                        $("#id_label_socio").empty();

                        $('#id_label_socio').append('<option value=""> </option>');

                        for (var index = 0; index < dataResult["data"].length; index++) {
                            $('#id_label_socio').append('<option value="' +  dataResult["data"][index].id + '">' +  dataResult["data"][index].nombre + ' ' +  dataResult["data"][index].apellidos + '</option>');
                        }




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


        //reload del datatable de los select fecha_inicio,fecha_fin,lista_socios
        $('#id_label_socio').on('change', function() {
            console.log("reload")
            datatable.ajax.reload();
        });

        $('#fecha_inicio').on('change', function() {
            console.log("reload")
            datatable.ajax.reload();
        });

        $('#fecha_fin').on('change', function() {
            console.log("reload")
            datatable.ajax.reload();
        });
      

});

</script>

@endsection