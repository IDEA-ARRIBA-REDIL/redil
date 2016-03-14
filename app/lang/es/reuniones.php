<?php
include '../app/views/includes/terminos.php'; 

return array(

	//////INDEX REUNIONES, LISTADO DE REUNIONES////////////////

	"texto_reporte_index_titulo_pagina"=>"Redil",
	"texto_simple_titulo_pagina_reuniones"=>"$termino_reunion->plural",
	"texto_simple_boton_nueva_reunion"=>"$texto_nuevo_ingreso <span class='capitalize'> $termino_reunion->singular </span>",
	"texto_simple_lista_reuniones"=>" Lista de <span class='capitalize'>$termino_reunion->plural </span>",
	"texto_simple_subtitulo_lista_reuniones"=>"Aquí encontrarás $texto_reunion_los $termino_reunion->plural $texto_reunion_establecidas en la semana.",
	"texto_simple_reunion1"=>"$texto_el_culto $termino_reunion->singular",
	"texto_simple_reunion2"=>"ha sido dado de baja satisfactoriamente",
	"texto_simple_busqueda_arrojo"=>"La busqueda arrojo ", 
	"texto_simple_reunion"=>"$termino_reunion->singular",
	"texto_simple_reuniones"=>"$termino_reunion->plural",
	"texto_simple_pagina"=>"Página",
	"texto_simple_de"=>"de",
	"texto_simple_tabla_col1"=>"INFORMACIÓN PRINCIPAL",
	"texto_simple_tabla_col2"=>"INFORMACIÓN DE VÍNCULOS",
	"texto_simple_tabla_col3"=>"ESPECIFICACIONES DE REUNIÓN",
	"texto_simple__titulo_info_reunion"=>"Información para crear una Nueva Reunión",
	"texto_simple_cod"=>"Cod",
	"texto_simple_campo_nombre"=>"Nombre",
	"texto_simple_campo_hora"=>"Hora",
	"texto_simple_campo_dia"=>"Día",
	"texto_simple_campo_lugar"=>"Lugar",
	"texto_simple_campo_descripcion"=>"Descripción",
	"texto_boton_opciones"=>"Opciones",
	"texto_boton_opciones_perfil"=>"Ver Perfil",
	"texto_boton_opciones_modificar"=>"Modificar",
	"texto_boton_opciones_dar_baja"=>"Dar de Baja",
	"texto_mensaje_nuevo_culto_creado1"=>"<span class='capitalize'> $texto_el_culto $texto_nuevo_ingreso $termino_reunion->singular $texto_reunion_programada para el día </span>",
	"texto_mensaje_nuevo_culto_creado2"=>"fue $texto_reunion_creada satisfactoriamente.",

////////////////////////////NUEVA REUNION O CULTO////////////////////////////

	"texto_simple_titulo_pagina_nueva"=>"$texto_nuevo_ingreso $termino_reunion->singular",
	"texto_simple_nueva_reunion"=>" nueva reunión",
	"texto_simple_subtitulo_pagina"=>"Aquí podrás crear $texto_una_reunion $texto_nuevo_ingreso $termino_reunion->singular.", 
	"texto_boton_guardar"=>"Guardar",
	"texto_boton_cancelar"=>"Cancelar",
	


	//////////////////////////ACTUALIZAR REUNIÓN O CULTO/////////////////
	"texto_simple_titulo_pagina_actualizar"=>"Actualizar $termino_reunion->singular",
	"texto_simple_actualizar_reuniones"=>" Aquí podras actualizar los datos de $texto_el_culto <span class='capitalize'>$termino_reunion->singular </span>",
	"texto_simple_mensaje_actualizado_correctamente"=>"<span class='capitalize'> $texto_el_culto $termino_reunion->singular ha sido $texto_reunion_modificada satisfactoriamente.",
	"texto_simple_subtitulo_actualizar_reunion"=>"Información para modificar $texto_una_reunion $termino_reunion->singular",

	///////////////////INFORMES DE GRUPOS//////////////////////////7
    "ir_title" => "Informes de $termino_reunion->plural", //este es para el título del navegador
    "ir_header" => "<span class='mayusculas'> Informes de $termino_reunion->plural </span>", //este es para el título de la sección
    "ir_subtitulo" => "Aquí encuentras todos los informes disponibles de ".Helper::articulo($termino_reunion->genero, 'plural')." $termino_reunion->plural de su ministerio.",
	
    "informe_promedio_asistencia_titulo" => "Informe promedio mensual de asistencia a ".Helper::articulo($termino_reunion->genero, 'plural')." $termino_reunion->plural",
    "informe_promedio_asistencia_descripcion" => "En este informe podrá ver el promedio de asistencia de cada mes en el rango de fecha especificado de $texto_todos_reunion ".Helper::articulo($termino_reunion->genero, 'plural')." $termino_reunion->plural de tu ministerio.",
    "ir_th_informacion_reunion" => "Información ".Helper::articulo($termino_reunion->genero, 'singular', 'de')." $termino_reunion->singular",

    /////////////////////////////////////////INFORME GENERAL//////////////////////////////
    "informe_general_titulo" => "Informe general de ".Helper::articulo($termino_reunion->genero, 'plural')." $termino_reunion->plural",
    "informe_general_descripcion" => "En este informe podrá ver informe general en el rango de fecha especificado de $texto_todos_reunion ".Helper::articulo($termino_reunion->genero, 'plural')." $termino_reunion->plural de tu ministerio.",
    "texto_filtro_todas_las_reuniones" => "Todas las reuniones",
    "texto_10_primeros_grupos" => "<span class='capitalize'>".Helper::articulo($termino_grupo->genero, 'plural')."</span> 10 $termino_grupo->plural con mas <b>altas</b> asistencias",
    "texto_10_ultimos_grupos" => "<span class='capitalize'>".Helper::articulo($termino_grupo->genero, 'plural')."</span> 10 $termino_grupo->plural con mas <b>bajas</b> asistencias",
    "texto_10_primeros_asistentes" => "<span class='capitalize'>".Helper::articulo($termino_asistente->genero, 'plural')."</span> 10 $termino_asistente->plural con mas <b>altas</b> asistencias",
    "texto_10_ultimos_asistentes" => "<span class='capitalize'>".Helper::articulo($termino_asistente->genero, 'plural')."</span> 10 $termino_asistente->plural con mas <b>bajas</b> asistencias",
	"grafica_promedio_asistencia_linea" => "Promedio de asistencia por $termino_linea->singular",
	"grafica_promedio_asistencia_tipo_asistente" => "Promedio de asistencia por tipo de $termino_asistente->singular",
	"grafica_promedio_asistencia_reunion" => "Promedio de asistencia por $termino_reunion->singular",
	"ir_th_informacion_asistente" => "Información ".Helper::articulo($termino_asistente->genero, 'singular', 'de')." $termino_asistente->singular",
	);

?>