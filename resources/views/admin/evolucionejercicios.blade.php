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
                            <div class="row" style="margin-right: 3em;">
                                <label style="font-size:13px; align-self: center;
                                text-align: center;
                                margin-bottom: unset; " for="fecha_fin" class="col-md-6"><b>Fecha Fin</b></label>
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
                                            <option value="{{$s->id}}">{{$s->nombre}}  {{$s->apellidos}}</option>
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
                     "id_gimnasio": function() { 
                        console.log($('#id_gimnasio_selected_calendario').val());
                        return $('#id_gimnasio_selected_calendario').val() 
                    },
                 },
                 //dataSrc:""                          
             },
             responsive: true,
 
             columns: [ {data:"fecha"},{data:"nombre"},{data:"serie"},{data:"repeticion"},{data:"distancia"},{data:'peso'}]
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

                        $("#id_label_socio").empty();

                        $('#id_label_socio').append('<option value=""> </option>');

                        for (var index = 0; index <= dataResult["data"].length; index++) {
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
      

});

</script>

@endsection