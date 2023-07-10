@extends('layouts.maintemplate')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Historial de Pago</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class=" dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">

                                    <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                        <thead>
                                            <tr>
                                                <th>Nombre del socio</th> 
                                                <th>Apellidos del socio</th>
                                                <th>DNI del socio</th>
                                                <th>Fecha de pago</th>
                                                <th>Cuota de pago</th>
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

@endsection



@section('modal')

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
                url: "{{route('selectdataHistorialdePago')}}",//'php/identidades.php',
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },                          
            },
            responsive: true,

            
            columns: [{ data: "nombre" }, { data: "apellidos" },{data: "dni"},{data: "fecha_pago", render: DataTable.render.datetime( 'D/M/YYYY' ) },{data: "cuota_pago"}],
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

});
        
</script>

@endsection