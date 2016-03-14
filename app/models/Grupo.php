<?php
/** 
*
* @Redil Software. Grupo.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Grupo extends Eloquent {


	//funcion para crear relacion entre asistentes y grupos
	public function asistentes()
    {
        return $this->hasMany("Asistente");
    }

    //funcion para crear relacion entre reportes de grupo y grupos
    public function reportes()
    {
        return $this->hasMany("ReporteGrupo");
    }

    //funcion para crear relacion entre Linea y grupos
	/*public function linea()
    {
        return $this->belongsTo("Linea");
    }*/

     //funcion para crear relacion entre TipoGrupo y grupos
    public function tipoGrupo()
    {
        return $this->belongsTo("TipoGrupo");
    }

    ///relacion para conocer los encargados de un grupo
    public function encargados()
    {
        return $this->belongsToMany("Asistente","encargados_grupo")->withTimestamps(); 
    }   

    public function servidores()
    {
        return $this->belongsToMany ("Asistente", "servidores_grupo")->withTimestamps();
    }

    ///relacion para conocer las REDES del GRUPO
    public function redes()
    {
        return $this->belongsToMany("Red","redes_grupo")->withTimestamps();
    }   

    public function reportesBajaAlta()
    {
        return $this->hasMany("ReporteGrupoBajaAlta")->withTimestamps(); 

    } 

    public function padre(){
        return $this->belongsTo("Grupo", "grupo_padre");
    }

    public function hijos(){
        return $this->hasMany("Grupo", "grupo_padre");
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////FUNCIONES ADICIONALES//////////////////////////////////////
    ///la siguiente funcion es para saber los grupos sin lider, se puede accerde asi Grupo::gruposSinLider

    ////funcion para obtener la linea de un grupo
    public function linea(){
        $grupo=$this;
        $band=0;
        $linea=array();
        while($band==0)
        {
            if($grupo->encargados()->count()>0)
            {
                foreach ($grupo->encargados as $encargado) 
                {
                    if(isset($encargado->linea->id))
                    {
                       
                        //$linea=Linea::find(1);
                        $linea=$encargado->linea;
                        $band=1;
                    }
                }
            }
            $grupo=$grupo->padre;
            if(!isset($grupo->id))
                $band=1;
        } 
        return $linea;   
    }

    ///esta funcion estatica me permite obtener los grupos sin lider de uqien esta logueado
    public static function gruposSinLider($tipo="objeto")
    {
        if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)) 
        $grupos=Grupo::where('grupos.dado_baja', '=', '0');
        else
        $grupos=Auth::user()->asistente->gruposMinisterio()->where('grupos.dado_baja', '=', '0');

        $grupos= $grupos->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
                ->select("*", "grupos.id")
                ->where('encargados_grupo.grupo_id', '=', NULL)
                ->where('grupos.dado_baja', '=', '0');
        $grupos_ids_fin=Helper::obtenerArrayIds($grupos->get(array("grupos.id")));
        $grupos=Grupo::whereIn('grupos.id', $grupos_ids_fin);
        return $grupos;
    }

    public static function gruposNuevos($tipo="objeto")
    {
        $fecha_actual = date('Y-m-j'); // Me trae la fecha actual de sistema
        $nueva_fecha = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
        $nueva_fecha = date ( 'Y-m-d' , $nueva_fecha );
        if(Auth::user()->id==1)
            $grupos=Grupo::where('fecha_apertura', '>', $nueva_fecha )->where('grupos.dado_baja', '=', '0');
        else
            $grupos=Auth::user()->asistente->gruposMinisterio()->where('fecha_apertura', '>', $nueva_fecha )->where('grupos.dado_baja', '=', '0');
        return $grupos;
    }

    public static function calcularGruposActivos()
    {
        $fecha_actual = date('Y-m-j'); // Me trae la fecha actual de sistema
        $nueva_fecha = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
        $nueva_fecha = date ( 'Y-m-d' , $nueva_fecha );

        if(Auth::user()->id==1)
            $grupos = Grupo::where('dado_baja', '=', '0')->get();
        else
            $grupos = Auth::user()->asistente->gruposMinisterio()->get();
        foreach($grupos as $grupo)
        {
            if($grupo->reportes()->where('fecha', '>', $nueva_fecha)->count()>0)
            {
                $grupo->inactivo=0;
                $grupo->save();
            }
            else
            {
                if($grupo->inactivo!=1){
                    $grupo->inactivo=1;
                    foreach ($grupo->asistentes as $asistente) {
                        $asistente->inactivo_grupo=1;
                        $asistente->save();
                    }
                    $grupo->save();
                }
            }
        }

        return true;
    }

    public function asignarEncargado($id_asistente){
        $grupo= $this;
        $band=0;
        if(!$grupo->encargados()->attach($id_asistente))
        {
            $asistente= Asistente::find($id_asistente); 
            if($asistente->tipo_asistente_id<4){
                $asistente->tipo_asistente_id= 4;
                $asistente->user->activo=1; // cambia el a activo, es decir lo deja entrar a la plataforma . 
                $asistente->user->save(); // Guarda los cambio de usuario. 
                $asistente->save();
          }

        if(isset($asistente->grupo->id))
        {
            $grupo->grupo_padre=$asistente->grupo->id;
            $grupo->save();
        }

            return "true";
        }
        else{
            return "false";
        }
    }

    public function eliminarEncargado($id_asistente){

        if($this->encargados()->detach($id_asistente))
        {
                $asistente= Asistente::find($id_asistente);
                // esto codigo me cuenta cuantos grupos tiene el lider y si es < 1 cambia su tipo_asistente a miembro
                $contador_grupos= $asistente->grupos()->where('dado_baja', 0)->count();
                if($contador_grupos<1){
                    $asistente->tipo_asistente_id=3;
                    $asistente->user->activo=0; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
                    $asistente->user->save(); // Guarda los cambio de usuario. 
                    $asistente->save();
                }
            return "true";
        }
        else
            return "false";
    }

    //funcion que permite calcular la branch d eun grupo y la de sus hijos.
    /* public function calcularBranch()
     {
        //se obtiene el primer encargado del grupo para luego obtener todos sus grupos.
        $encargado=$this->encargados()->first();
        $grupos_hijos=$this->gruposHijos();///IMPORTANTE: (crera funcion grupos hijos) necesitamos los grupos que son hijos del grupo al que le estan pidiendo cambiar la branch
        //se mira el grupo al que pertenecen los encargados del grupo al que se le va cambiar la branch
        $grupo_padre=$encargado->grupo();
        $branch=$grupo_padre->branch+""+$this->id+",";

        $this->branch=$branch;
        $this->save();
        /////////////////necesito es comprobar si el asistente tiene grupos y cambairle las branch
        foreach($grupos_hijos as $grupo_hijo)
        {
            $tam=strlen(",$grupo_padre->id,");
            $pos=strpos($grupo_hijo->branch, ",$grupo_padre->id,");
            $branch_nuevo=$grupo_padre->branch.substr($grupo_hijo->branch, $pos+$tam);
            $grupo_hijo->branch=$branch_nuevo;
            $grupo_hijo->linea_id=$grupo_padre->linea_id;
            if($grupo_hijo->save())
            {
                foreach($grupo_hijo->asistentes as $integrante){
                    $integrante->linea_id=$grupo_padre->linea_id;
                    $integrante->save();
                }
            }

        }
     }*/

     //todos los grupos hijos del grupo
   /* public function gruposHijos($tipo="objeto")
    {
        $grupos_hijos=Grupo::whereRaw("branch LIKE '%,".$this->id.",%' AND id<>".$this->id);

        return $grupos_hijos;
    }*/

     //todos los grupos hijos del grupo
    public function gruposHijos($tipo="objeto")
    {
        $grupos_padres[0]=$this->id;
        $grupos_hijos=array();
        while(count($grupos_padres)>0)
        {
            $nuevos_hijos=array();
            for($i=0; $i<count($grupos_padres); $i++)
            {
                $grupo=Grupo::find($grupos_padres[$i]);
                $nuevos_hijos=array_merge($nuevos_hijos, Helper::obtenerArrayIds($grupo->hijos()->where("dado_baja", "0")->get()));
            }
            $grupos_padres=$nuevos_hijos;
            $grupos_hijos=array_merge($grupos_hijos, $nuevos_hijos);
        }
        if($tipo=="objeto"){
            $grupos_hijos= Grupo::whereIn('id', $grupos_hijos); 
        }
        return $grupos_hijos;
    }

    public static function gruposNivel($nivel, $tipo="objeto")
    {
        $grupos_padres=Grupo::gruposPrincipales('array');
        $grupos_hijos=$grupos_padres;
        $n=0;
        while($n<$nivel)
        {
            $hijos_nivel=array();
            for($i=0; $i<count($grupos_padres); $i++)
            {
                $grupo=Grupo::find($grupos_padres[$i]);
                $hijos_nivel=array_merge($hijos_nivel, Helper::obtenerArrayIds($grupo->hijos()->where("dado_baja", "0")->get()));
            }
            $grupos_padres=$hijos_nivel;
            $grupos_hijos=$hijos_nivel;
            $n++;
        }
        if($tipo=="objeto"){
            $grupos_hijos= Grupo::whereIn('id', $grupos_hijos); 
        }
        return $grupos_hijos;
    }

    public function notificarLideres($tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador="", $url, $dato_adicional=""){
        Notificacion::notificarLideres($this->asistentes()->first()->id, $tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador, $url, $dato_adicional);
        return "true";
    }

    public static function gruposPrincipales($tipo="objeto")
    {
        $grupos=array();
        $iglesia=Iglesia::find(1);
        $pastores=$iglesia->pastoresEncargados;
        foreach ($pastores as $pastor) {
            $grupos=array_merge($grupos, Helper::obtenerArrayIds($pastor->grupos()->where('dado_baja', 0)->get()));
        }
        if($tipo=="objeto"){
            $grupos= Grupo::whereIn('grupos.id', $grupos); 
        }

        return $grupos;

    }

    public function ultimoReporte(){
        $grupo=$this;
        $ultimo_reporte=$grupo->reportes()->orderBy('fecha', 'desc')->first();
        return $ultimo_reporte;
    }

    public function promedioAsistencia($fecha_desde, $fecha_hasta){
        $reportes=$this->reportes()->where('fecha','<=', $fecha_hasta)->where('fecha', '>=', $fecha_desde)->get();
        //$mes_inicio=(int)date('m', strtotime($fecha_desde));
        //$mes_fin=(int)date('m', strtotime($fecha_hasta));
        //$minimo_de_reportes_mes=($mes_fin-($mes_inicio-1))*(int)$this->reuniones_por_mes;
        $promedio=0;
        foreach ($reportes as $reporte) {
            $promedio+=(int)$reporte->cantidadAsistentes();
        }
        if($reportes->count()>0/*$minimo_de_reportes_mes*/)
        {
            $promedio=$promedio/(int)$reportes->count();
        }
        /*else
        {
            $promedio=$promedio/$minimo_de_reportes_mes;
        }*/
        return $promedio;
    }

    public function integrantesALaFecha($fecha, $tipo="object"){
        $integrantes="";
        $integrantes_array=array();
        $integrantes=$this->asistentes()->withTrashed()->where('fecha_ingreso', '<', $fecha)->get();
        foreach ($integrantes as $integrante) {
            $ultimo_dado_baja=$integrante->reportesBajaAlta()->where('dado_baja', 1)
            ->where('created_at', '<', $fecha)->orderBy('created_at', 'desc')->first();
            if(isset($ultimo_dado_baja->id))
            {
                $dado_alta=$integrante->reportesBajaAlta()->where('dado_baja', 0)
                ->where('created_at', '>', $ultimo_dado_baja->created_at)->where('created_at', '<', $fecha)
                ->orderBy('created_at', 'desc')->first();
                if(isset($dado_alta->id)){
                    array_push($integrantes_array, $integrante->id);
                }
            }
            else
            {
                array_push($integrantes_array, $integrante->id);
            }

        }

        if($tipo=="object"){
            $integrantes_array= Asistente::whereIn('asistentes.id', $integrantes_array); 
        }
        return $integrantes_array;


    }

    public function alDia(){
        $ultimo_reporte=$this->reportes()->orderBy('fecha', 'desc')->first();
        $fecha_reporte=strtotime(Helper::sumaDiasFecha(date($ultimo_reporte['fecha']), '+8'));
        $fecha_actual=strtotime(date("d-m-Y H:i:00",time()));
        if($fecha_reporte>$fecha_actual)
            return true;
        else
            return false;
    }

}

?>