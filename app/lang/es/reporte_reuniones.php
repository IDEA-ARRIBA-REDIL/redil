<?php
include '../app/views/includes/terminos.php'; 

return array(

	//////////////INDEX LISTADO DE REUNIONES //////////////////////

	"texto_simple_pestana"=>"Listado de $termino_reunion->plural",
	"texto_simple_titulo_pagina"=>"Lista de Reportes de <span class='mayusculas'> $termino_reunion->plural </span>",
	"texto_simple_subtitulo_pagina"=>"Aquí encontrarás la lista de los reportes de $texto_reunion_los $termino_reunion->singular.",
	"texto_simple_mensaje_busqueda"=>"La busqueda arrojo",
	"texto_simple_culto"=>"$termino_reunion->singular",
	"texto_simple_cultos"=>"$termino_reunion->plural",
	"texto_simple_filtro_todos"=>" <span class='capitalize'> $texto_todas_las_reuniones $texto_reunion_los $termino_reunion->plural.",
	"texto_tabla_reportes_col1"=>"Información Principal",
	"texto_tabla_reportes_col2"=>"Predicadores",
	"texto_tabla_reportes_col3"=>"Especificaciones de <span class='capitalize> $termino_reunion->singular </span>'",
	"texto_simple_predicador_principal"=>"Predicador Principal",
	"texto_simple_predicador_invitado"=>"(Invitado)",
	"texto_simple_predicador_diezmos"=>"Predicador de Diezmos",
	"texto_simple_total_asistentes"=>"Total de Asistentes",
	"texto_simple_asistente_ministerio"=>"Asistentes de tu Ministerio",

	///////////////////////NUEVO REPORTE DE REUNIÓN/////////////////////
	"texto_simple_titulo_pagina_nuevo_reporte"=>"Nuevo Reporte",
	"texto_simple_titulo_reporte"=>"NUEVO REPORTE DE <span class='mayusculas'> $termino_reunion->singular </span>",
	"texto_simple_subtitulo_reporte"=>"Aquí puedes ingresar los reportes de $termino_reunion->plural.",
	"texto_simple_mensaje_actualizado"=>"El Reporte de",
	"texto_simple_mensaje_actualizado2"=>"fue actualizado satisfactoriamente. ",
	"texto_simple_titulo_info_principal"=>"Información Principal",
	"texto_simple_campo_seleccione_culto"=>"Seleccione $texto_el_culto $termino_reunion->singular que desea reportar:",
	"texto_simple_mostrar_resultados"=>"Mostrando 0 resultados de 0",
	"texto_simple_fecha"=>"Fecha",
	"texto_simple_campo_observaciones"=>"Obsevaciones", 
	"texto_simple_titulo_predicadores"=>"Predicadores Locales",
	"texto_simple_campo_predicadores"=>"Seleccione el predicador ".Helper::articulo($termino_reunion->genero,'singular', 'de')." $termino_reunion->singular",
	"texto_simple_placeholder_predicadores"=>'Buscar predicador por código, nombre o cédula...',
	"texto_simple_campor_perdicador_diezmos"=>"Seleccione el predicador de diezmos y ofrendas:",
	"texto_simple_titulo_predicador_inivtado"=>"Predicadores Invitados",
	"texto_simple_predicador_inivtado"=>"Predicador Invitado",
	"texto_simple_predicador_placeholder"=>"Ingrese el nombre del predicador invitado",
	"texto_simple_predicador_inivtado_diezmos"=>"Predicador Invitado Diezmos y Ofrendas",
	///////////////////PERFIL DE LA REUNION///////////////////////////////////////////////////
	"texto_simple_titulo_pagina"=>"Perfil $termino_reunion->singular",
	"texto_simple_titulo_reporte"=>"<span class='mayusculas'> RESUMEN REPORTE $termino_reunion->singular </span>",
	"texto_simple_subtitulo_admin"=>"Aquí podrás ver el perfil ".Helper::articulo($termino_reunion->genero, 'singular','de')." $termino_reunion->singular",
	"texto_simple_subtitulo_miembro"=>"con base a tu ministerio",
	"texto_simple_cod_reporte"=>" Cod. de reporte",
	"texto_Simple_asistencia_reunion"=>"Asistieron".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_asistencia_ministerio"=>"Asistieron de tu Ministerio:",
	"texto_simple_titulo_info_reporte"=>"Información del Reporte:",
	"texto_simple_titulo_reunion"=>"Información ".Helper::articulo($termino_reunion->genero, 'singular', 'de')." $termino_reunion->singular",
	"texto_simple_filtro_todos_miembros1"=>"de la iglesia",
	"texto_simple_filtro_todos_miembros2"=>"de tu ministerio",
	"texto_simple_filtro_todos_miembros3"=>"No hay asistentes registrados",
	"texto_simple_filtro_todos_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	
	"texto_simple_filtro_nuevos_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural, de tipo ".TipoAsistente::find(1)->nombre." que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_filtro_nuevos_miembros1"=>" de los ".TipoAsistente::find(1)->nombre."s",
	"texto_simple_filtro_nuevos_miembros2"=>" no hay ".TipoAsistente::find(1)->nombre."s registrados(as)",

	"texto_simple_filtro_ovejas_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural, de tipo ".TipoAsistente::find(2)->nombre." que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_filtro_ovejas_miembros1"=>" de los ".TipoAsistente::find(2)->nombre."s",
	"texto_simple_filtro_ovejas_miembros2"=>" no hay ".TipoAsistente::find(2)->nombre."s registrados(as)",

	"texto_simple_filtro_miembro_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural, de tipo ".TipoAsistente::find(3)->nombre." que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_filtro_miembro_miembros1"=>" de los ".TipoAsistente::find(3)->nombre."s",
	"texto_simple_filtro_miembro_miembros2"=>" no hay ".TipoAsistente::find(3)->nombre."s registrados(as)",

	"texto_simple_filtro_lider_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural, de tipo ".TipoAsistente::find(4)->nombre." que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_filtro_lider_miembros1"=>" de los ".TipoAsistente::find(4)->nombre."es",
	"texto_simple_filtro_lider_miembros2"=>" no hay ".TipoAsistente::find(4)->nombre."es registrados(as)",

	"texto_simple_filtro_pastor_placeholder"=>"Muestra $texto_todos ".Helper::articulo($termino_asistente->genero, "los")." $termino_asistente->plural, de tipo ".TipoAsistente::find(5)->nombre." que asistieron ".Helper::articulo($termino_reunion->genero, 'singular', 'a')." $termino_reunion->singular",
	"texto_simple_filtro_pastor_miembros1"=>" de los ".TipoAsistente::find(5)->nombre."es",
	"texto_simple_filtro_pastor_miembros2"=>" no hay ".TipoAsistente::find(5)->nombre."es registrados(as)",

	"texto_simple_filtro_invitados_placeholder"=>"Muestra todas las personas que asistieron a la reunión pero que no estan registradas en el programa.",
	"texto_simple_filtro_invitados1"=>"de la iglesia",
	"texto_simple_filtro_invitados2"=>"de tu ministerio",
	"texto_simple_filtro_invitados3"=>"No hay $termino_asistente->plural registrados(as)" ,

	"texto_simple_filtro_busqueda_lineas"=>" $texto_todas_las_lineas ".Helper::articulo($termino_linea->genero, "plural")." $termino_linea->plural ",
	"texto_simple_filtro_busqueda_grupos"=>" $texto_todos_grupo ".Helper::articulo($termino_grupo->genero, "plural")." $termino_grupo->plural ",


	);

?>