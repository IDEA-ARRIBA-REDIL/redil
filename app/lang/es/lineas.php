<?php
// php del lenguaje en español para la lista de las lineas
// creado por Darwin Castaño
// fecha creacion: 22-07-2014
//fecha ultima modificacion: 24/07/2014 15:17
// redil version 1.0
// ultima modificacion darwin castaño
return array(
	///////ojo leer indicaciones para entender las variables de ///////
	/////lenguaje pertenecientes a cada vista de la categoria departamentos/////
//////////////////////// --- Lista de Lineas  ll=lista lineas prefijo para la vista, lb=label,bt=botn,ph=placeholder, md=modal -----//////////////////////////
	"ll_title" => "Lista de Lineas", //este es para el título del navegador
    "ll_header" => "LISTA DE LINEAS", //este es para el título de la sección
    "ll_subtitulo" => "Aqui encontraras todos las Lineas la iglesia que se hallan registrado y que esten activas.",
    'll_bt_nuevo_lista' => 'Nueva Linea', // Boton Nuevo Grupo
 ////////////////////////fin ////////////////////////////

 ///////encabezado tabla th=thead, tb=tabla///////
 "ll_tb_th1"=>"Informacion",
 "ll_tb_th2"=>"Descripción",
 "ll_tb_th3"=>"Lider de Linea",

 /// contenido de la tabla lb=label ////
 "ll_lb_codigo"=>"cod",
 "ll_lb_nombre_linea"=>"Nombre de Linea",
 "ll_lb_descripcion"=> "Descripción",
 //// title en cada uno de los label tit=title sencillo////
 "ll_lb_tit_codigo"=>"cod",
 "ll_lb_tit_nombre_linea"=>"Nombre de Linea",
 "ll_lb_tit_descripcion"=> "Descripción",
 "ll_lb_tit_nombre"=>"Nombre",

//////boton dentro de la tabla//////////
 "ll_bt_opciones"=>"Opciones",
 	////listado dentro del boton opciones
	 "ll_lb_ver_perfil" =>"Ver perfil",
	 "ll_lb_modificar"=>"Modificar",
	 "ll_lb_eliminar"=> "Eliminar",
	 "ll_lb_dar_de_baja"=> "Dar de baja",
    
     ////////////////////////fin  listado de las lineas//////////////////////////// 


//////////////////////// --- Nueva Linea -----//////////////////////////

"nl_title" => "Redil| Nueva Linea", //este es para el título del navegador
"nl_header" => "NUEVA LINEA", //este es para el título de la sección
"nl_subtitulo" => "Desde este lugar podrás agregar una Nueva Linea.",
'nl_bt_guardar' => 'Guardar', // Boton guardar superior

   //// contenido formulario //////
    "ln_mt_titulo"=>"Información para crear una Nueva Linea.",//mt=modal title,titulo de los contenidos dentro del formulario
    "ln_lb_nombre_linea"=>"Nombre Linea",
    	///placeholder de nombre
    		"ln_ph_nombre"=>"Nombre...",
	"ln_lb_descripcion"=>"Descripción",
	"ln_lb_palabra_rhema"=> "Palabra Rhema",
	   /// placeholder palabra rhema
			"ln_ph_rhema"=> "Salmos1:1-3",
	
	"ln_lb_añadir_lider"=>"Añadir Lider",
	/// contenido minitabla de añadir lideres
	"ln_th_tabla_añadir_id"=>"id",
	"ln_th_mini_tabla_añadir_lider"=>"Lider (es) de Linea",
	'nl_bt_inf_guardar' => 'Guardar', // Boton guardar inferior
	////////////////fin contenido formulario//////

	////////modal/////////

	"ln_md_titulo"=>"Seleccione Lider",
	"ln_md_tb_lider"=> "Lider",
	"ln_md_tb_grupo"=> "Grupo",
	"ln_md_tb_añadir"=>"Añadir",
	 	//// codigo y nombre dentro del listado del modal

			"ln_lb_md_codigo"=>"Cod",
			"ln_lb_md_nombre"=>"Nombre",
	///////fin modal/////////////

    ////titulo de los labels
///////////////////////fin de nueva linea////////////////////////

			//////////////////actualizar linea///////////////

	"al_title" => "Redil| Actualizar Linea", //este es para el título del navegador
	"al_header" => "Actualizar Linea", //este es para el título de la sección
	"al_subtitulo" => "Desde este lugar podras actualizar los datos de la Linea escogida.",
	'al_bt_guardar' => 'Guardar', // Boton guardar superior
	'al_bt_volver' => 'Cancelar', // Boton cancelar superior
	'al_bt_dar_de_baja' => 'Dar de baja', // Boton guardar superior

	 /////mensaje de actualizacion ms=mensaje///// 
	 "al_ms_ok_update"=> "<b>Actualizado Correctamente!</b> la linea  fue actualizada satisfactoriamente",

	//// contenido formulario //////
    "al_mt_titulo"=>"Escriba la informacion que desea modificar para esta Linea.",//mt=modal title,titulo de los contenidos dentro del formulario
    "al_lb_nombre_linea"=>"Nombre Linea",
    	///placeholder de nombre
    		"ln_ph_nombre"=>"Nombre...",
	"al_lb_descripcion"=>"Descripción",
	"al_lb_palabra_rhema"=> "Palabra Rhema",
	   /// placeholder palabra rhema
			"ln_ph_rhema"=> "Salmos1:1-3",
	
	"al_lb_añadir_lider"=>"Añadir Lider",
	/// contenido minitabla de añadir lideres
	"al_th_tabla_añadir_id"=>"id",
	"al_th_mini_tabla_añadir_lider"=>"Lider (es) de Linea",
	'al_bt_inf_guardar' => 'Guardar', // Boton guardar inferior
	////////////////fin contenido formulario//////

	////////modal/////////

	"al_md_titulo"=>"Seleccione Lider",
	"al_md_tb_lider"=> "Lider",
	"al_md_tb_grupo"=> "Grupo",
	"al_md_tb_añadir"=>"Añadir",
	 	//// codigo y nombre dentro del listado del modal

			"al_lb_md_codigo"=>"Cod",
			"al_lb_md_nombre"=>"Nombre",
	///////fin modal/////////////

			/////////////fin actualizar linea//////////////////
);

?>