<?php

return array(
//////////////////////// --- Lista de Grupos -----//////////////////////////

	// NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista LISTA DE GRUPOS empesaran con "lg" 

	"lg_title" => "Lista de Grupos", //este es para el título del navegador
    "lg_header" => "LISTA DE GRUPOS", //este es para el título de la sección
    "lg_subtitulo" => "Aquí encontraras los grupos registrados en la iglesia.",

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
    "lg_fil_ver" => "Ver", // este es el VER, que aparece abajo de cada FILTRO

    // Los TITLES  de los FILTROS (los cuadros de colores con Todos, nuevos sin actividad etc...), estos son los mensajes que aparecen a poner el cursor title=ttl
	"lg_ttl_todos" => " Muestra todos los grupos de la iglesia, excepto los dados de baja." ,
	"lg_ttl_nuevos" => " Muestra todos los últimos grupos que se han creado en los últimos 30 días." ,
	"lg_ttl_sin_actividad" => " Muestra todos los grupos que no se han reportado en los últimos 30 días. " ,
	"lg_ttl_dados_baja" => " Muestra los grupos que se han dado de baja." ,
    "lg_ttl_sin_lider" => " Muestra los grupos que no tiene lider." ,

	// Estos son los titulos de las columnas, es decir los <th>, 
	"lg_th_1"=> "Información Principal",
	"lg_th_2"=> "Información de contacto",
	"lg_th_3"=> "Especificaciones del Grupo",
	
    
    // Labes del formularios de nuevo grupo label=lb  
	"lg_lb_codigo"=>"Cod",
	"lg_lb_nombre"=>"Nombre",
	"lg_lb_rhema"=>"Rhema",
	"lg_lb_fecha_creacion"=>"Fecha de creación ",
	"lg_lb_dia_reunion"=>"Día de reunión",
	"lg_lb_tipo_grupo"=>"Tipo de grupo",
	"lg_lb_red"=>"Red(es)",
    "lg_lb_linea"=>"Linea",


    // los data-original-title son los mensajitos que aparecen cuando se pasa el puntero de mouse
    // ttl = ttl
    "lg_ttl_codigo" => "codigo",
    "lg_ttl_nombre" => "Nombre del grupo",
    "lg_ttl_rhema" => "Palabra rhema",
    "lg_ttl_fecha_creacion" => "Fecha de creación de grupo AAAA/MM/DD",
    "lg_ttl_direccion" => "Dirección",
    "lg_ttl_telefono" => "Teléfono",
    "lg_ttl_dia_reunion" => "Día de reunión",
    "lg_ttl_tipo_grupo" => "Tipo de grupo",
    "lg_ttl_red" => "Red(es)",
    "lg_ttl_linea" => "Linea a la que pertenece el grupo",


   
    //////////////////////// --- Nuevo Grupos -----//////////////////////////

    // NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista NUEVO GRUPO empesaran con "ng" 

	"ng_title" => "Nuevo Grupo", //este es para el título del navegador
    "ng_header" => "NUEVO GRUPO", //este es para el título de la sección
    "ng_subtitulo" => "Aquí podras ingresar nuevos los grupos.",
               	     
    // Titulos de las sesiones de los formularios y modales  modal-title= mt
    "ng_mt_informacion_principal" => " Información principal ",
    "ng_mt_especificaciones" => " Especificaciones de grupo ",
    "ng_mt_lideres" => " Lideres y servidores ",
    "ng_mt_asistentes" => " Lista de asistentes ",
    "ng_mt_seleccione_linea" => " Seleccione la linea ",
    "ng_mt_añadir_lider" => " Añadir lider ",
    "ng_mt_añadir_servidores" => " Añadir servidores ",
    "ng_mt_añadir_asistentes" => " Añadir asistentes ",


    // Labes del formularios de nuevo grupo label=lb 
    "ng_lb_nombre" => "Nombre",
    "ng_lb_telefono" => "Teléfono",
    "ng_lb_direccion" => "Dirección",
    "ng_lb_rhema" => "Versículo rhema",    
    "ng_lb_dia" => "Día de reunión",
    "ng_lb_hora_reunion" => "Hora de reunión",
    "ng_lb_fecha_creacion" => "Fecha de creación",
    "ng_lb_linea" => "¿A qué línea pertenece? ",
    "ng_lb_lider" => "Añada los lideres del grupo: ",
    "ng_lb_redes" => "¿A qué red(es) pertenece el grupo?  ",
    "ng_lb_tipo_grupo" => "¿Qué tipo de grupo es?",
    "ng_lb_servidores" => "Añada las personas que tiene funciones o cumplen con un servicio dentro del grupo: ",
    "ng_lb_asistentes" => "Añade las personas que asisten al grupo:",
    "ng_lb_codigo" => "Cod",
    "ng_lb_codigo_del" => "Id of ",


    // placeholder de los formularios placeholder=ph 
    "ng_ph_nombre" => "Escribe el nombre del grupo. ", 
    "ng_ph_telefono" => " Escribe el telefono de donde se reune el grupo. ", 
    "ng_ph_direccion" => " Escribe la direccion donde se reune el grupo. ", 
    "ng_ph_rhema" => "Escribe el versiculo rhema del grupo, Ej: Isaias 60:1-3 ",
    "ng_ph_linea" => "Por favor, seleccione la linea",

    // botones
    "ng_bt_linea" => "Seleccionar línea",
    "ng_bt_lider" => "Añadir lider",
    "ng_bt_servidor" => "Añadir servidor",
    "ng_bt_asistentes" => "Añadir asistenes",

    // <th> de las tablas  th=th

    "ng_th_codigo" => "CODIGO",
    "ng_th_lider_grupo" => "LIDER DE GRUPO",
    "ng_th_linea" => "LINEA",
    "ng_th_lider_linea" => "LIDER DE LINEA",
    "ng_th_lider" => "LIDER",
    "ng_th_servidor" => "SERVIDOR",
    "ng_th_cargo" => "CARGO",
    "ng_th_grupo" => "GRUPO",
    "ng_th_id" => "IDENTIFICACIÓN",
    "ng_th_asistente" => "ASISTENTE",

    // los data-original-title son los mensajitos que aparecen cuando se pasa el puntero de mouse
    // ttl = ttl

    "ng_ttl_linea"=> "Codigo de la linea",

    //Informes de grupo
    "ig_title" => "Informes de Grupos", //este es para el título del navegador

    
);

?>