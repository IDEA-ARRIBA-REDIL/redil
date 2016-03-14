<?php 
/** 
*
* @Redil Software. LineaTableSeeder.php” 
* @versión: 1.0.0     @modificado: 22 de Julio del 2014 
* @autor última modificación: Darwin Castaño
*/

class VisitasTableSeeder extends Seeder{
	public function run()
    {
        DB::table('visitas')->delete();

         /*Visita::create(array(

         'tipo' => '0', 
         'estado' => '0',
         'fecha_limite' => '14/08/2014',  
         'fecha' => '14/07/2014', 
         'motivo'=> 'cuestiones personales',
         'hora'=> '14:50',
         'observacion'=> 'ninguna',
         'asistente_id'=>'13',

         ));

         Visita::create(array(

         'tipo' => '0', 
         'estado' => '0',
         'fecha_limite' => '14/08/2014',  
         'fecha' => '14/07/2014', 
         'motivo'=> 'cuestiones personales',
         'hora'=> '14:50',
         'observacion'=> 'ninguna',
         'asistente_id'=>'11',
        
         ));


         Visita::create(array(

         'tipo' => '0', 
         'estado' => '1',
         'fecha_limite' => '14/08/2014',  
         'fecha' => '14/07/2014', 
         'motivo'=> 'cuestiones personales',
         'hora'=> '14:50',
         'observacion'=> 'ninguna',
         'asistente_id'=>'8',
        
         ));

         Visita::create(array(

         'tipo' => '1', 
         'estado' => '0',
         'fecha_limite' => '14/08/2014',  
         'fecha' => '14/07/2014', 
         'motivo'=> 'cuestiones personales',
         'hora'=> '14:50',
         'observacion'=> 'ninguna',
         'asistente_id'=>'6',
        
         ));

         Visita::create(array(

         'tipo' => '1', 
         'estado' => '1',
         'fecha_limite' => '14/08/2014',  
         'fecha' => '14/07/2014', 
         'motivo'=> 'cuestiones personales',
         'hora'=> '14:50',
         'observacion'=> 'ninguna',
         'asistente_id'=>'14',
        
         ));*/

    }

 }