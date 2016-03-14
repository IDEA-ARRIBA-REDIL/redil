<?php
include '../app/views/includes/terminos.php'; 

return array(
//////////////////////// --- Lista de Grupos -----//////////////////////////

	// NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista LISTA DE GRUPOS empezarán con "lg" 

	"lg_title" => "Lista de $termino_grupo->plural", //este es para el título del navegador
    "lg_header" => "<span class='mayusculas'> lista de $termino_grupo->plural </span>", //este es para el título de la sección
    "lg_subtitulo" => "Aquí encontrarás ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural $texto_registrado_plural en su ministerio.",
    "lg_titulo_pestaña"=>"Redil",
    

    // botones=bt
    "lg_bt_nuevo" => "Nuevo Grupo", // Boton Nuevo Grupo
    "lg_bt_opciones" => "Opciones",

        // es el menu que despliega el boton OPCIONES  
        "lg_bt_opciones_0" => "Ver perfil",
    	"lg_bt_opciones_1" => "Modificar",
    	"lg_bt_opciones_2" => "Eliminar",
    	"lg_bt_opciones_3" => "Dar de baja",

    // Los filtros son los cuadros     filtros= fil
    "lg_fil_todos" => "Todos",
    "lg_fil_nuevos" => "Nuevos",
    "lg_fil_sin_actividad" => "Sin actividad",
    "lg_fil_dados_baja" => "Dados de Baja",
    "lg_fil_sin_lider" => "$termino_grupo->plural sin lideres",
    "lg_fil_ver" => "Ver", // este es el VER, que aparece abajo de cada FILTRO

    // Los TITLES  de los FILTROS (los cuadros de colores con Todos, nuevos sin actividad etc...), estos son los mensajes que aparecen a poner el cursor title=ttl
	"lg_ttl_todos" => " Muestra $texto_todos ".Helper::articulo($termino_grupo->genero, 'plural' )." $termino_grupo->plural de su ministerio, excepto ".Helper::articulo($termino_grupo->genero, 'plural' )." $texto_dado de baja." ,
	"lg_ttl_nuevos" => " Muestra ".Helper::articulo($termino_grupo->genero, 'plural' )." $termino_grupo->singular que se han creado en los últimos 30 días." ,
	"lg_ttl_sin_actividad" => " Muestra ".Helper::articulo($termino_grupo->genero, 'plural' )." $termino_grupo->plural que no se han reportado en los últimos 30 días. " ,
	"lg_ttl_dados_baja" => " Muestra ".Helper::articulo($termino_grupo->genero, 'plural' )." $termino_grupo->plural que se han dado de baja." ,
    "lg_ttl_sin_lider" => " Muestra ".Helper::articulo($termino_grupo->genero, 'plural' )." $termino_grupo->plural que no tienen lider." ,

	// Estos son los titulos de las columnas, es decir los <th>, 
	"lg_th_1"=> "Información Principal",
	"lg_th_2"=> "Información de contacto",
	"lg_th_3"=> "Especificaciones del $termino_grupo->singular",
	
    
    // Labes del formularios de nuevo grupo label=lb  
	"lg_lb_codigo"=>"Cod",
	"lg_lb_nombre"=>"Nombre",
	"lg_lb_rhema"=>"Rhema",
	"lg_lb_fecha_creacion"=>"Fecha de apertura ",
	"lg_lb_dia_reunion"=>"Día de reunión",
	"lg_lb_tipo_grupo"=>"Tipo de $termino_grupo->singular",
	"lg_lb_red"=>"Red(es)",
    "lg_lb_linea"=>"$termino_linea->singular",
    "lg_al_dia_title" => "El grupo se encuentra al día con sus reportes",
    "lg_al_dia" => "Grupo al día",


    // los data-original-title son los mensajitos que aparecen cuando se pasa el puntero de mouse
    // ttl = ttl
    "lg_ttl_codigo" => "codigo",
    "lg_ttl_nombre" => "Nombre del $termino_grupo->singular",
    "lg_ttl_rhema" => "Palabra rhema",
    "lg_ttl_fecha_creacion" => "Fecha de creación de grupo AAAA-MM-DD",
    "lg_ttl_direccion" => "Dirección",
    "lg_ttl_telefono" => "Teléfono",
    "lg_ttl_dia_reunion" => "Día de reunión",
    "lg_ttl_tipo_grupo" => "Tipo de $termino_grupo->singular",
    "lg_ttl_red" => "Red(es)",
    "lg_ttl_linea" => "$termino_linea->singular a la que pertenece el $termino_grupo->singular",
    "texto_simple_busqueda_detallada"=>"Proximamente busqueda detallada ... ",
    "texto_resultado_busqueda"=>"La busqueda arrojó",
    "texto_simple_termino_grupo_singular"=>"<span class='capitalize'>$termino_grupo->singular </span>",
    "texto_simple_termino_grupo_plural"=>"<span class='capitalize'>$termino_grupo->plural </span>",
    "texto_place_holder_busqueda"=>" Busque aqui ",
    "texto_simple_paginado_singular"=>"Página",
    "texto_simple-campo_ultimo_reporte"=>"Ultimo reporte:",
    "texto_simple-campo_nunca_reportado"=>"Nunca ha reportado",
    "texto_simple_dar_alta_grupo"=>"Dar de alta",
    "texto_simple_registros"=>"Registros",

   
    //////////////////////// --- Nuevo Grupos -----//////////////////////////

    // NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista NUEVO GRUPO empesaran con "ng" 

	"ng_title" => "$texto_nuevo_grupo $termino_grupo->singular", //este es para el título del navegador
    "ng_header" => " <span class='mayusculas'> $texto_nuevo_grupo  $termino_grupo->singular </span>", //este es para el título de la sección
    "ng_subtitulo" => "Aquí podrás ingresar $texto_nuevos $termino_grupo->plural.",
               	     
    // Titulos de las sesiones de los formularios y modales  modal-title= mt
    "ng_mt_informacion_principal" => " Información principal ",
    "ng_mt_especificaciones" => " Especificaciones de $termino_grupo->singular ",
    "ng_mt_lideres" => " Lideres y servidores ",
    "ng_mt_asistentes" => " Lista de $termino_asistente->singular ",
    "ng_mt_seleccione_linea" => " Seleccione la $termino_linea->singular ",
    "ng_mt_añadir_lider" => " Añadir lider ",
    "ng_mt_añadir_servidores" => " Añadir servidores ",
    "ng_mt_añadir_asistentes" => " Añadir $termino_asistente->plural ",


    // Labes del formularios de nuevo grupo label=lb 
    "ng_lb_nombre" => "Nombre",
    "ng_lb_telefono" => "Teléfono",
    "ng_lb_direccion" => "Dirección",
    "ng_lb_rhema" => "Versículo rhema",    
    "ng_lb_dia" => "Día de reunión",
    "ng_lb_hora_reunion" => "Hora de reunión",
    "ng_lb_fecha_creacion" => "Fecha de creación",
    "ng_lb_linea" => "¿A qué línea pertenece? ",
    "ng_lb_lider" => "Añada los lideres".Helper::articulo($termino_grupo->genero, 'singular')."$termino_grupo->singular: ",
    "ng_lb_redes" => "¿A qué red(es) pertenece ".Helper::articulo($termino_grupo->genero, 'singular')."  $termino_grupo->singular?  ",
    "ng_lb_tipo_grupo" => "¿Qué tipo de $termino_grupo->singular es?",
    "ng_lb_servidores" => "Añada las personas que tiene funciones o cumplen con un servicio dentro".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular: ",
    "ng_lb_asistentes" => "Añade las personas que asisten a $texto_este_grupo $termino_grupo->singular:",
    "ng_lb_codigo" => "Cod",
    "ng_lb_codigo_del" => "Codigo del",
    "ng_lb_codigo_de_la" => "Codigo de la",
    "ng_lb_cantidad_reuniones_mes" => "¿Cuantas veces se reunen en el mes?",
    "ng_lb_vez" =>  "{1} vez|[1,Inf] veces",
    "ng_title_cantidad_reuniones" => "Por ejemplo, debe elegir 4 veces si se reunen cada 8 días o 2 veces si se reunen cada 15 días.",


    // placeholder de los formularios placeholder=ph 
    "ng_ph_nombre" => "Escribe el nombre".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular. ", 
    "ng_ph_telefono" => " Escribe el telefono de donde se reune ".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular. ", 
    "ng_ph_direccion" => " Escribe la direccion donde se reune ".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular. ", 
    "ng_ph_rhema" => "Escribe el versiculo rhema ".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular, Ej: Isaias 60:1-3 ",
    "ng_ph_linea" => "Por favor seleccione la $termino_linea->singular",
    "ng_ph_lideres" => "Por selecciona el lider o los lideres",

    // botones
    "ng_bt_linea" => "Seleccionar $termino_linea->singular",
    "ng_bt_lider" => "Añadir lider",
    "ng_bt_servidor" => "Añadir servidor",
    "ng_bt_asistentes" => "Añadir asistenes",

    // <th> de las tablas  th=th

    "ng_th_codigo" => "CODIGO",
    "ng_th_lider_grupo" => "<span class='mayusculas'>LIDER DE $termino_grupo->singular</span>.",
    "ng_th_linea" => "<span class='mayusucula'> $termino_linea->singular</span>",
    "ng_th_lider_linea" => "span class='mayusucula'>LIDER DE $termino_linea->singular </span>",
    "ng_th_lider" => "LIDER",
    "ng_th_servidor" => "SERVIDOR",
    "ng_th_cargo" => "CARGO",
    "ng_th_grupo" => "<span class='mayusucula'>$termino_grupo->singular ",
    "ng_th_id" => "IDENTIFICACIÓN",
    "ng_th_asistente" => "<span class='mayusucula'> $termino_asistente->singular </span>",
    "ng_th_nombre" => "NOMBRE",
    "ng_th_grupo" => "<span class='mayusculas'>$termino_grupo->singular </span>",


    // los data-original-title son los mensajitos que aparecen cuando se pasa el puntero de mouse
    // ttl = ttl

    "ng_ttl_linea"=> "Codigo de la $termino_linea->singular",

    // Mensaje que aparece cuando se guarda

    "ng_msn_parte_1" => "<span class='capitalize'> $termino_grupo->singular creado exitosamente </span>",
    "ng_msn_parte_2" => "El nuevo $termino_grupo->singular con código",
    "ng_msn_parte_3" => "con nombre",
    "texto_simple_campos_obligatorios"=>"Campos obligatorios",
 ///////// AÑADIR LIDERS COMPLEMENTO VISTA NUEVO GRUPO ///////////
    "texto_simple_cod_grupo"=>"Cod. ",
    "texto_simple_grupo"=>"$termino_grupo->singular",

    "texto_pestaña_anadir_lideres"=>"Añadir Lideres",
    "texto_pestaña_info_principal"=> "Información Principal",
    "texto_pestaña_anadir_asistentes"=>"Añadir Integrantes",
    "texto_titulo_info_ministerial"=>"Información ministerial",
    "texto_campo_encargados_grupo"=>"Seleccione los encargados del $termino_grupo->singular: ",
    "texto_campo_placeholder_encargado"=>"Buscar $termino_asistente->singular por código, nombre o cédula...",
    "texto_simple_campo_resultado_busqueda"=>" Mostrando 0 resultados de 0",
    "texto_titulo_servidores_grupo"=>" Servidores del $termino_grupo->singular",
    "texto_campo_selecciona_servidores_grupo"=>"Seleccione los servidores".Helper::articulo($termino_grupo->genero, 'singular'). ":",
    "texto_campo_placeholder_servidor"=>" Buscar $termino_asistente->singular por código, nombre o cédula... ",
    "texto_simple_cantidad_de_resultados"=>" Mostrando 0 de 0",
    "texto_simple_esto"=>"$texto_este_grupo ",
    "texto_simple_mostrando_cantidad_resultados"=>"Mostrando 10 de 100",
/////////////AÑADIR ASISTENTES COMPLEMENTO VISTA NUEVO GRUPO////////////////////////////
    "texto_titulo_info_ministerial_grupo"=>"Información ministerial de ".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular",
    "texto_campo_integrantes_grupo"=>"Seleccione el (los) integrante(s) de ".Helper::articulo($termino_grupo->genero, 'singular')." $termino_grupo->singular",
    'texto_mensaje_modal_cambio_asistente'=>'"'.Helper::articulo($termino_asistente->genero , 'singular').' '.$termino_asistente->singular.' <b>cod. "+id_asistente+" "+nombre_asistente+"</b> ya es integrante de '.$texto_este_grupo.' '.$termino_grupo->singular.'."',
    'texto_mensaje_asistente_seleccionado_titulo'=>'"No es posible añadir '.Helper::articulo($termino_asistente->genero, 'singular').' '.$termino_asistente->singular.'."',
    'texto_mensaje_modal_cambio_asistente_es_pastor'=>'"'.Helper::articulo($termino_asistente->genero , 'singular').' '.$termino_asistente->singular.' <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es uno de los pastores principales de la iglesia."',
    'texto_mensaje_modal_cambio_asistente_es_encargado'=>'"'.Helper::articulo($termino_asistente->genero , 'singular').' '.$termino_asistente->singular.' <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es uno de los encargados indirectos de '.$texto_este_grupo.' '.$termino_grupo->singular.'."',
    'texto_mensaje_modal_cambio_asistente_es_encargado_directo'=>'"'.Helper::articulo($termino_asistente->genero , 'singular').' '.$termino_asistente->singular.' <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es uno de los encargados de '.$texto_este_grupo.' '.$termino_grupo->singular.'."',
    'texto_mensaje_modal_cambio_asistente_pertenece_otro_grupos'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con  <b>cod. "+id_asistente+" "+nombre_asistente+"</b> pertenece a '.Helper::articulo($termino_grupo->genero, "singular").' '.$termino_grupo->singular.' "+id_grupo+" - "+nombre_grupo+". <br><br> Puedes solicitar el traslado '.Helper::articulo($termino_asistente->genero, "singular", "de").' '.$termino_asistente->singular.' y esperar a que alguno de los lideres correspondientes o el Super Administrador acepte tu solicitud."',
    'texto_modal_titulo_asistente_otro_grupo'=>'"'.Helper::articulo($termino_grupo->genero, 'singular').' '.$termino_asistente->singular.' se encuentra en '.$texto_otro_grupo.' '.$termino_grupo->singular.'."',
    'texto_modal_mensaje_asistente_otro_grupo_sin_linea'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.'con  <b>cod. "+id_asistente+" "+nombre_asistente+"</b> esta encargado de:<br><br> <b>"+cant_grupos+" '.$termino_grupo->singular.'(s)<br>"+cant_discipulos+" '.$termino_asistente->singular.'(s)</b><br><br>¿Desea trasladarlo junto con su ministerio?"',
    'texto_modal_mensaje_asistente_otro_grupo_con_linea_'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> pertenece a '.Helper::articulo($termino_grupo->genero, "singular").' '.$termino_grupo->singular.' No "+id_grupo+" - "+nombre_grupo+" "',
    'texto_modal_mensaje_asistente_otro_grupo_con_linea_con_grupo'=>'" y esta encargado de: <br><br> <b>"+cant_grupos+"'.$termino_grupo->singular.'(s)<br>"+cant_discipulos+" '.$termino_asistente->singular.'(s)</b> <br><br>¿Desea trasladarlo junto con su ministerio?"',
    'texto_modal_mensaje_asistente_otro_grupo_con_linea_sin_grupo'=>'"<br><br>¿Desea trasladarlo a'.$texto_este_grupo.' '.$termino_grupo->singular.'?"',
    'texto_alert_error_traslado_asistente'=>'"Hubo un error al asignar el integrante"',
    'texto_alert_error_eliminar_asistente'=>'"Hubo un error al eliminar el integrante"',
    'texto_mensaje_no_hay_integrantes_grupo'=>" <p id='mensaje_no_hay'>No hay ".$termino_asistente->plural." ".$texto_seleccionada_plural." para ".$texto_este_grupo."   ".$termino_grupo->singular."</p>",
    'texto_mensaje_error_asignar_servicio'=>'"Hubo un error al asignar el tipo de servicio"',
    'texto_mensaje_error_eliminar_servidor'=>'Hubo un error al eliminar el servidor',
    'texto_mensaje_error_eliminar_servidor'=>'Hubo un error al asignar el servidor',
    'texto_mensaje_asistente_ya_es_encargado'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> ya es servidor de'.$texto_este_grupo.' '.$termino_grupo->singular.'."',
    'texto_servidores_seleccionados_panel'=>"<p id='mensaje_no_hay'>No hay servidores seleccionados para $texto_este_grupo $termino_grupo->singular </p>",
    'texto_mensaje_no_lideres_asignados'=>"<p id='mensaje_no_hay'>No hay lideres seleccionados para".Helper::articulo($termino_grupo->genero, 'singular')." ".$termino_grupo->singular.".</p>",
    'texto_mensaje_asistente_inhabilitado_falta_asignar_grupo_encargado'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' actual encargado '.Helper::articulo($termino_grupo->genero, "singular" , "de").' '.$termino_grupo->singular.' no pertenece a '.$texto_ningun_grupo.' '.$termino_grupo->singular.'. Para poder añadir mas encargados a '.$texto_este_grupo.' '.$termino_grupo->singular.' deberá asignarle primeramente '.$texto_un_grupo.' '.$termino_grupo->singular.' al actual encargado."',
    'texto_boton_asignar_grupo'=>'"Asignar a'.$texto_un_grupo.' '.$termino_grupo->singular. '."',   
    'texto_mensaje_asistente_inhabilitado_falta_asignar_linea'=>'" '.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> no esta '.$texto_asignado_asistente.' a '.$texto_ningun_linea.' '.$termino_linea->singular.'<br>Para poder ser encargado de '.$texto_un_grupo.' '.$termino_grupo->singular.' debe asignarlo primeramente a '.$texto_un_linea.' '.$termino_linea->singular .'."',
    'texto_boton_asignar_linea'=>"'Asignar a ".$texto_un_linea."  ".$termino_linea->singular.".'",
    'texto_mensaje_asistente_nuevo_encargado_sin_grupo'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> no asiste a '.$texto_ningun_grupo.'  '.$termino_grupo->singular.'<br>Para poder ser encargado de '.$texto_un_grupo.' '.$termino_grupo->singular.' debe asignarlo a '.$texto_un_grupo.'  '.$termino_grupo->singular.' primeramente."',
    'texto_mensaje_asistente_pertenece_a_linea_diferente'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> pertenece a '.$texto_este_grupo.'  '.$termino_grupo->singular.' diferente al de los lideres ya seleccioandos. <br><br> Para añadirlo como lider de '.$texto_este_grupo.'  '.$termino_grupo->singular.' debes cambiarlo primero a '.Helper::articulo($termino_grupo->genero, "singular").'  '.$termino_grupo->singular.' con <b>cod. "+grupo_lider+" :grupo</b>"',
    'texto_boton_cambiar_de_grupo'=>"'Cambiarlo de ".$termino_grupo->singular."'",
    'texto_mensaje_lider_asistente_ya_es_encargado_de_grupo'=>'"'.Helper::articulo($termino_asistente->genero, "singular").' '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> ya es lider de '.$texto_este_grupo.'  '.$termino_grupo->singular.'."',
    'texto_mensaje_asistentes_miembro_del_grupo'=>'"'.Helper::articulo($termino_asistente->genero, "singular").'  '.$termino_asistente->singular.' con <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es integrante de'.$texto_este_grupo.' '.$termino_grupo->singular.'."',
    /////////////////////// --- Actualizar Grupos -----//////////////////////////

     // NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista ACTUALIZAR GRUPO empesaran con "ag" 

    "ag_title" => "Actualizar $termino_grupo->singular", //este es para el título del navegador
    "ag_header" => "<span class='mayusculas'> ACTUALIZAR $termino_grupo->singular </span>", //este es para el título de la sección
    "ag_subtitulo" => "Aquí podrás actualizar la información de ".Helper::articulo($termino_grupo->genero , 'singular' )." $termino_grupo->singular.",


    "ag_msn_parte_1" => "$termino_grupo->singular actualizado exitosamente",

    ///////ASISTENTE GRUPOS PDF ///////
    "texto_titulo_pagina_pdf"=>"<span class='mayusculas'> reporte ".$termino_asistente->plural ." de ".$termino_grupo->singular.":</span>",
    "texto_simple_pagina"=>"",


    //INFORMES DE GRUPOS
    "ig_title" => "Informes de $termino_grupo->plural", //este es para el título del navegador
    "ig_header" => "<span class='mayusculas'> Informes de $termino_grupo->plural </span>", //este es para el título de la sección
    "ig_subtitulo" => "Aquí encuentras todos los informes disponibles de ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural $texto_registrado_plural en su ministerio.",

    "informe_promedio_asistencia_titulo" => "Informe promedio mensual de asistencia a ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural",
    "informe_promedio_asistencia_descripcion" => "En este informe podrá ver el promedio de asistencia de cada mes en el rango de fecha especificado de $texto_todos_grupo ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural de tu ministerio.",
    "ig_th_informacion_grupo" => "Información del grupo",

    //informe catidad reportes
    "informe_cantidad_reportes_titulo" => "Informe cantidad de reportes de ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural",
    "informe_cantidad_reportes_descripcion" => "En este informe podrá ver la cantidad de reportes de cada mes en el rango de fecha especificado de $texto_todos_grupo ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural de tu ministerio.",

    //informe catidad integrantes
    "informe_cantidad_integrantes_titulo" => "Informe historial cantidad de integrantes de $termino_grupo->plural por mes",
    "informe_cantidad_integrantes_descripcion" => "En este informe podrá ver un historial de la cantidad de integrantes de cada mes en el año especificado de $texto_todos_grupo ".Helper::articulo($termino_grupo->genero, 'plural')." $termino_grupo->plural de tu ministerio.",
    //PERFIL DEL GRUPO//////

    "texto_titulo_pagina_perfil"=>"<span class='mayusculas'> perfil ".Helper::articulo($termino_grupo->genero, "singular" , "de")." $termino_grupo->singular </span>",
);

?>