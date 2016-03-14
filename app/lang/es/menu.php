<?php
// php del lenguaje en español para el menu
// creado por Darwin Castaño
// fecha creacion: 22-07-2014
//fecha ultima modificacion: 22/07/2014 18:18
// redil version 1.0
// ultima modificacion darwin castaño
include '../app/views/includes/terminos.php'; 

return array(
//////////////////////// --- Menu-----//////////////////////////
	
	////categorias///

	"inicio"=>"Inicio",
	"asistentes"=>"<span class='capitalize'>$termino_asistente->plural</span>",
		////sub menus dentro de asistentes
			"lista_asistentes"=>"Lista de <span class='capitalize'>$termino_asistente->plural</span>",
			"nuevo_asistente"=>"$texto_nuevo_asistente <span class='capitalize'>$termino_asistente->singular</span>",
			"lista_visitas"=>"Lista de Visitas",
			"nueva_visita"=>"Nueva Visita",
				///fin///
	"grupos"=>"<span class='capitalize'>$termino_grupo->plural</span>",
		///sub menus dentro de Grupos////
			"lista_grupos"=>"Listado de <span class='capitalize'>$termino_grupo->plural</span>",
			"nuevo_grupo"=>	"$texto_nuevo_grupo <span class='capitalize'>$termino_grupo->singular</span>",
			"lista_reportes_grupo"=>"Lista de Reportes",
			"reportar_grupo"=>"Nuevo Reporte",
			"informes_grupo"=>"Informes",
			"mapa_grupos"=>"Mapa de <span class='capitalize'>$termino_grupo->plural</span>",
			///fin///
	"lineas"=>"<span class='capitalize'>$termino_linea->plural</span>",
		////submenus de las lineas///
			"lista_lineas"=> "Lista de <span class='capitalize'>$termino_linea->plural</span>",
			"nueva_linea"=>"$texto_nuevo_linea <span class='capitalize'>$termino_linea->singular</span>",
			/////fin////
	"reuniones"=>"<span class='capitalize'>$termino_reunion->plural</span>",
		///submenus dentro de cultos///
			"lista_reuniones"=>"Lista de <span class='capitalize'>$termino_reunion->plural</span>",
			"reporte_reunion"=>"Reporte Reunion",
			"nueva_reunion"=> "$texto_nuevo_reunion <span class='capitalize'>$termino_reunion->singular</span>",
			"nuevo_reporte"=> "Nuevo Reporte",
			"informes_reuniones"=>"Informes",
				////fin////
	"departamentos"=>"Departamentos",
		///submenus departamentos///
			"lista_departamentos"=>"Lista de los Departamentos",
			"nuevo_departamento"=>"Nuevo Departamento",
				///fin///
	"ingresos"=>"<span class='capitalize'>$termino_ingreso->plural</span>",
		///submenus finanzas///
			"lista_ingresos"=>"Lista de <span class='capitalize'>$termino_ingreso->plural</span>",
			"nuevo_ingreso"=>"<span class='capitalize'>$texto_nuevo_ingreso</span> <span class='capitalize'>$termino_ingreso->singular</span>",
			////fin///
	"escuelas"=>"Escuelas",
	///submenus finanzas///
			"lista_escuelas"=>"Lista de Escuelas",
			"lista_periodos"=>"Lista de Periodos",
			"lista_cursos"=>"Lista de Cursos",
			"lista_calificaciones"=>"Lista de Calificaciones",
			"lista_estudiantes"=>"Lista de Estudiantes",
			"nueva_escuela"=>"Nueva Escuela",
			"nueva_matricula"=>"Nueva Matricula",
			"nuevo_curso"=>"Nuevo Curso",
			"nuevo_periodo"=>"Nuevo Periodo",
			"asignar_calificaciones"=>"Asignar Calificaciones",
			////fin///
	"eventos"=>"Eventos",
	"lista_eventos"=>"Lista de Eventos",
			"nuevo_eventos"=> "Nuevo Eventos",
	"estadisticas"=>"Estadisticas",
		/// submenus de estadisticas
			"estadisticas_generales"=>"Estadisticas Generales",
			"estadisticas_especificas"=>"Estadisticas Especificas",
	"cerrar"=>"Cerrar Sesión",
			

	 );

?>