<?php
///termino Grupos
$termino_grupo = Termino::find(1);
if($termino_grupo->genero=='f')
{
	$texto_nuevo_grupo="Nueva";
	$texto_dado="dada";
	$texto_dado_plural="dadas";
	$texto_ningun_grupo="ninguna";
	$texto_este_grupo="esta";
	$texto_seleccionada_singular="seleccionada";
	$texto_seleccionada_plural="seleccionadas";
	$texto_otro_grupo="otra";
	$texto_un_grupo="una";
	$texto_grupo_activo="activa";
	$texto_grupo_activo_plural="activas";
	$texto__grupo_reportado="reportada";
	$texto_grupo_al="al";
	$texto_todos_grupo="todas";
	
}
else
{
	$texto_nuevo_grupo="Nuevo";
	$texto_dado="dado";
	$texto_dado_plural="dados";
	$texto_ningun_grupo="Ninguno";
	$texto_este_grupo="este";
	$texto_seleccionada_singular="seleccionadas";
	$texto_seleccionada_plural="seleccionados";
	$texto_otro_grupo="otro";
	$texto_un_grupo="un";
	$texto_grupo_activo="activo";
	$texto_grupo_activo_plural="activos";
	$texto__grupo_reportado="reportado";
	$texto_grupo_al="a la";
	$texto_todos_grupo="todos";
}




//termino Asistentes
$termino_asistente = Termino::find(2);
if($termino_asistente->genero=='f')
{
	$texto_nuevo_asistente="Nueva";
	$texto_actualizado_asistente="actualizada";
	$texto_todos="todas";
	$texto_nuevos="nuevas";
	$texto_eliminado="eliminada";
	$texto_inactivo_singular="inactiva";
	$texto_inactivo_plural="inactivas";
	$texto_registrado_singular="registrada";
	$texto_registrado_plural="registradas";
	$texto_asignado_asistente="asignada";
	$texto_un="una";
	

}
else
{
	$texto_nuevo_asistente="Nuevo";
	$texto_actualizado_asistente="actualizado";
	$texto_todos="todos";
	$texto_nuevos="nuevos";
	$texto_eliminado="eliminado";
	$texto_inactivo_singular="inactivo";
	$texto_inactivo_plural="inactivos";
	$texto_registrado_singular="registrado";
	$texto_registrado_plural="registrados";
	$texto_asignado_asistente="asignado";
	$texto_un="un";

}

//termino Lineas
$termino_linea = Termino::find(3);
if($termino_linea->genero=='f')
{
	$texto_nuevo_linea="Nueva";
	$texto_ningun_linea="ninguna";
	$texto_un_linea="una";
	$texto_todas_las_lineas="todas";
}
else
{
	$texto_nuevo_linea="Nuevo";
	$texto_ningun_linea="ningun";
	$texto_un_linea="un";
	$texto_todas_las_lineas="todos";
}

//termino Reuniones
$termino_reunion = Termino::find(4);
if($termino_reunion->genero=='f')
{
	$texto_nuevo_reunion="Nueva";
	$texto_todos_reunion="todas";
}
else
{
	$texto_nuevo_reunion="Nuevo";
	$texto_todos_reunion="todos";
}

//termino Reuniones
$termino_ingreso = Termino::find(5);
if($termino_ingreso->genero=='f')
{
	$texto_nuevo_ingreso="nueva";
	$texto_el_culto="la";
	$texto_una_reunion="una";
	$texto_reunion_creada="creada";
	$texto_reunion_programada="programada";
	$texto_reunion_los="las";
	$texto_reunion_establecidas="establecidas";
	$texto_reunion_modificada="modificada";
	$texto_todas_las_reuniones="todas";

}
else
{
	$texto_nuevo_ingreso="nuevo";
	$texto_el_culto="el";
	$texto_una_reunion="un";
	$texto_reunion_creada="creado";
	$texto_reunion_programada="programado";
	$texto_reunion_los="los";
	$texto_reunion_establecidas="establecidos";
	$texto_reunion_modificada="modificado";
	$texto_todas_las_reuniones="todos";
	
}

$termino_departamento= Termino::find(6);
if($termino_departamento->genero=='f')
{
	$texto_departamento="Departamento";
	$texto_departamento_plural="Departamentos";
}
else
{
	$texto_departamento="Departamento";

}

//termino Reportes
$termino_reporte = Termino::find(7);
if($termino_reporte->genero=='f')
{
	$texto_nuevo_reporte="Nueva";
	
}
else
{
	$texto_nuevo_reporte="Nuevo";
	

}
?>