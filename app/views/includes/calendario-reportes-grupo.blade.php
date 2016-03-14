<script src="/js/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
<script src="/js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>

<script type="text/javascript">
        ///estas var son para guardar las propiedades que cambian de la celda que se selecciona
        var color_celda_dia=""; 
        var color_letra_celda="";
        var celda="";
        var band_fecha_reporte=0;
        var calendario;
        var fecha_reporte = ""
        var fechas_reportes= new Array();

         @if(isset($grupo_seleccionado->id))
          @foreach($grupo_seleccionado->reportes as $reporte_aux)
            fechas_reportes.push("{{$reporte_aux->fecha}}");
          @endforeach
        @endif

            $(function() {

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var hoy = new Date();
                
                @if(isset($reporte->fecha))
                fecha_reporte=moment("{{ $reporte->fecha }}");
                @endif
                
                  calendario=$('#calendar').fullCalendar({
                    header: {
                        left: 'title',
                        @if(isset($grupo_seleccionado)) ///sino se envio el asistente por la URL no cargamos nada en el calendario
                        right: 'prev,next today',
                        @else
                        right: 'today',
                        @endif
                    },
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    buttonText: {//This is to add icons to the visible buttons
                        today: 'hoy',
                        month: 'mes',
                        week: 'semana',
                        day: 'día'
                    },
                    buttonIcons: {
                      prev: "fa fa-caret-left",
                        next: "prev fa fa-caret-right",
                      },
                    unselectAuto: false,
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],

                @if(isset($grupo_seleccionado)) ///sino se envio el asistente por la URL no cargamos nada en el calendario
                    dayClick: function(date, jsEvent, view) {
                      ////primero guardamos el color de la celda
                      
                      var dia= date.date();
                      if(dia<10)
                        dia="0"+dia;
                      var mes= date.month();
                      mes=mes+1;
                      if(mes<10)
                        mes="0"+(mes);
                      $("#dia_seleccionado").css("top", $("#titulo-calendario").height()+2);
                      $("#fecha_seleccionada").css("top", $("#titulo-calendario").height()+30);
                      //alert(jQuery.inArray(date.year()+"-"+mes+"-"+dia,fechas_reportes)+" date: "+date.year()+"-"+mes+"-"+dia+" fechas_reportes: "+ fechas_reportes);
                      
                      if(date>hoy)
                      {
                        $("#dia_seleccionado").attr("class", "badge bg-red");
                        $("#dia_seleccionado").html("No puede seleccionar una fecha futura");
                        $("#calendar").fullCalendar( 'unselect' );
                        $("#dia_seleccionado").show(100);
                        $("#seleccionaFecha").val("");
                        $("#fecha_seleccionada").html("Fecha Invalida");
                        $("#fecha_seleccionada").attr("class", "badge bg-red pull-right");
                        $("#fecha_seleccionada").show(100);
                      }

                      else if(jQuery.inArray(date.year()+"-"+mes+"-"+dia,fechas_reportes)!=-1 @if(isset($reporte->fecha)) && (date.year()+"-"+mes+"-"+dia)!="{{$reporte->fecha}}" @endif)
                      {
                        $("#dia_seleccionado").attr("class", "badge bg-red");
                        $("#dia_seleccionado").html("En esta fecha ya existe un reporte");
                        $("#calendar").fullCalendar( 'unselect' );
                        $("#dia_seleccionado").show(100);
                        $("#seleccionaFecha").val("");
                        $("#fecha_seleccionada").html("Fecha Invalida");
                        $("#fecha_seleccionada").attr("class", "badge bg-red pull-right");
                        $("#fecha_seleccionada").show(100);
                      }
                      else if(date.day()=={{ $grupo_seleccionado->dia }}-1)
                      {
                        $("#fecha_seleccionada").html(dia+"/"+mes+"/"+date.year());
                        $("#fecha_seleccionada").attr("class", "badge bg-green  pull-right");
                        $("#fecha_seleccionada").show(100);
                        $("#dia_seleccionado").hide();
                        $("#seleccionaFecha").val(date.year()+"-"+mes+"-"+dia);
                      }
                      else
                      {
                        $("#fecha_seleccionada").html(dia+"/"+mes+"/"+date.year());
                        $("#fecha_seleccionada").attr("class", "badge bg-yellow  pull-right");
                        $("#fecha_seleccionada").show(100);
                        $("#dia_seleccionado").html("El dia seleccionado es diferente al dia de su grupo.")
                        $("#dia_seleccionado").attr("class", "badge bg-yellow");
                        $("#seleccionaFecha").val(date.year()+"-"+mes+"-"+dia);
                        $("#dia_seleccionado").show(100);

                      }
                        //alert('Clicked on: ' + date.year()+"-"+date.getMonth()+"-"+date.getDate());
                    },
                    
                    dayRender: function( date, cell ) {
                      var dia= date.date();
                      if(dia<10)
                        dia="0"+dia;
                      var mes= date.month();
                       mes=mes+1;
                      if(mes<10)
                        mes="0"+(mes);

                      ////le ponemos el cursor de la manito a cada celda
                      cell.css("cursor", "pointer");
                      if(date.day()=={{ $grupo_seleccionado->dia }}-1)
                        cell.css("background-color", "rgb(158, 198, 202)");

                      if(date>hoy)
                      {
                        cell.css("background-color", "#eeeeee");
                      }
                      //////////////el siguienet codigo es para poner color en el dia en que se realizo el reporte en caso de estar actualizando
                      @if(isset($reporte->fecha))
                        if(date.diff(fecha_reporte, 'days')==0 && band_fecha_reporte==0)
                        {
                          //alert(date);
                          band_fecha_reporte=1;
                          
                          $("#fecha_seleccionada").html(dia+"/"+mes+"/"+date.year());
                          $("#fecha_seleccionada").show(100);
                          if(date.day()!={{ $grupo_seleccionado->dia }}-1)
                          {
                            $("#fecha_seleccionada").attr("class", "badge bg-yellow");

                            $("#dia_seleccionado").html("El dia seleccionado es diferente al dia de su grupo.")
                            $("#dia_seleccionado").attr("class", "badge bg-yellow");
                            $("#dia_seleccionado").show(100);
                          }
                          
                        }
                      @endif
                    },

                    //Random default events
                    events: [
                        @if(isset($grupo_seleccionado->id))
                          @foreach($grupo_seleccionado->reportes as $reporte_aux)
                          <?php $fecha=explode("-", $reporte_aux->fecha); 
                                $puntos="";
                                if(strlen($reporte_aux->tema)>20)
                                  $puntos="...";
                          ?>
                          {
                              title: '{{substr($reporte_aux->tema, 0, 20).$puntos}}',
                              start: new Date({{$fecha[0]}}, {{($fecha[1])-1}}, {{$fecha[2]}}),
                              allDay: true,
                              url: '/reporte-grupos/perfil/{{ $reporte_aux->id }}',
                              backgroundColor: "#0073b7", //Primary (light-blue)
                              borderColor: "#0073b7" //Primary (light-blue)
                          },
                          @endforeach
                        @endif

                    ],
                     // this allows things to be dropped onto the calendar !!!
                    selectable: true,

                @else /// en caso de que no se haya elegido aun un grupo
                    dayRender: function( date, cell ) {
                      
                      
                        cell.css("background-color", "#eeeeee");
                    },
                @endif////// se cierra el if BLADE que me verifica si enviaron el asistente por la URL


                    editable: false,
                    droppable: false
                    
                });
            