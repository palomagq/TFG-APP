@extends('layouts.maintemplate')

@section('content')
<!--style="min-height: 1172.8px;"-->

<style>
    @media (min-width: 991.98px){

        .calendar_wrapper{
            margin-left: 4.6rem !important;
        }

}
</style>

<div class="content-wrapper calendar_wrapper">
    <section class="content-header" style="text-align: center; margin-left: 22em;">
        <div class="container-fluid" >
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendario de Horario de Clases</h1>
                </div>
                <!--<div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Calendar</li>
                    </ol>
                </div>-->
            </div>
        </div>
    </section>
    
    <section class="content" style="margin-left: -3em;margin-right: 3em;">
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col">

                        <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-6"
                             id="id_gimnasio_selected_calendario" required>
                                <option value=""></option>
                                @foreach($gimnasios as $g)
                                    <option  value="{{$g->gimnasio_id}}">{{$g->nombre}} - {{$g->localidad}}</option>
                                @endforeach       
                        </select>
                </div>
            </div>-->
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">
                                <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                    <div class="fc-toolbar-chunk">
                                        <!--<div class="btn-group">
                                            <button type="button" title="Next month" aria-pressed="false" class="fc-next-button btn btn-primary"><span class="fa fa-chevron-right"></span></button>
                                        </div>-->
                                        <button type="button" title="This month" disabled="" aria-pressed="false" class="fc-today-button btn btn-primary">hoy</button>
                                    </div>
                                    <div class="fc-toolbar-chunk"><h2 class="fc-toolbar-title" id="fc-dom-1">Marzo 2023</h2></div>
                                    <div class="fc-toolbar-chunk">
                                        <div class="btn-group" id="button-week-day">
                                            <button type="button" title="week view" aria-pressed="false" class="fc-timeGridWeek-button btn btn-primary">semana</button>
                                            <button type="button" title="day view" aria-pressed="false" class="fc-timeGridDay-button btn btn-primary">día</button>
                                        </div>
                                    </div>
                                </div>
                                <div aria-labelledby="fc-dom-1" class="fc-view-harness fc-view-harness-active" style="height: 414.074px;">
                                    <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--<div>

        <div class="floating-container" style="margin-right: 0.7em;">
            <div class="floating-button btn btn-success" type="button" data-toggle="modal" data-target="#createModal">
                +
            </div>
        </div>  
    </div>-->
</div>

@endsection



@section('modal')

<!--Modal de Inscribirse a una Clase-->
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 id="modalTitle">Inscribirse a una clase</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div  id="modalBody" class="modal-body" style="margin-top:-2em">
        
            <form id="addClassForm" method="POST"> <!--method="POST" -->
                @csrf
                <hr>
                <div class="container" >
                    <div class="form-group">
                        <p>¿Deseas apuntarse a esta clase?</p> 
                    </div>  
                    <input type="hidden" id="clase_planificada_id">
                    <input type="hidden" id="capacidad_clase_id">

                    
                    <div class="form-group">
                        <label style="font-size:13px" for="capacidad"><b>Capacidad Restante de la Clase</b></label>
                        <input class="form-control form-control-border border-width-2" type="number" name="capacidad" id="capacidad" disabled>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="listado_gimnasio"><b>Nombre Gimnasio</b></label>

                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_gimnasio" disabled>
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
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_salas" disabled>
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
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" style="margin-left: 0.4em;" id="id_label_clases" disabled>
                                        <option value=""></option> 
                                        @foreach($clases as $c)
                                            <option value="{{$c->clases_id}}">{{$c->nombre}}</option>
                                        @endforeach                                       
                                </select>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label style="font-size:13px" for="listado_gimnasio"><b>Nombre del Monitor</b></label>
    
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_monitores" disabled>
                                        <option value=""></option>
                                        @foreach($monitores as $m)
                                            <option value="{{$m->id}}">{{$m->nombre}}  {{$m->apellidos}}</option>
                                        @endforeach                                        
                                </select>
                        </div>                     
                        <div class="form-group">
                            <label style="font-size:13px" for="fecha_clase"><b>Fecha de la Clase</b></label>
                            <input class="form-control form-control-border border-width-2" type="date" placeholder="Fecha de la Clase" name="fecha_claseEditar" id="fecha_clase"  disabled>
                        </div>
    
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_inicio" class="col-md-6"><b>Hora Inicio</b></label>
                                    <input class="form-control form-control-border border-width-2" type="time"  placeholder="Hora Inicio" name="hora_inicioEditar" id="hora_inicio"  disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px;" for="hora_fin" class="col-md-6"><b>Hora Fin</b></label>
                                    <input class="form-control form-control-border border-width-2" style="margin-left: 0.4em;" type="time" placeholder="Hora Fin" name="hora_finEditar" id="hora_fin" disabled>
                                </div>
                            </div>
                        </div>
                                                       
                    </div>
                                       
              
                </div>
               <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                    <button type="button" class="btn btn-danger float-left"  id="deleteButttonModal" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>             
                    <button type="button"  id="addClassButton" class="btn btn-primary float-right">Aceptar</button>
                    <button type="button"  class="btn btn-secondary float-right  mr-1"  id="addClassButtonClose" data-bs-dismiss="modal">Cancelar</button>
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


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

    var type="timeGridWeek"//  initialView: 'dayGridWeek',
    var header={ 
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,timeGridDay'
    }


    if (isMobile){
       type="timeGridDay";
        header={
            start: 'today', // will normally be on the left. if RTL, will be on the right
            center: 'title',
            end: 'prev,next' // will normally be on the right. if RTL, will be on the left
        };
       
    }

  var calendar = new FullCalendar.Calendar(calendarEl, {
    
    timeZone: 'Europe/Madrid',
    initialView: type,
    navLinks: true,
    headerToolbar: header,
    locale: 'es',
    expandRows:'true',
    slotMinTime: '07:00:00',
    slotMaxTime: '23:00:00',
    slotDuration: '00:10:00',
    firstDay: 1, //lunes
    slotEventOverlap: false,
    windowResize: true,
    titleFormat: { // will produce something like "Tuesday, September 18, 2018"
        month: 'long',
        year: 'numeric',
        day: 'numeric'
    },
    dayHeaderFormat:{
         weekday: 'long',
         month: 'numeric', 
         day: 'numeric'

    },
    slotLabelFormat:{
        hour: 'numeric',
        minute: '2-digit'
    },
    buttonText:{
        today:    'hoy',
        week:     'semana',
        day:      'día',
    },
    nowIndicator: true,
    allDaySlot: false,
    stickyHeaderDates:true,
    handleWindowResize: true,
    eventClick: function(info) {
        //info.jsEvent.preventDefault(); // don't let the browser navigate
        cp_id=info.event.extendedProps.myId

        //codigo ajax
        $.ajax({
            url: "{{route('inscribeClaseMatriculadaGETDATA')}}",
            type: "POST",
            cache: false,
            data:{
                _token:'{{ csrf_token() }}',
                id: cp_id
                
            },
            success: function(dataResult){
                if(dataResult["code"]==200){
                    //insertamos los datos que necesitamos en el modal 
                    //dataResult["data"]
                    console.log(dataResult)
                        $("#id_label_gimnasio").val(dataResult["data"][0]["gimnasio_id"]);     
                        $("#id_label_salas").val(dataResult["data"][0]["sala_id"]);     
                        $("#id_label_clases").val(dataResult["data"][0]["clases_id"]);
                        $("#id_label_monitores").val(dataResult["data"][0]["monitor_id"]);     
     
                        document.getElementById('capacidad').value=dataResult["data"][0]["capacidad"];
                        document.getElementById('fecha_clase').value=dataResult["data"][0]["fecha_clase"];
                        document.getElementById('hora_inicio').value=dataResult["data"][0]["hora_inicio"];
                        document.getElementById('hora_fin').value=dataResult["data"][0]["hora_fin"];
                        document.getElementById('clase_planificada_id').value=dataResult["data"][0]["clase_planificada_id"];
                        document.getElementById('capacidad_clase_id').value=dataResult["data"][0]["capacidad_clase_id"];
                        
                        
                        if(document.getElementById('capacidad_clase_id').value==undefined || document.getElementById('capacidad_clase_id').value==""){
                            console.log(document.getElementById('capacidad_clase_id').value)
                            document.getElementById("deleteButttonModal").disabled = true;
                            if(document.getElementById('capacidad').value > 0 || dataResult["data"][0]["puedeInscribirse"] == 1)
                                document.getElementById("addClassButton").disabled = false;

                            //$('#addClassButton').click();
                        }else{
                            document.getElementById("deleteButttonModal").disabled = false;
                            if(document.getElementById('capacidad').value == 0 || dataResult["data"][0]["puedeInscribirse"] == 0)
                                document.getElementById("addClassButton").disabled = true;

                        }

                        
                        if(document.getElementById('capacidad').value > 0 && document.getElementById("deleteButttonModal").disabled==true && dataResult["data"][0]["puedeInscribirse"] == 1){
                            document.getElementById("addClassButton").disabled = false;
                            //document.getElementById("deleteButttonModal").disabled = true;
                            //$('#addClassButton').click();
                        }else{
                            document.getElementById("addClassButton").disabled = true;
                            //document.getElementById("deleteButttonModal").disabled = false;

                        }

                    //abrimos el modal
                    //muestra el modal al hacer click en una clase

                    $('#addClassModal').modal("toggle");
                }else{
                    msgError(dataResult["msg"])
                }

            },
            error: function(e){
                console.log(e)
                msgError("Error genérico. Por favor, inténtelo más tarde.")
            }
        });
    },

   
    eventSources: [
    {
      url: "{{route('CalendarioHorarioClaseGETDATA')}}",
      type: 'POST',
      extraParams: function () { // a function that returns an object
                return {
                    _token:'{{ csrf_token() }}',
                    id: $("#id_gimnasio_selected_calendario").val()
                };

            },
      success: function(data){
      },
      error: function() {
        alert('there was an error while fetching events!');
      },
      textColor: 'black' // a non-ajax option
      
    }
    ]

  });

  calendar.render();


//Recupera los eventos(clases y salas) de todos los gimnasios y los vuelve a representar en la pantalla.
  $("#id_gimnasio_selected").change(function () {
        calendar.refetchEvents()
    });


    $("#addClassButton").click(function() {    
        //console.log(document.getElementById('capacidad').value)        
        
                $.ajax({
                    url: "{{route('insertClaseMatriculada')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        clase_planificada_id: $("#clase_planificada_id").val(),
                        hora_inicio: $("#hora_inicio").val(),
                        hora_fin: $("#hora_fin").val(),
                        nombreapellidos_monitor: $("#id_label_monitores").val(),
                        clases_id: $("#id_label_clases").val(),
                        sala_id: $("#id_label_salas").val(),
                        nombregimnasio_localidad: $("#id_label_gimnasio").val(),
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        if(dataResult["code"]==200){
                            msgSuccess(dataResult["msg"])
                            $('#addClassButtonClose').click();
                            if(document.getElementById('capacidad').value > 0){
                                document.getElementById("addClassButton").disabled = false;
                                //$('#addClassButton').click();
                            }else{
                                document.getElementById("addClassButton").disabled = true;
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

        $("#DeleteDataButton").click(function(){
            //console.log( document.getElementById("capacidad_clase_id").value)

            $.ajax({
                url: "{{route('deletedataClaseMatriculada')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: document.getElementById("capacidad_clase_id").value

                },
                success: function(dataResult){
                    console.log(dataResult)

                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#DeleteDataButtonClose').click();
                        //datatable.ajax.reload();
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