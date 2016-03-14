@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} | {{ Lang::get('grupos.informe_cantidad_reportes_titulo') }}</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      @include('includes.styles')
      <!-- daterangepicker -->
      <link href="/css/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">
      <link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
      <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
      <script type='text/javascript' src='http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js?2'></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="skin-black" onload="mostrarCelulas()">
    <!-- header logo: style can be found in header.less -->
    @include('includes.header')
    <div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">                
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          @include('includes.menu')
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">                
      <!-- contendio cabezote -->
      <section class="content-header">
        <div class="box box-filtro" >
          <div class="box-header">
            <h3 class="content-header barra-titulo">
              <span class="mayusculas">{{ Lang::get('grupos.informe_cantidad_reportes_titulo') }}</span><br>
              <small>{{ Lang::get('grupos.informe_cantidad_reportes_descripcion') }} </small>
            </h3>  
          </div>
                  
          <div class="box-body">
          </div>
        </div>
      </section>
      <!-- /contendio cabezote -->
      
      <!-- contenido principal -->
      <section class="content">
        <!-- row de la tabla -->
        <div class="row">   
          <!-- div de 12 columnas -->                    
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="panel-body">
                <!-- tabla lista-->
                <div class="box-body">
                  <!--<div class="collapse" id="busqueda-avanzada">
                    <div class="well">
                      Proximamente busqueda detallada ... 
                    </div>
                  </div> --> 
                  <!-- div de busqueda-->
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      
                    <form id="filtros" action="" method="get" role="form" class="form-inline">
                      
                      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <div class="col-lg-8 col-md-10 col-sm-10 col-xs-10 no-padding" style="padding-right: 5px !important;">
                          <select id="rango" name="rango" class="form-control" style="width: 100%;">
                              <option value="1t" @if(isset($rango)) @if($rango=="1t") selected @endif @endif> Células Abiertas </option>
                              <option value="2t" @if(isset($rango)) @if($rango=="2t") selected @endif @endif> Células Cerradas </option>
                              <option value="3t" @if(isset($rango)) @if($rango=="3t") selected @endif @endif> Células Inactivas </option>
                              <option value="4t" @if(isset($rango)) @if($rango=="4t") selected @endif @endif> Células Dadas de baja </option>
                              <option value="1s" @if(isset($rango)) @if($rango=="1s") selected @endif @endif> Células Nuevas </option>
                          </select>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 no-padding" style="padding-right: 5px !important;">
                          <button class="btn btn-info" style="padding: 6px 10px;!important" type="submit">Ver</button>
                        </div> 
                      </div>          
                    </form>
                  </div>
                  <!-- fin div de busqueda-->
                  
                  <!-- div vacio-->
                  <div class="col-md-4">
                    
                  </div>
                   <!-- fin vacio-->
                   
                   <br><br><br>
                  <!--Mapa-->
                  <div id="map" style="width: 100%; height: 570px; border: 3px solid #DADADA;">
                  </div>
                  <!--Mapa-->
                </div>
                <!-- /tabla -->
              </div> <!-- /panel body -->  
                    

            </div><!-- /Box primary -->

          </div><!-- /Div de 12 columnas -->
        </div><!-- /row -->
      </section>
      <!-- contenido principal -->
    </aside>  
  </div>
    
    @include('includes.scripts')
      
    <!-- plugins para filtros -->
    <script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>
    <script type="text/javascript" src="/js/plugins/floatThead/jquery.floatThead.js"></script>

  

    <!-- page script -->
    <script type="text/javascript">

      $(document).ready(function() {
        $("#menu_grupos").children("a").first().trigger('click');
			});
    </script>

    <script>
      var map = L.map( 'map', {
        center: [4.088, -76.20],
        minZoom: 2,
        zoom: 14,
      });

      L.tileLayer( 'http://{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright" title="OpenStreetMap" target="_blank">OpenStreetMap</a> contributors | Tiles Courtesy of <a href="http://www.mapquest.com/" title="MapQuest" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png" width="16" height="16">',
        subdomains: ['otile1','otile2','otile3','otile4']
      }).addTo( map );

      map.on('click', function(e) {
        alert("La localización de su célula ha sido guardada exitosamente con Latitud: "+e.latlng.lat+ " y Longitud: "+e.latlng.lng);
      agregarCelula(e.latlng.lat,e.latlng.lng)
      });


        var IconoCelula = L.icon({
          iconUrl: '/img/celula.png',
          iconRetinaUrl: '/img/pin48.png',
          iconSize: [40, 45],
          iconAnchor: [27, 27],
          popupAnchor: [0, -14]
        });


    function mostrarCelulas(){

            agregarCelula(4.103566,-76.198323);
            agregarCelula(4.102566,-76.196323);
            agregarCelula(4.093366,-76.208323);
            agregarCelula(4.098178,-76.202373);
            agregarCelula(4.091757,-76.204605);
            agregarCelula(4.089873,-76.210870);
            agregarCelula(4.104684,-76.206235);
            agregarCelula(4.099066,-76.217023);
            agregarCelula(4.091266,-76.190023);
            agregarCelula(4.096566,-76.192323);
            agregarCelula(4.090566,-76.218323);
            agregarCelula(4.096066,-76.212023);
            agregarCelula(4.093266,-76.120023);
            agregarCelula(4.093566,-76.198323);
            agregarCelula(4.083566,-76.208323);
            agregarCelula(4.089066,-76.217023);
            agregarCelula(4.081266,-76.190023);
            agregarCelula(4.083566,-76.198323);
            agregarCelula(4.070066,-76.198323);
            agregarCelula(4.079066,-76.197023);
            agregarCelula(4.071266,-76.190023);
    }

    function agregarCelula(latitud,longitud){

      DatosCelula = [
                {
                 "info": "Nombre: La Oveja 100<br>Tipo: Abierta<br>Líder: Andrés Bravo<br>Anfitrión: Angie Aguirre<br>Dirección: Calle 3 # 24a-27 <br>Teléfono: 3186422019<br>Promedio de Asistencia: 9",
                 "url": "https://www.google.it/maps/@4.1035084,-76.1984207,3a,43.8y,38.31h,84.37t/data=!3m7!1e1!3m5!1s-agsPTNIkq1yxJxL1AVkCg!2e0!5s20131101T000000!7i13312!8i6656!6m1!1e1",
                 "lat": latitud,
                 "lng": longitud
                }
              ];

              L.marker( [DatosCelula[0].lat, DatosCelula[0].lng], {icon: IconoCelula}, {title: 'title'}, {alt: 'alt'} )
               .bindPopup( '<a href="' + DatosCelula[0].url + '" target="_blank">' + DatosCelula[0].info + '</a>' )
               .addTo( map );
    }

    function resetarMapa(){

      map.remove();
      map = L.map( 'map', {
        center: [4.085, -76.20],
        minZoom: 2,
        zoom: 14,
      });

      L.tileLayer( 'http://{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright" title="OpenStreetMap" target="_blank">OpenStreetMap</a> contributors | Tiles Courtesy of <a href="http://www.mapquest.com/" title="MapQuest" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png" width="16" height="16">',
        subdomains: ['otile1','otile2','otile3','otile4']
      }).addTo( map );

      map.on('click', function(e) {
        alert("La localización de su célula ha sido guardada exitosamente con Latitud: "+e.latlng.lat+ " y Longitud: "+e.latlng.lng);
        agregarCelula(e.latlng.lat,e.latlng.lng)
      });
    }

    $(function(){

         $(".mostrarcelulas").on('click', function(){

          resetarMapa();

              DatosCelula = [
                {
                 "info": "Nombre: Gracia de Dios<br>Tipo: Abierta<br>Líder: Andrés Bravo<br>Anfitrión: Angie Aguirre<br>Dirección: Calle 3 # 24a-27 <br>Teléfono: 3186422019<br>Promedio de Asistencia: 9",
                 "url": "https://www.google.it/maps/@4.1035084,-76.1984207,3a,43.8y,38.31h,84.37t/data=!3m7!1e1!3m5!1s-agsPTNIkq1yxJxL1AVkCg!2e0!5s20131101T000000!7i13312!8i6656!6m1!1e1",
                 "lat": 4.0609,
                 "lng": -76.201
                }
              ];

              L.marker( [DatosCelula[0].lat, DatosCelula[0].lng], {icon: IconoCelula}, {title: 'title'}, {alt: 'alt'} )
               .bindPopup( '<a href="' + DatosCelula[0].url + '" target="_blank">' + DatosCelula[0].info + '</a>' )
               .addTo( map );

               DatosCelula = [
                {
                 "info": "Nombre: La Oveja 100<br>Tipo: Abierta<br>Líder: Andrés Bravo<br>Anfitrión: Angie Aguirre<br>Dirección: Calle 3 # 24a-27 <br>Teléfono: 3186422019<br>Promedio de Asistencia: 9",
                 "url": "https://www.google.it/maps/@4.1035084,-76.1984207,3a,43.8y,38.31h,84.37t/data=!3m7!1e1!3m5!1s-agsPTNIkq1yxJxL1AVkCg!2e0!5s20131101T000000!7i13312!8i6656!6m1!1e1",
                 "lat": 4.089004,
                 "lng": -76.197318
                }
              ];

              L.marker( [DatosCelula[0].lat, DatosCelula[0].lng], {icon: IconoCelula}, {title: 'title'}, {alt: 'alt'} )
               .bindPopup( '<a href="' + DatosCelula[0].url + '" target="_blank">' + DatosCelula[0].info + '</a>' )
               .addTo( map );
          });
    });

    </script>
  </body>
</html>

@endif