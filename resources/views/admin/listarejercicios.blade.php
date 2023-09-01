@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Ejercicios</h3>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">

                                <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                    <thead>
                                        <tr>
                                            <th>Categoría</th>
                                            <th>Nombre del Ejercicio</th>
                                            <th>Ejercicio por Defecto</th>
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
        <div class="floating-button btn btn-success" type="reset" data-toggle="modal" data-target="#createModal" onclick="">
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
            <h1>Añadir Ejercicio</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="{{route('insertdataEjercicios')}}" name="createEjercicio" method="POST">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div>

                        <div class="form-group">
                            <label style="font-size:13px" for="listado_categoria"><b>Listado Categoría</b></label>
    
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_categoria" required>
                                        <option value=""></option>
                                        @foreach($categorias as $c)
                                            <option value="{{$c->categoria_ejercicio_id}}">{{$c->nombre}}</option>
                                        @endforeach                                        
                                </select>
                        </div>
                       
                        @if(Session('idRole')!=5)
                        <div class="form-group" id="ejercicioPorDefectoDiv">
                            <label  style="font-size:13px" class="checkbox-wrap checkbox-primary">
                                Ejercicio Por Defecto
                                <input type="checkbox" name="ejercicioPorDefecto" id="ejercicioPorDefecto" value="0" onclick="cambiarValor()"/>
                                <span class="checkmark"></span>
                            </label>
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
        <h1>Actualizar datos del Ejercicio</h1>
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
                        <label style="font-size:13px" for="nombreEditar"><b>Nombre</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombreEditar" id="nombreEditar" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="listado_categoria"><b>Listado Categoría</b></label>

                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_categoria_update" required>
                                    <option value=""></option>
                                    @foreach($categorias as $c)
                                        <option value="{{$c->categoria_ejercicio_id}}">{{$c->nombre}}</option>
                                    @endforeach                                        
                            </select>
                    </div>
                   
                    @if(Session('idRole')!=5)
                        <div class="form-group" id="ejercicioPorDefectoDiv">
                            <label  style="font-size:13px" class="checkbox-wrap checkbox-primary">
                                Ejercicio Por Defecto
                                <input type="checkbox"  name="ejercicioPorDefectoEditar" id="ejercicioPorDefectoEditar" value="1" onclick="cambiarValor()" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endif
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
            <h1>Eliminar Ejercicio</h1>
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

idRole = <?php echo Session('idRole'); ?>;


        function cambiarValor(){
           if( document.getElementById("ejercicioPorDefecto").checked){
                document.getElementById("ejercicioPorDefecto").value=1;
           }else{
             document.getElementById("ejercicioPorDefecto").value=0;
           }

           if( document.getElementById("ejercicioPorDefectoEditar").checked){
                document.getElementById("ejercicioPorDefectoEditar").value=1;
           }else{
             document.getElementById("ejercicioPorDefectoEditar").value=0;
           }
        }


    $(document).ready( function () {

      
        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('selectdataEjercicios')}}",//'php/identidades.php',
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },                          
            },
            responsive: true,

            
            columns: [{ data: "nombre_categoria" }, { data: "nombre" },{data: "pordefecto"}],
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
            //console.log(data["id"])
        console.log(idRole)
            if(data['pordefecto']=="No" && idRole == 5){
                $.ajax({
                    url: "{{route('getEditarDataEjercicios')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: data["id"]
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        //console.log(dataResult[0])
                        dataJson=JSON.parse(dataResult)

                        document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                        $("#id_label_categoria_update").val(dataJson[0]["categoria_id"])
                        //$("#id_label_tipo_update").val(dataJson[0]["tipo_id"])
                        //document.getElementById('ejercicioPorDefectoEditar').checked=dataJson[0]["ejercicioPorDefecto"];

                        $('#updateModal').modal('show');
                        
                    },
                    error: function(e){
                        console.log(e)
                    }
                });
            }else if((data['pordefecto']=="Sí" && idRole != 5) || (data['pordefecto']=="No" && idRole != 5)){
                $.ajax({
                    url: "{{route('getEditarDataEjercicios')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: data["id"]
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        //console.log(dataResult[0])
                        dataJson=JSON.parse(dataResult)

                        document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                        $("#id_label_categoria_update").val(dataJson[0]["categoria_id"])
                        //$("#id_label_tipo_update").val(dataJson[0]["tipo_id"])
                        document.getElementById('ejercicioPorDefectoEditar').checked=dataJson[0]["ejercicioPorDefecto"];

                        $('#updateModal').modal('show');
                        
                    },
                    error: function(e){
                        console.log(e)
                    }
                });
            }else{
                msgError("No puede modificar un ejercicio por defecto")

            }

            
        });


        //deletedata
        $("#DeleteDataButton").click(function(){
            $.ajax({
                url: "{{route('deletedataEjercicios')}}",
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
            $.ajax({
                url: "{{route('insertdataEjercicios')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $("#nombre").val(),
                    ejercicioPorDefecto: $("#ejercicioPorDefecto").val(),
                    categoria_id : $("#id_label_categoria").val(),
                   // tipo_id : $("#id_label_tipo").val()

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
                url: "{{route('updatedataEjercicios')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),
                    nombre_categoria: $("#id_label_categoria_update").val(),
                    //nombre_tipo: $("#id_label_tipo_update").val(),
                    ejercicioPorDefecto:  $('#ejercicioPorDefectoEditar').val(),
                    id: data["id"]
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