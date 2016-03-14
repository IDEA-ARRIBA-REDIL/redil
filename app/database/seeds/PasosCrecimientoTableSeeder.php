<?php 
/** 
*
* @Redil Software. TipoGrupoTableSeeder.php” 
* @versión: 1.0.0     @modificado: 01 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class PasosCrecimientoTableSeeder extends Seeder{
	public function run()
    {
        DB::table('pasos_crecimiento')->delete();

        PasoCrecimiento::create(array(
        	'nombre' => 'Visitado', 
        	'descripcion' => 'Es culminado una vez sean reportadas las dos visitas obligatorias al nuevo creyente',
            'tipo_asistente_id' => '1',//este es para saber si el paso es de oveja, nuevo, miembro, lider, pastor
        ));

        PasoCrecimiento::create(array(
        	'nombre' => 'Reportado en un grupo', 
        	'descripcion' => 'Es culminado una vez sea ubicado en un grupo y aparezca en al menos un reporte de grupo',
            'tipo_asistente_id' => '1',
        ));

        PasoCrecimiento::create(array(
            'nombre' => 'Encuentro o Retiro', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente un evento tipo <Encuentro>',
            'tipo_asistente_id' => '2',
        ));

        PasoCrecimiento::create(array(
            'nombre' => 'Butizado', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente un evento tipo <Bautizo>',
            'tipo_asistente_id' => '2',
        ));

        PasoCrecimiento::create(array(
            'nombre' => 'Reencuentro', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente un evento tipo <Reencuentro>',
            'tipo_asistente_id' => '3',
        ));

        /*PasoCrecimiento::create(array(
            'nombre' => 'Prelider', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente un evento tipo <Prelider>',
            'tipo_asistente_id' => '3',
        ));*/

        PasoCrecimiento::create(array(
            'nombre' => 'Preparado para Liderar', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente el segundo nivel de escuelas',
            'tipo_asistente_id' => '3',
        ));

        /*PasoCrecimiento::create(array(
            'nombre' => 'Encuentro de lideres', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente un evento tipo <Encuentro de lideres>',
            'tipo_asistente_id' => '4',
        ));

        PasoCrecimiento::create(array(
            'nombre' => 'Escuela de teología', 
            'descripcion' => 'Es culminado cuando el asistente concluye satisfactoriamente la carrera de teologia',
            'tipo_asistente_id' => '5',
        ));*/
    }
}