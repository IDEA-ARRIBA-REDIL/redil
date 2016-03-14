<?php
// php del lenguaje en español para  departamentos
// creado por Darwin Castaño
// fecha creacion: 22-07-2014
//fecha ultima modificacion: 24/07/2014 15:15
// redil version 1.0
// ultima modificacion darwin castaño
return array(
//////////////////////// --- Lista de Departamentos -----//////////////////////////
	//////ojo leer indicaciones para entender las variables de ///////
	/////lenguaje pertenecientes a cada vista de la categoria departamentos/////
//////////////////////// --- Lista de Lineas  ll=lista lineas prefijo para la vista, lb=label,bt=botn,ph=placeholder, md=modal -----//////////////////
	"ld_title" => "Redil | Lista Departamentos", //este es para el título del navegador
    "ld_header" => "LISTA DE DEPARTAMENTOS", //este es para el título de la sección
    "ld_subtitulo" => "Aqui encontraras todos los Departamentos que presten algun tipo de servicio a la iglesia.",
    'ld_boton_nuevo' => 'Nuevo Departamento', // Boton Nuevo Grupo
 ////////////////////////fin ////////////////////////////

 ///////encabezado tabla///////
 "ld_tb_th1"=>"Informacion",
 "ld_tb_th2"=>"Descripción",
 "ld_tb_th3"=>"Director",
 "ld_tb_th4"=>"Fecha de creacion",

 /////titles dentro de la tabla en datatoggle///
  	"ld_tb_dt_tit_descripcion"=>"Descripción",
  	"ld_tb_dt_tit_departamento"=>"Departamento",
  	"ld_tb_dt_tit_nombre"=>"Nombre",
  	"ld_tb_dt_tit_fecha"=>"Fecha Creación",


 /// contenido de la tabla
 
 
 //////boton dentro de la tabla//////////
 "ld_bt_opciones"=>"Opciones",
 	////listado dentro del boton opciones
	 "ld_lb_ver_departamento" =>"Ver departamento",
	 "ld_lb_modificar"=>"Modificar",
	 "ld_lb_eliminar"=> "Eliminar",
	 
	 
		////////////////////////fin lista de departamentos/////////////////

	///////////////////nuevo departameno////////////////////////////
"nd_title"=> "Redil |Nuevo Departamento", //este es para el título del navegador	
"nd_header"=> "NUEVO DEPARTAMENTO", //este es para el título de la sección
"nd_subtitulo"=> "Aqui podras crear el departamento, o los  servidores del mismo.",
    
'nd_bt_guardar' => 'Guardar', // Boton guardar superior
	'nd_bt_volver' => 'Cancelar', // Boton cancelar superior
	'nd_bt_dar_de_baja' => 'Dar de baja', // Boton guardar superior

				/////fin header////

				/////////formulario for=formulario lb=label ph=placeholder//////
"nd_for_tit_info_principal"=>"Información Principal",
////aqui empiezan todos los campos del formulario///
"nd_for_lb_nombre"=>"Nombre",
	"nd_for_nombre_ph_form"=>"Salmistas...",

"nd_for_lb_descripcion"=>"Descripción",
	"nd_for_ph_descripcion"=>"Son los encargado de tocar el corazón de DIOS",

"nd_for_lb_rhema"=> "Palabra Rhema",
	"nd_for_ph_rhema"=>"Salmo 150, aclamad al señor con los instrumentos, con cuerdas y simbalos...",

"nd_for_btn_director"=>"Director del Departamento",
"nd_for_tb_th1_id_director"=>"id",
"nd_for_tb_th2_nombre_director"=>"Nombre Director(es)",

	"nd_for_lb_funciones_director"=>"Funciones del Director",
		"nd_for_ph_funciones_director"=>"Dirigir, escuchar, concretar y liderar tanto espiritualmente como musicalmente los miembros de la alabanza...",

"nd_for_lb_fecha_cre_departamento"=>"Fecha Creación Departamento",

"nd_for_title_servidores"=>"Integrantes de Departamento",
"nd_for_subtitulo_servidores"=>" aqui podra listar y agregar los integrantes del departamento que esta creando.",

"nd_bt_elegir_servidor"=>"Elegir integrante",
"nd_for_lb_servidor"=>"Integrante",

"nd_for_lb_cargo"=>"Cargo",
	"nd_for_ph_cargo"=> "bajista...",
"nd_for_lb_funciones_servidor"=>"Funciones del integrante",
	"nd_for_phfunciones_servidor"=>"Dirigir, escuchar, concretar y liderar tanto espiritualmente como musicalmente los miembros de la alabanza...",
"nd_bt_añadir_servidor"=>"Añadir integrante",
			/////////////fin formulario/////////

			/////////tabla servidores/////////

"nd_tb_th1_servidores"=>"Departamento",
"nd_tb_th2_servidores"=>"Integrante",
"nd_tb_th3_servidores"=>"Cargo",
"nd_tb_th4_servidores"=>"Funciones",
	
		////boton opciones dentro de la tabla////
		"nd_tb_bt_opciones"=>"Opciones",
			"nd_tb_lb_modificar"=>"Modificar",
			"nd_tb_lb_eliminar"=>"Eliminar",

			"nd_boton_inf_guardar"=>"Guardar",
			////////fin///////

	//////////////////fin tabla servidores//////////////

			/////////modal director///////////
 "nb_md_tit_director"=>"SELECCIONE EL DIRECTOR",

 		/////tabla dentro del modal////
 		"nb_md_th1_director"=>"Id",
 		"nb_md_th2_director"=>"Nombre",
 		"nb_md_th3_director"=>"Linea",
 		"nb_md_lb_cod_director"=>"Cod",
 			"nb_md_tit_cod_director"=>"Codigo",
 			"nb_md_tit_nom_director"=>"Nombre",
 			"nb_md_tit_nom_linea"=>"Nombre linea",
 	//////////////fin del modal director/////////////////

 			/////modal de integrantes/////

	"nb_md_tit_integrante"=>"SELECCIONE EL INTEGRANTE",
	"nb_md_th1_integrante"=>"Id",
 		"nb_md_th2_integrante"=>"Nombre",
 		"nb_md_th3_integrante"=>"Linea",
 		"nb_md_lb_cod_inegrante"=>"Cod",
 			"nb_md_tit_cod_integrante"=>"Codigo",
 			"nb_md_tit_nom_integrante"=>"Nombre",
 			"nb_md_tit_nom_linea"=>"Nombre linea",

/////////////////////////////////fin de nuevo departamento///////////////////

 			///////////////////actualizar departameno////////////////////////////
"ad_title"=> "Redil |Actualizar Departamento", //este es para el título del navegador	
"ad_header"=> "ACTUALIZAR DEPARTAMENTO", //este es para el título de la sección
"ad_subtitulo"=> "Aqui podras modificar un departamento agregar y/o modificar los  servidores al mismo.",

'ad_bt_guardar' => 'Guardar', // Boton guardar superior
	'ad_bt_volver' => 'Cancelar', // Boton cancelar superior
	'ad_bt_dar_de_baja' => 'Dar de baja', // Boton guardar superior

"ad_ms_ok_update"=> "<b>Actualizado Correctamente!</b> el departamento fue actualizado satisfactoriamente",
				/////fin header////

				/////////formulario for=formulario lb=label ph=placeholder//////
"ad_for_tit_info_principal"=>"Información Principal",
////aqui empiezan todos los campos del formulario///
"ad_for_lb_nombre"=>"Nombre",
	"ad_for_nombre_ph_form"=>"Salmistas...",

"ad_for_lb_descripcion"=>"Descripción",
	"ad_for_ph_descripcion"=>"Son los encargado de tocar el corazón de DIOS",

"ad_for_lb_rhema"=> "Palabra Rhema",
	"ad_for_ph_rhema"=>"Salmo 150, aclamad al señor con los instrumentos, con cuerdas y simbalos...",

"ad_for_btn_director"=>"Director del Departamento",
"ad_for_lb_director"=>"Director",
	"ad_for_lb_funciones_director"=>"Funciones del Director",
		"ad_for_ph_funciones_director"=>"Dirigir, escuchar, concretar y liderar tanto espiritualmente como musicalmente los miembros de la alabanza...",

"ad_for_lb_fecha_cre_departamento"=>"Fecha Creación Departamento",

"ad_for_title_servidores"=>"Integrantes de Departamento",
"ad_for_subtitulo_servidores"=>" aqui podra listar y agregar los integrantes del departamento que esta creando.",

"ad_bt_elegir_servidor"=>"Elegir integrante",
"ad_for_lb_servidor"=>"Integrante",

"ad_for_lb_cargo"=>"Cargo",
	"ad_for_ph_cargo"=> "bajista...",
"ad_for_lb_funciones_servidor"=>"Funciones del integrante",
	"ad_for_phfunciones_servidor"=>"Dirigir, escuchar, concretar y liderar tanto espiritualmente como musicalmente los miembros de la alabanza...",
"ad_bt_añadir_servidor"=>"Añadir integrante",
			/////////////fin formulario/////////

			/////////tabla servidores/////////

"ad_tb_th1_servidores"=>"Departamento",
"ad_tb_th2_servidores"=>"Integrante",
"ad_tb_th3_servidores"=>"Cargo",
"ad_tb_th4_servidores"=>"Funciones",
	
		////boton opciones dentro de la tabla////
		"ad_tb_bt_opciones"=>"Opciones",
			"ad_tb_lb_modificar"=>"Modificar",
			"ad_tb_lb_eliminar"=>"Eliminar",

			"ad_boton_inf_guardar"=>"Guardar",
			////////fin///////

	//////////////////fin tabla servidores//////////////

			/////////modal director///////////
 "ab_md_tit_director"=>"SELECCIONE EL DIRECTOR",

 		/////tabla dentro del modal////
 		"ab_md_th1_director"=>"Id",
 		"ab_md_th2_director"=>"Nombre",
 		"ab_md_th3_director"=>"Linea",
 		"ab_md_lb_cod_director"=>"Cod",
 			"ab_md_tit_cod_director"=>"Codigo",
 			"ab_md_tit_nom_director"=>"Nombre",
 			"ab_md_tit_nom_linea"=>"Nombre linea",
 	//////////////fin del modal director/////////////////

 			/////modal de integrantes/////

	"ab_md_tit_integrante"=>"SELECCIONE EL INTEGRANTE",
	"ab_md_th1_integrante"=>"Id",
 		"ab_md_th2_integrante"=>"Nombre",
 		"ab_md_th3_integrante"=>"Linea",
 		"ab_md_lb_cod_inegrante"=>"Cod",
 			"ab_md_tit_cod_integrante"=>"Codigo",
 			"ab_md_tit_nom_integrante"=>"Nombre",
 			"ab_md_tit_nom_linea"=>"Nombre linea",


//////////////////////////////////////////////////


/////////////////vista del perfil del departamento//////////////////////

 "pd_title"=> "Perfil|Departamento", //este es para el título del navegador	
"pd_header"=> "PERFIL DEL DEPARTAMENTO", //este es para el título de la sección
"pd_subtitulo"=> "Aqui podras observar las caracteristicas del departamento seleccionado.",

////contenidos de box bodys de cada descripcion del departamento/////

	"pd_bb1_title"=>"Información Principal",
	"pd_bb1_descripcion"=>"Descripción:",
	"pd_bb1_rhema"=>"Palabra Rhema:",
	"pd_bb1_fecha"=>"Fecha Creación:",

	"pd_bb2_title"=>"Director del Departamento",
	"pd_bb2_cod"=>"Cod:",
	"pd_bb2_funciones"=>"Funciones del Director",

	"pd_bb3_title"=>"Integrantes del Departamento",
	"pd_tb_th1_servidores"=>"Servidor",
	"pd_tb_th2_servidores"=>"Cargo",
	"pd_tb_th3_servidores"=>"Funciones",

























































    );
?>