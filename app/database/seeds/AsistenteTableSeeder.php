<?php 
/** 
*
* @Redil Software. AsistenteTableSeeder.php” 
* @versión: 1.0.0     @modificado: 04 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class AsistenteTableSeeder extends Seeder{
	public function run()
    {
        DB::table('asistentes')->delete();

        /*Asistente::create(array(
            'nombre' => 'Hector Fabio', 
            'apellido' => 'Jaramillo',
            'genero' => '0',
            'tipo_identificacion' => '3',
            'identificacion' => '36543567',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle falsa #123',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '2',
            'ocupacion' => 'Pastor',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '5',
            'grupo_id' => '0',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar5.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Luz Adiela', 
            'apellido' => 'Martinez',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '22234567',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1963-07-12',
            'direccion' => 'Calle Verdadera #123',
            'telefono_fijo' => '22327504',
            'telefono_movil' => '3004564455',
            'telefono_otro' => '22324455',
            'estado_civil' => '2',
            'ocupacion' => 'Pastor',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '5',
            'grupo_id' => '0',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => 'Problema en la columna',
            'limitaciones' => '',
            'foto' => 'avatar2.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
        	'nombre' => 'Andres Alexander', 
            'apellido' => 'Bravo Solis',
            'genero' => '0',
            'tipo_identificacion' => '3',
        	'identificacion' => '1112456789',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle falsa #123',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Empresario',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '3',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Mairon Andres', 
            'apellido' => 'Piedrahita Castro',
            'genero' => '0',
            'tipo_identificacion' => '3',
            'identificacion' => '1116246508',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Empresario',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '3',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar04.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Ana Maria', 
            'apellido' => 'Vega',
            'genero' => '1',
            'tipo_identificacion' => '2',
            'identificacion' => '1116246508',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Empresario',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '3',
            'grupo_id' => '2',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar3.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        //Fabian
        Asistente::create(array(
            'nombre' => 'Fabian Andres', 
            'apellido' => 'Aguirre',
            'genero' => '0',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '1',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar04.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Jennifer', 
            'apellido' => 'Gomez Montiel',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '36222333',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '1',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user.jpg',
            'inactivo' => '1',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Ernestina', 
            'apellido' => 'Ortiz',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '1',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user2.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Angy', 
            'apellido' => 'Villamil',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '1',
            'grupo_id' => '4',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user2.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Claudia Yolanda', 
            'apellido' => 'Chavez Pupiales',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '3',
            'grupo_id' => '4',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user2.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Francia Elena', 
            'apellido' => 'Correa',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '2',
            'grupo_id' => '4',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user2.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Heli Johana ', 
            'apellido' => 'Moreno Caicedo',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '3',
            'grupo_id' => '4',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user3.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Lina Maritza', 
            'apellido' => 'Osorio Rivadeneira',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '38765445',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle 25 # 12-51',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Independiente',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '3',
            'grupo_id' => '4',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'user4.jpg',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));

        Asistente::create(array(
            'nombre' => 'Leslie', 
            'apellido' => 'Rengifo',
            'genero' => '1',
            'tipo_identificacion' => '3',
            'identificacion' => '1112456789',
            'nacionalidad' => 'Colombiano',
            'fecha_nacimiento' => '1989-07-12',
            'direccion' => 'Calle falsa #123',
            'telefono_fijo' => '2327504',
            'telefono_movil' => '2324565',
            'telefono_otro' => '2324455',
            'estado_civil' => '1',
            'ocupacion' => 'Profesora',
            'fecha_ingreso' => '2014-07-03',
            'tipo_asistente_id' => '4',
            'grupo_id' => '3',
            'tipo_sangre' => 'rh a+',
            'indicaciones_medicas' => '',
            'limitaciones' => '',
            'foto' => 'avatar.png',
            'inactivo' => '0',
            'dado_baja' => '0'
        ));*/

    }
}