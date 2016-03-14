<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

///pagina de error 404 pagina no encontrada
App::missing(function($exception)
{
   return Response::view('error.error404', array(), 404);
});

///////////////funcion para crear las notificaciones iniciales de los usuraios que ya existen

//llena invitados reportes de grupo
Route::get('llena-invitados-reporte-grupo', function()
{
   $reportes=ReporteGrupo::all();
   foreach ($reportes as $reporte) {
      if($reporte->invitados=="" || $reporte->invitados==null){
         $reporte->invitados=0;
         $reporte->save();
         echo "Reporte $reporte->id fue actualizado <br>";
      }
   }

});

//Al entrar a la aplicación carga la vista de login
Route::get('llena-cantidad-reuniones-grupos', function()
{
   $grupos=Grupo::all();
   foreach ($grupos as $grupo) {
      $grupo->reuniones_por_mes=4;
      $grupo->save();
      echo "grupo $grupo->id $grupo->nombre fue actualizado <br>";
   }

});

//Al entrar a la aplicación carga la vista de login
Route::get('activar-lideres', function()
{
   $lideres=Asistente::get();
   foreach ($lideres as $encargado) {
      $contador_grupos= $encargado->grupos()->where('dado_baja', 0)->count();
      if(isset($encargado->user->id)){
         if($contador_grupos<1){
              $encargado->tipo_asistente_id=3;
              $encargado->user->activo=0; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
              $encargado->user->save(); // Guarda los cambio de usuario. 
              $encargado->save();
               echo $encargado->user->email." ".$encargado->nombre." SE DESACTIVO<br>";
          }
          else{
            $encargado->tipo_asistente_id=4;
              $encargado->user->activo=1; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
              $encargado->user->save(); // Guarda los cambio de usuario. 
              $encargado->save();
         }
      }
      else
      {
          echo "No tiene usuario: ".$encargado->id." ".$encargado->nombre."<br>";
      }
   }
});


//poner las lienas en null que estan con id 0
Route::get('actualiza-fecha-ingreso', function()
{
   $asistentes=Asistente::withTrashed()->get();
   foreach ($asistentes as $asistente) {
      if($asistente->fecha_ingreso=="" || $asistente->fecha_ingreso==null)
      {
         $asistente->fecha_ingreso=$asistente->created_at;
         $asistente->save();
         echo 'Asistente '.$asistente->id.' - '.$asistente->nombre.'<br>';
      }
   }
});

//poner las lienas en null que estan con id 0
Route::get('actualiza-asistentes-inactivos', function()
{
   echo Asistente::definirInactivosGrupo();
   echo Asistente::definirInactivosCulto();
});

//poner las lienas en null que estan con id 0
Route::get('actualiza-asistentes-linea-null', function()
{
   $asistentes=Asistente::where('linea_id',0)->get();
   foreach($asistentes as $asistente){
      $asistente->linea_id=null;
      $asistente->save();
   }
});

//la siguiente ruta permite actualizar la linea actual de los asistente
Route::get('actualiza-asistentes-linea', function()
{
   echo "Comienza el calculo de linea<br><br>";
   $asistentes=Grupo::find(1)->asistentes;
   foreach ($asistentes as $asistente) {
      if($asistente->lineas()->count()>0){
         $asistente->linea_id=$asistente->lineas()->first()->id;
         $asistente->save();
      }
      else if(!isset($asistente->linea->id))
         echo "1. no se pudo asignar linea ".$asistente->id." ".$asistente->nombre."</br>";
   }

   $asistentes=Asistente::get();
   
   foreach ($asistentes as $asistente) {
      $grupo=$asistente->grupo;
      if(isset($grupo->id))
      {
         if($grupo->id!=1){
            if(isset($grupo->linea()->id))
            {
               $asistente->linea_id=$grupo->linea()->id;
               $asistente->save();
            }
            else
            {
               if(!isset($asistente->linea->id))
               echo "2. no se pudo asignar linea ".$asistente->id." ".$asistente->nombre."</br>";
            }
         }
      }
      else{
         if(!isset($asistente->linea->id))
               echo "2. no se pudo asignar linea ".$asistente->id." ".$asistente->nombre."</br>";
      }
   }
});

Route::get('llena-grupo-padre', function()
{
   $grupos=Grupo::get();
   
   foreach ($grupos as $grupo) {
      if($grupo->id!=1)
      {
         if(isset($grupo->encargados()->first()->grupo->id))
         {
            $grupo->grupo_padre=$grupo->encargados()->first()->grupo->id;
            $grupo->save();
            echo $grupo->id." "-$grupo->nombre." - grupo_padre ".$grupo->grupo_padre."<br>";

         }
         else if(!isset($grupo->padre->id))
         {
            echo "<b style='color:red;'>".$grupo->id." ".$grupo->nombre."</b><br>";
         }
      }
   }
});

Route::get('crea-id-0', function()
{
   if(DB::update('update asistentes set linea_id=null where linea_id=0'))
      echo "Se actualizaron los asistentes sin grupo<br>";
   if(DB::update('update asistentes set grupo_id=null where grupo_id=0'))
      echo "Se actualizaron los asistentes sin linea<br>";
});

Route::get('prueba-branch', function()
{
   
   $asistente=Asistente::find(552); //este es el asistente que se va pasar de grupo
   $grupo= Grupo::find(17); ///el grupo al que se va pasar el asistente
   $grupos=Grupo::where('branch', 'LIKE', "%,$grupo->id,%")->get();
   echo "Esta vainola que? : $grupo->nombre <br>";
   foreach($grupos as $grupo_branch)
   {
      $tam=strlen(",$grupo->id,");
      $pos=strpos($grupo_branch->branch, ",$grupo->id,");
      $branch_nuevo=$asistente->grupo->branch.$grupo->id.",".substr($grupo_branch->branch, $pos+$tam);
      echo $grupo_branch->nombre." - ".$grupo_branch->branch." - ".$pos." - Branch Nuevo ".$branch_nuevo."<br>";
      $grupo_branch->branch=$branch_nuevo;
      //$grupo_branch->save();
      echo "<br><br><br> nueva branch".$branch_nuevo;

   }
});

//esta ruta es para probar el pasar un asistente de grupo
Route::get('prueba-pasar-asistente-de-grupo', function()
{
   $asistente=Asistente::find(289); //este es el asistente que se va pasar de grupo
   echo "branch del grupo al que pertenece el asistente: ".$asistente->grupo->branch."<br><br>";
   $branch_nuevo="";
   //if($asistente->grupo_id!="")
         //{
            $sql2="";
            if($asistente->grupos()->count()>0)
            {
               $grupos=$asistente->grupos()->get();
               $c=0;
               foreach ($grupos as $grupo) 
               {
                  if($c!=0)
                     $sql2.=" OR ";
                  $sql2.="branch LIKE '%,".$grupo->id.",%'";
                  $c++;
               }

               //este es para conocer todos los grupos indirectos del usuario logueado
               $grupos_ids= array();
               $grupos=Grupo::whereRaw($sql2)->where('dado_baja', '!=', '1')->get();

               
               $grupo=Grupo::find($asistente->grupo_id);
               $grupo_nuevo=Grupo::find(44);
               /////////////////77necesito es comprobar si el asistente tiene grupos y cambairle las branch
               foreach($grupos as $grupo_branch)
                {
                  echo "id del grupo que dirige asistente: $grupo_branch->id<br>";
                  echo "branch del grupo que dirige asistente: $grupo_branch->branch<br>";
                  $tam=strlen(",$grupo->id,");
                  $pos=strpos($grupo_branch->branch, ",$grupo->id,");
                  $branch_nuevo=$grupo_nuevo->branch.substr($grupo_branch->branch, $pos+$tam);
                  echo "tam: ".$tam." pos: $pos<br><br>";
                  echo "<br> branch del grupo al que se pasara el asistente:  $grupo_nuevo->branch <br><br>";
                  echo "branch nueva para el grupo del asistente: ".$branch_nuevo; //este es el asistente que se va pasar de grupo

                }
            }////fin if verifica si el asistente tiene grupos
         //}

          
});

Route::get('prueba-multinivel', function()
{
   $codigo=array();
   $j=0;
   $grupos=Grupo::where('dado_baja', '=', '0')->where('id', '<>', '1')->orderBy('id', 'desc')->get();
   foreach($grupos as $grupo)
   {
      $band=0;
      $i=0;
      
      $grupo_aux="";
      $codigo[$j]=array();
      //$grupo=Grupo::find(26);
      while($band==0)
      {

         if($i==0)
            $grupo_aux=$grupo;
         array_unshift($codigo[$j], $grupo_aux->id);
         $encargados=$grupo_aux->encargados;
         if($grupo_aux->encargados()->count()>0)
         {
            $asistente=$encargados->first();
            $grupo_aux=$asistente->grupo;
                    
         }
         else
         {
            $band=2; ///si band quedo con 2 significa que se rompio la branch por causa de un grupo sin lideres
         }
         //echo $asistente->grupo.'<br>';
         if($grupo_aux->id=="1")
            $band=1;

         $i++;
      }
      if($band==1)
      array_unshift($codigo[$j], "1");
      echo "Grupo ".$grupo->id." ".$grupo->nombre.": ";
      //echo "<javascript> alert('".implode(',', $codigo[$j])."'); </javascript>";
      echo implode(",", $codigo[$j]);
      echo '<br>';
      $j++;
   }
});

///este metodo puede ser usado si necesitamos crear todas las branch por algun tipo de error
Route::get('crea-multinivel', function()
{
   $codigo=array();
   $j=0;
   ///ponemos el codigo del grupo principal
   $grupo_ppl=Grupo::find(1);
   $grupo_ppl->branch=",1,";
   $grupo_ppl->save();
//////////////////////////////
   
   $grupos=Grupo::where('dado_baja', '=', '0')->where('id', '<>', '1')->orderBy('id', 'desc')
   ->groupBy('id', 'nombre', 'direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'dado_baja', 'linea_id', 'branch', 'tipo_grupo_id',  'updated_at', 'created_at' )
   ->get();
   foreach($grupos as $grupo)
   {
      $band=0;
      $i=0;
      
      $grupo_aux="";
      $codigo[$j]=array();
      //$grupo=Grupo::find(26);
      while($band==0)
      {

         if($i==0)
            $grupo_aux=$grupo;
         array_unshift($codigo[$j], $grupo_aux->id);
         $encargados=$grupo_aux->encargados;
         if($grupo_aux->encargados()->count()>0)
         {
            $asistente=$encargados->first();
            $grupo_aux=$asistente->grupo;
                    
         }
         else
         {
            $band=2; ///si band quedo con 2 significa que se rompio la branch por causa de un grupo sin lideres
         }
         //echo $asistente->grupo.'<br>';
         if($grupo_aux->id=="1")
            $band=1;

         $i++;
      }
      if($band==1)
      array_unshift($codigo[$j], "1");
      //echo "Grupo ".$grupo->id." ".$grupo->nombre.": ";
      //echo "<javascript> alert('".implode(',', $codigo[$j])."'); </javascript>";
      $grupo->branch= ",".implode(",", $codigo[$j]).",";
      $grupo->save();
      if($band==2) echo "<div style='color:red;'>";
      echo "Grupo ".$grupo->id." ".$grupo->nombre.": ";
      //echo "<javascript> alert('".implode(',', $codigo[$j])."'); </javascript>";

      echo implode(",", $codigo[$j]);
      if($band==2) echo "</div>";
      else
      echo '<br>';
      $j++;
   }
   echo "se realizo la actualización satisfactoriamente";
});
/*
Route::get('corrige-fecha-grupos', function()
{
   $grupos=Grupo::all();
   foreach($grupos as $grupo)
   {
      if($grupo->fecha_apertura=="")
      {
         $grupo->fecha_apertura=date('d-m-Y');
      }
      else
      {
         if($grupo->reportes()->count()==0)
         {
            $grupo->fecha_apertura=date('d-m-Y');
         }
      }
      $grupo->save();
   }
});*/

/*
Route::get('rellena-lineas', function()
{
   $asistentes=Asistente::all();
   
   foreach ($asistentes as $asistente) {
      if (isset($asistente->grupo->linea_id))
      {
         $linea=$asistente->grupo->linea_id;
         $asistente->linea_id = $linea;
         $asistente->save();
      }

      
   }

});
*/

// Esta Ruta recibe el mensaje de "¿Cuentanos tu idea" y lo envivia a el correo de info@idearriba.com 
Route::get('cuentanos-tu-idea', function()
{
      $usuario=Auth::user();
      $iglesia=Iglesia::find(1);

      if ($usuario->id == 1)
      {

         $datos= array('mensaje' =>Input::get('mensaje'),  
                        'nombre' => "Administrador",
                        'apellido' => "",
                        'iglesia_nombre' => $iglesia->nombre,
                        'iglesia_ciudad' => $iglesia->ciudad,
                        'iglesia_pais' => $iglesia->pais,                
                     );
      } else 
      {
         $asistente= $usuario->asistente;
         $datos= array('mensaje' =>Input::get('mensaje'),  
                     'nombre' => $asistente->nombre,
                     'apellido' => $asistente->apellido,
                     'iglesia_nombre' => $iglesia->nombre,
                     'iglesia_ciudad' => $iglesia->ciudad,
                     'iglesia_pais' => $iglesia->pais,                
                  );
      }
      
     

     Mail::send('emails.cuentanos-tu-idea', $datos, function($message) 
     {
         $usuario=Auth::user();         
         $fromemail= $usuario->email;
         $correo= "info@idearriba.com";
         $message->to($correo);
         $message->from($fromemail);
         $message->subject('Una fantastica idea a llegado.');

     }); 

   return Redirect::to('/')->with('mensaje_enviado', 'Tu fantastica idea fue enviada con exito');
});

Route::get('/', function()
{
   if(Auth::guest())
     return View::make('login');
   else
   {
      return Redirect::to('/inicio');
   }
});


//ruta para el controlador de Tutoriales  
Route::controller('tutoriales', 'TutorialesController');

//Controlador de login que me permite autenticar el usuario
Route::post('login', 'UserLogin@user');

//ruta para el controlador de Notificaciones 
Route::controller('notificaciones', 'NotificacionesController');

//ruta para el controlador de Solicitud de Traspasos 
Route::controller('solicitudes-traspaso', 'SolicitudTraspasosController');

//ruta para el controlador de Usuarios 
Route::controller('usuarios', 'UsersController');

//ruta para el controlador de RemindersController  
Route::controller('password', 'RemindersController');

//ruta para el controlador de Iglesias
Route::controller('iglesia', 'IglesiasController');

//ruta para el controlador de Asistentes
Route::controller('asistentes', 'AsistentesController');

//Route::get('asistentes/{id}', 'AsistentesController@getIndex');

//ruta para el controlador de visitas
Route::controller('visitas', 'VisitasController');

//ruta para el controlador de Lineas
Route::controller('lineas', 'LineasController');

//ruta para el controlador de Departamentos
Route::controller('departamentos', 'DepartamentosController');


//ruta para el controlador de grupos
Route::controller('grupos', 'GruposController');

//ruta para el controlador de grupos
Route::controller('escuelas', 'EscuelasController');

//ruta para el controlador de grupos
Route::controller('cursos', 'CursosController');

//ruta para el controlador de reportes de grupos
Route::controller('reporte-reuniones', 'ReporteReunionesController');

//ruta para el controlador de listado de reuniones

Route::controller('reporte-grupos', 'ReporteGruposController');

//ruta para el controlador de reuniones

Route::controller('reuniones', 'ReunionesController');

//ruta para el controlador de ofrendas

Route::controller('ofrendas', 'OfrendasController');

//ruta para el controlador de pasos de crecimiento

Route::controller('pasos-crecimiento', 'PasosCrecimientoController');

Route::get('emails', function()
      {
            return View::make('emails.email'); 
      }
   );

///url que llama una vez se loguea correctamente
Route::get('inicio', array('before' => 'auth', function()
{
   $ultimos_reportes=array();

   $fecha_actual = date('Y-m-j'); // Me trae la fecha actual de sistema
   $hace_30_dias = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
   $hace_30_dias = date ( 'Y-m-d' , $hace_30_dias );

   $hace_30_dias = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
   $hace_30_dias = date ( 'Y-m-d' , $hace_30_dias );

   if(Auth::user()->id==1)
   {
      //asistenets inactivos en grupo
      $inactivos_grupo=Asistente::whereRaw('(asistentes.inactivo_grupo = TRUE)')->count();
      $total_asistestes=Asistente::count();
      if($total_asistestes>0)
         $inactivos_grupo_porcentaje=(int)($inactivos_grupo*100/$total_asistestes);
      else
         $inactivos_grupo_porcentaje=0;

      //asistenets inactivos en culto
      $inactivos_culto=Asistente::whereRaw('(asistentes.inactivo_iglesia = TRUE)')->count();
      $total_asistestes=Asistente::count();
      if($total_asistestes>0)
         $inactivos_culto_porcentaje=(int)($inactivos_culto*100/$total_asistestes);
      else
         $inactivos_culto_porcentaje=0;

      //grupos inactivos 
      $grupos_inactivos=Grupo::where('inactivo', '=', 1 )->where('dado_baja', 0)->count();
      $total_grupos=Grupo::where('dado_baja', 0)->count();
      if($total_grupos>0)
         $grupos_inactivos_porcentaje=(int)($grupos_inactivos*100/$total_grupos);
      else
         $grupos_inactivos_porcentaje=0;

      //ultimos asistentes que ingresaron el ultimo mes
      $ultimos_asistentes=Asistente::where('created_at', '>', $hace_30_dias);

      $asistentes_inactivos=Asistente::whereRaw('(asistentes.inactivo_iglesia = TRUE and asistentes.inactivo_grupo = TRUE)')
      ->distinct();
   }
   else
   {
      //asistenets inactivos en grupo
      $inactivos_grupo=Auth::user()->asistente->discipulos()->whereRaw('(asistentes.inactivo_grupo = TRUE)')->count();
      $total_asistestes=Auth::user()->asistente->discipulos()->count();
      if($total_asistestes>0)
         $inactivos_grupo_porcentaje=(int)($inactivos_grupo*100/$total_asistestes);
      else
         $inactivos_grupo_porcentaje=0;

      //asistenets inactivos en culto
      $inactivos_culto=Auth::user()->asistente->discipulos()->whereRaw('(asistentes.inactivo_iglesia = TRUE)')->count();
      $total_asistestes=Auth::user()->asistente->discipulos()->count();
      if($total_asistestes>0)
         $inactivos_culto_porcentaje=(int)($inactivos_culto*100/$total_asistestes);
      else
         $inactivos_culto_porcentaje=0;

      //grupos inactivos 
      $grupos_inactivos=Auth::user()->asistente->gruposMinisterio()->where('inactivo', '=', 1 )->where('dado_baja', 0)->count();
      $total_grupos=Auth::user()->asistente->gruposMinisterio()->where('dado_baja', 0)->count();
      if($total_grupos>0)
         $grupos_inactivos_porcentaje=(int)($grupos_inactivos*100/$total_grupos);
      else
         $grupos_inactivos_porcentaje=0;

      //ultimos asistentes que ingresaron el ultimo mes
      $ultimos_asistentes=Auth::user()->asistente->discipulos()->where('fecha_ingreso', $hace_30_dias);

      $asistentes_inactivos=Auth::user()->asistente->discipulos()->whereRaw('(asistentes.inactivo_iglesia = TRUE and asistentes.inactivo_grupo = TRUE)')
      ->distinct();

      //hallamos la fecha del ultimo reporte de sus grupos directos
      foreach (Auth::user()->asistente->grupos()->where('dado_baja', '0')->get() as $grupo) {
         array_push($ultimos_reportes, $grupo->ultimoReporte());
      }
   }

   $ultimos_asistentes->take(10)->get();
   
   return View::make('dashboard.index')-> with(
      array('ultimos_asistentes' => $ultimos_asistentes,
         'asistentes_inactivos' => $asistentes_inactivos,
         'ultimos_reportes' => $ultimos_reportes,
         'inactivos_grupo' => $inactivos_grupo,
         'inactivos_grupo_porcentaje' => $inactivos_grupo_porcentaje,
         'inactivos_culto' => $inactivos_culto,
         'inactivos_culto_porcentaje' => $inactivos_culto_porcentaje,
         'grupos_inactivos' => $grupos_inactivos,
         'grupos_inactivos_porcentaje' => $grupos_inactivos_porcentaje,
         ));
}));

/*
Esta ruta llena las tablas que salen de MUCHOS A MUCHOS
Route::get ('crear', function()
{
      // llena datos relacion de muchos a muchos entre GRUPO y LINEA para saber quienes son los encargados 
      DB::table('encargados_linea')->delete();

         $linea=Linea::find(1);
         $asistente=Asistente::find(8);
         $asistente->lineas()->save($linea);

         $linea=Linea::find(2);
         $asistente=Asistente::find(6);
         $asistente->lineas()->save($linea);


         $asistente=Asistente::find(7);
         $asistente->lineas()->save($linea);


      // llena datos relacion de muchos a muchos entre Grupo y asistentes para saber quienes son los encargados 
      DB::table('encargados_grupo')->delete();

         $asistente=Asistente::find(1);
         $grupo=Grupo::find(1);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(2);
         $grupo=Grupo::find(1);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(6);
         $grupo=Grupo::find(3);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(7);
         $grupo=Grupo::find(3);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(8);
         $grupo=Grupo::find(2);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(4);
         $grupo=Grupo::find(4);
         $asistente->grupos()->save($grupo);

         $asistente=Asistente::find(4);
         $grupo=Grupo::find(5);
         $asistente->grupos()->save($grupo); 

      //  llena datos relacion de muchos a muchos entre Grupo y Red 
      DB::table('redes_grupo')->delete();

         $red=Red::find(1);
         $grupo=Grupo::find(1);
         $red->grupos()->save($grupo);

         $red=Red::find(2);
         $grupo=Grupo::find(1);
         $red->grupos()->save($grupo);

         $red=Red::find(3);
         $grupo=Grupo::find(2);
         $red->grupos()->save($grupo);

         $red=Red::find(2);
         $grupo=Grupo::find(3);
         $red->grupos()->save($grupo);

         $red=Red::find(3);
         $grupo=Grupo::find(3);
         $red->grupos()->save($grupo);

         $red=Red::find(2);
         $grupo=Grupo::find(4);
         $red->grupos()->save($grupo);

         $red=Red::find(2);
         $grupo=Grupo::find(5);
         $red->grupos()->save($grupo); 


      //  llena datos relacion de muchos a muchos entre Iglesia y Asistentes (Pastores Principales)
      DB::table('pastores_principales')->delete();

         $asistente=Asistente::find(5);//5
         $iglesia=Iglesia::find(1);
         $asistente->iglesiaEncargada()->save($iglesia); 

         $asistente=Asistente::find(517);//517
         $iglesia=Iglesia::find(1);
         $asistente->iglesiaEncargada()->save($iglesia); 

      

      /// llena los datos de encargados departamentos
      DB::table('encargados_departamento')->delete();
        
         /*$asistente=Asistente::find(3);
         $asistente->departamentosEncargados()->attach(1, array('funcion'=>'dirigir salmistas'));
         
         
         $asistente=Asistente::find(8);
        $asistente->departamentosEncargados()->attach(2, array('funcion'=>'dirigir ujieres'));
         

         $asistente=Asistente::find(6);
         $asistente->departamentosEncargados()->attach(3, array('funcion'=>'dirigir ujieres'));

      /// llena los datos de asistencia_grupos
      DB::table('asistencia_grupos')->delete();
        ///reporte de g12 neftaly
         $asistente=Asistente::find(3);
         $asistente->reportesGrupo()->attach(1, array('asistio'=>'1'));
         
         $asistente=Asistente::find(4);
         $asistente->reportesGrupo()->attach(1, array('asistio'=>'1'));

         $asistente=Asistente::find(14);
         $asistente->reportesGrupo()->attach(1, array('asistio'=>'0'));

         ///reporte celula mairon
         $asistente=Asistente::find(9);
         $asistente->reportesGrupo()->attach(2, array('asistio'=>'1'));
         
         $asistente=Asistente::find(10);
         $asistente->reportesGrupo()->attach(2, array('asistio'=>'0'));

         $asistente=Asistente::find(11);
         $asistente->reportesGrupo()->attach(2, array('asistio'=>'1'));

         $asistente=Asistente::find(12);
         $asistente->reportesGrupo()->attach(2, array('asistio'=>'1'));

         $asistente=Asistente::find(13);
         $asistente->reportesGrupo()->attach(2, array('asistio'=>'1'));
      
      DB::table('ofrenda_grupos')->delete();
        ///reporte de g12 neftaly
         $reporte=ReporteGrupo::find(1);
         $reporte->ofrendas()->attach(2);

         $reporte=ReporteGrupo::find(1);
         $reporte->ofrendas()->attach(3);

         $reporte=ReporteGrupo::find(2);
         $reporte->ofrendas()->attach(1);  

      DB::table('crecimiento_asistentes')->delete();
        ///reporte de g12 neftaly
         $asistente=Asistente::find(4);
         $asistente->pasosCrecimiento()->attach(1);

         $asistente=Asistente::find(1);
         $asistente->pasosCrecimiento()->attach(2);

         $asistente=Asistente::find(2);
         $asistente->pasosCrecimiento()->attach(3);     
   }) ;
*/

//url que permite cerrar sesión 
Route::get('logout', function()
{
   Auth::logout();
   return Redirect::to('/');
});

/*
Route::get ('modificarofrendas', function()
{
   $ofrendas_grupos=Ofrenda::all();
   
   foreach ($ofrendas_grupos as $ofrenda_grupo) 
   {
      if ($ofrenda_grupo->reporte_grupo()->count()>0)
      {    
            foreach ( $ofrenda_grupo->reporte_grupo()->get() as $reporte) 
            {
               $ofrenda_grupo->reporte_grupo_id=$reporte->id;
               $ofrenda_grupo->save();
            }
      }
   }

   echo "<br> Se ha llenado el nuevo campo reporte_grupo_id de la tabla ofrendas";

});

Route::get ('eliminarofrendasrelaciones', function()
{
      DB::table('ofrenda_grupos')->delete();
      DB::table('ofrenda_reuniones')->delete();
      
  echo "<br> Se han eliminado las tablas de relaciones entre ofrendas y reportes de grupos y reportes de reuniones";

});
*/



/* Algoritmo para realizar el realizar el SoftDelete a los a
sistentes que tiene TRUE o (1) en el campo DADO_BAJA
*/
/*Route::get ('soft-delete', function()
{
   $asistentes = Asistente::where('dado_baja', '=', '1')->get();
   echo "Cantidad:".$asistentes->count(),"<br>";
   foreach ($asistentes as $asistente)
   {
      $asistente->delete();
   }

});
*/

// pruebas para saber si funciona el softDelete para usuarios 
Route::get ('borrado-suave', function()
{
   $asistente = Asistente::find(69);
   $asistente->delete(); 
});


// ejemplo
Route::get ('juan-carlos', function()
{
   $asistente = Asistente::find(800);
   echo "ASISTENTE:".$asistente."<br><br><br>";

   $reporte_ofrendas= $asistente->ofrendas()->first();
   echo "OFRENDAS:".$reporte_ofrendas."<br>";
   if(isset($reporte_ofrendas))
      echo "Tiene ofrendas ... <br><br>"; 
   else 
      echo "No tiene .... <br><br>";


   $reporte_reunion= $asistente->reportesReunion()->first();
   echo "REUNIONES:".$reporte_reunion."<br>";
   if(isset($reporte_reunion))
      echo "Fue reportado en una reunion ... <br><br>"; 
   else 
      echo "No tiene reportes de reunion .... <br><br>";


   $reporte_grupo= $asistente->reportesGrupo()->first();  
   echo "GRUPO:".$reporte_grupo."<br>";
   if(isset($reporte_grupo))
      echo "Fue reportado en un grupo ... <br><br>"; 
   else 
      echo "No tiene reporte de grupo .... <br><br>";  

});



// ese Route a todos los reporte que no han sido aprobados los vuelve aprobados
Route::get ('aprueba-reportes', function()
{
   $reportes = ReporteGrupo::all();
  // $reportes = ReporteGrupo::all();
   echo "<b>".$reportes->count()."</b><br><br>";
   foreach ($reportes as $reporte) {
      $reporte->aprobado = 1;    
      $reporte->save();   
      echo $reporte->id."<br> APROBADO? ".$reporte->aprobado."<br><br>"; 
   }
});

