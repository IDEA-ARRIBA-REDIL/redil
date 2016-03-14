<?php

return array(
//////////////////////// --- Lista de Escuelas -----//////////////////////////

	// NOTA: por favor lea lo siguiente,  las variables de leneuaje de la vista LISTA DE ESCUELAS empezarán con "le" 

	"le_title" => "Lista de Escuelas", //este es para el título del navegador
    "le_header" => "LISTA DE ESCUELAS", //este es para el título de la sección
    "le_subtitulo" => "Aquí encontrarás las escuelas de la iglesia.",

    // placeholder de los formularios placeholder=ph 
    "ne_ph_nombre" => "Escribe el nombre de la escuela.", 
    "ne_ph_descripcion" => " Escribe una descripción acerca de la escuela. ", 
    "ne_ph_director" => " Selecciona el director de la Escuela. ", 

    // botones=bt
    "le_bt_nuevo" => "Nueva Escuela", // Boton Nueva Escuela
    "le_bt_opciones" => "Opciones",

        // es el menu que despliega el boton OPCIONES  
        "le_bt_opciones_0" => "Ver perfil",
    	"le_bt_opciones_1" => "Modificar",
    	"le_bt_opciones_2" => "Eliminar",
    	"le_bt_opciones_3" => "Dar de baja",

    // Los filtros son los cuadros     filtros= fil
    "le_fil_todos" => "Todos",
    "le_fil_dados_baja" => "Dados de Baja",
    "le_fil_ver" => "Ver", // este es el VER, que aparece abajo de cada FILTRO

    // Los TITLES  de los FILTROS (los cuadros de colores con Todos, nuevos sin actividad etc...), estos son los mensajes que aparecen a poner el cursor title=ttl
	"le_ttl_todos" => " Muestra todos las escuelas de la iglesia, excepto las dadas de baja." ,
	"le_ttl_dados_baja" => " Muestra las escuelas que se han dado de baja." ,

	// Estos son los titulos de las columnas, es decir los <th>, 
	"le_th_1"=> "Información Principal",
	"le_th_3"=> "Especificaciones de la Escuela",
	
    
    // Labes del formularios de nuevo grupo label=lb  
	"le_lb_codigo"=>"Cod",
	"le_lb_nombre"=>"Nombre",
	"le_lb_fecha_creacion"=>"Fecha de creación ",

    // los data-original-title son los mensajitos que aparecen cuando se pasa el puntero de mouse
    // ttl = ttl
    "le_ttl_codigo" => "codigo",
    "le_ttl_nombre" => "Nombre de la escuela",
    "le_ttl_fecha_creacion" => "Fecha de creación de grupo AAAA-MM-DD",
   
    //////////////////////// --- Nueva Escuela -----//////////////////////////

    // NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista NUEVA ESCUELA empesaran con "ne" 

	"ne_title" => "Nueva Escuela", //este es para el título del navegador
    "ne_header" => "NUEVA ESCUELA", //este es para el título de la sección
    "ne_subtitulo" => "Aquí podrás ingresar nuevas escuelas.",
               	     
    // Titulos de las sesiones de los formularios y modales  modal-title= mt
    "ne_mt_informacion_principal" => " Información principal ",
    "ne_mt_especificaciones" => " Especificaciones de la escuela ",
    "ne_mt_añadir_director" => " Añadir Director ",

    // Labes del formularios de nuevo grupo label=lb 
    "ne_lb_nombre" => "Nombre",
    "ne_lb_descripcion" => "Descripción",
    "ne_lb_director" => "Director",
    "ne_lb_fecha_creacion" => "Fecha de creación",

    // Mensaje que aparece cuando se guarda

    "ne_msn_parte_1" => "Escuela creada exitosamente con código",
    "ne_msn_parte_2" => "La nueva escuela con código",
    "ne_msn_parte_3" => "con nombre",

    /////////////////////// --- Actualizar Escuelas -----//////////////////////////

     // NOTA: por favor lea lo siguiente,  las variables de lenguaje de la vista ACTUALIZAR ESCUELA empesaran con "ae" 

    "ae_title" => "Actualizar Escuela", //este es para el título del navegador
    "ae_header" => "ACTUALIZAR ESCUELA", //este es para el título de la sección
    "ae_subtitulo" => "Aquí podrás actualizar la información de la escuela seleccionada.",

    "ae_msn_parte_1" => "Escuela actualizada exitosamente",


);

?>