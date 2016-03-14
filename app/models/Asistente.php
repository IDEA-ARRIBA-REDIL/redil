<?php
/** 
*
* @Redil Software. Asistente.php 
* @versión: 1.0.0     @modificado: 04 de Septiembre del 2015 
* @autor última modificación: Juan Carlos Velasquez  
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Asistente extends Eloquent {

    // Esta lineas de codigo se agregaron para que funcionaran el borraro parcial y el borrado total 
    // que remplazaran a dado de baja... 
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    public function __construct()
    {
        parent::__construct();

    }

    // ---- fin 

    //relacion para conocer de que lineas o lineas esta encargado el asistente
	public function lineas()
    {
        return $this->belongsToMany("Linea", "encargados_linea")->withTimestamps(); 
    }

    //relacion para conocer de que lineas o lineas esta encargado el asistente
    public function linea()
    {
        return $this->belongsTo("Linea");
    }

    //relacion para conocer de que grupo pertenece el asistente
    public function grupo() 
    { 
        return $this->belongsTo('Grupo'); 
    }

     //relacion para conocer de que tipo o es el asistente (nuevo, oveja, miembro, lider o pastor)
    
    public function tipoAsistente()
    { 
        return $this->belongsTo('TipoAsistente'); 
    }


    ///relacion para conocer los encargados de un grupo
    public function grupos()
    {
        return $this->belongsToMany("Grupo", "encargados_grupo")->withTimestamps(); 

    }   

    // relacion para saber que asistentes sirven en un grupo
    public function grupoServicio()
    {
        return $this->belongsToMany ("Grupo", "servidores_grupo")->withTimestamps();
    }

    public function departamentosEncargados()
    {
        return $this->belongsToMany("Departamento", "encargados_departamento")->withPivot('funcion','created_at','updated_at');
    }

    public function departamentosIntegrante()
    {
        return $this->belongsToMany("Departamento", "integrantes_departamento")->withPivot('cargo','funcion','created_at','updated_at');
    }

    //relacion para determinar si el asistente es un pastor principal de la iglesia
    public function iglesiaEncargada()
    {
        return $this->belongsToMany("Iglesia", "pastores_principales")->withTimestamps(); ;
    }

    public function user()
    { 
        return $this->hasOne('User'); 
    }

    // relacion con reporte cultos para seleccionar quien es el predicador  en un culto
    public function reporteReunion()
    { 
        return $this->hasMany("Reporte_Reunion", 'predicador');
    }

    // relacion con reporte cultos para seleccionar quien es el predicador diezmos en un culto
    public function reporteReunion_diezmos()
    { 
        return $this->hasMany("Reporte_Reunion", 'predicador_diezmos');
    }

    //relacion para determinar las ofrendas que ha hecho un asistente
    public function ofrendas()
    {
        return $this->hasMany("Ofrenda");
    }

    //funcion para crear relacion muchos a muchos entre Reporte_Grupos y Asistente
    public function reportesGrupo()
    {
        return $this->belongsToMany("ReporteGrupo", "asistencia_grupos")->withPivot('asistio','created_at','updated_at');
    }

    //funcion para crear relacion muchos a muchos entre Reporte_Cultos (reuniones) y Asistente
    public function reportesReunion()
    {
        return $this->belongsToMany("ReporteReunion", "asistencia_reuniones")->withPivot('created_at','updated_at');;
    }

     public function visitas()
    {
        return $this->hasMany("Visita")->withTimestamps(); 
    }   

    //funcion para crear relacion muchos a muchos entre pasos_creacimiento y Asistente
    public function pasosCrecimiento()
    {
        return $this->belongsToMany("PasoCrecimiento", 'crecimiento_asistentes', 'asistente_id', 'paso_crecimiento_id')->withPivot('created_at','updated_at');
    }

    public function visitasQueAsigno ()
    {
        return $this->hasMany("Visita","asignado_por");
    }

    public function reportesBajaAlta()
    {
        return $this->hasMany("ReporteBajaAlta"); 

    } 

    //////este metodo es para acceder a las notificaciones que el usuario generó mas no a las que el recibió
    public function notificacionesGeneradas ()
    {
        return $this->hasMany("Notificacion")->withTimestamps();;
    }

    ///////// relaciones para las solicitudes de traspaso de un asistente
    //solicitudes donde ha sido el asistente a traspasar de grupo
    public function solicitudes ()
    {
        return $this->hasMany("SolicitudTraspaso")->withTimestamps();;
    }

    // solicitudes que el asistente ha realizado para traspasar una persona a su grupo
    public function solicitudesHechas ()
    {
        return $this->hasMany("SolicitudTraspaso", 'solicita_id')->withTimestamps();;
    }

    // solicitudes que el asistente ha respondido para traspasar una persona de su grupo a otro
    public function solicitudesRespondidas ()
    {
        return $this->hasMany("SolicitudTraspaso", 'responde_id')->withTimestamps();;
    }

    // relacion con escuelas para seleccionar quien es el director  de una escuela
    public function escuelas()
    { 
        return $this->hasMany("Escuela", 'director_id');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// Metodos disponibles importantes y de mucho uso///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    //función que devuelve todos los discipulos (directos e indirectos) de un asistente
    ///lo que retorna puede luego apuntar a count o sum o where, etc
    //el parametro $tipo es opcional y se puede reemplazar por array si se requiere un arreglo de ids
    public function discipulos($tipo="objeto", $lista="sin-eliminados"){
        $discipulos=array();
        //if(Auth::user()->id!=1)
        if (isset($this->iglesiaEncargada()->first()->id))
        {
                if($lista=="sin-eliminados")
                    $discipulos= Helper::obtenerArrayIds(Asistente::whereRaw("1=1")->get());///necesitamos obtener los trashed de un grupo
                else if($lista=="solo-eliminados")
                    $discipulos=Helper::obtenerArrayIds(Asistente::whereRaw("1=1")->onlyTrashed()->get());///necesitamos obtener los trashed de un grupo
                else
                    $discipulos=Helper::obtenerArrayIds(Asistente::whereRaw("1=1")->withTrashed()->get());///necesitamos obtener los trashed de un grupo
        }
        else if(isset($this->lineas()->first()->id))
        {
            $lineas=$this->lineas;
            foreach ($lineas as $linea) {
                if($lista=="sin-eliminados")
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($linea->asistentes));///necesitamos obtener los trashed de un grupo
                else if($lista=="solo-eliminados")
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($linea->asistentes()->onlyTrashed()->get()));///necesitamos obtener los trashed de un grupo
                else
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($linea->asistentes()->withTrashed()->get()));///necesitamos obtener los trashed de un grupo
            }
        }
        else{
            $grupos=$this->gruposMinisterio()->get();
            
            foreach ($grupos as $grupo) {
                if($lista=="sin-eliminados")
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($grupo->asistentes));///necesitamos obtener los trashed de un grupo
                else if($lista=="solo-eliminados")
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($grupo->asistentes()->onlyTrashed()->get()));///necesitamos obtener los trashed de un grupo
                else
                    $discipulos=array_merge($discipulos, Helper::obtenerArrayIds($grupo->asistentes()->withTrashed()->get()));///necesitamos obtener los trashed de un grupo
            }  
        }     
        if($tipo=="objeto")
        {
            if($lista=="sin-eliminados")
                $discipulos=Asistente::whereIn('asistentes.id', $discipulos);
            else if($lista=="solo-eliminados")
                $discipulos=Asistente::onlyTrashed()->whereIn('asistentes.id', $discipulos);
            else
                $discipulos=Asistente::withTrashed()->whereIn('asistentes.id', $discipulos);
        }

        return $discipulos;
    }

    //todos los grupos directos e indirectos del asistente
    public function gruposMinisterio($tipo="objeto"){
        $grupos_ministerio=array();
        if (isset($this->iglesiaEncargada()->first()->id))
        {
            $grupos_ministerio=Helper::obtenerArrayIds(Grupo::where('dado_baja', '0')->get());
        }
        else if(isset($this->lineas()->first()->id))
        {
            $lineas=$this->lineas;
            foreach ($lineas as $linea) {
                $grupos_ministerio=array_merge($grupos_ministerio, $linea->grupos('array'));
            }
        }
        else
        {
            $grupos=$this->grupos()->where('dado_baja', '0')->get();
            $grupos_ministerio=Helper::obtenerArrayIds($grupos);
            foreach ($grupos as $grupo) {
                $grupos_ministerio=array_merge($grupos_ministerio, $grupo->gruposHijos("array"));
            }
        }
        if($tipo=="objeto")
        {
            $grupos_ministerio= Grupo::whereIn('grupos.id', $grupos_ministerio); 
        }

        return $grupos_ministerio;
    }
    /*
    public function discipulos($tipo="objeto")
    {
        $sql2="";
        $asistentes="";
        $asistentes_id=array();
        if($this->grupos()->count()>0)
        {
            $grupos=$this->grupos()->get();
            $c=0;
            foreach ($grupos as $grupo) 
            {
                if($c!=0)
                    $sql2.=" OR ";
                $sql2.="branch LIKE '%,".$grupo->id.",%'";
                $c++;
            }

            /////este es para conocer todos los grupos indirectos del usuario logueado
            $grupos_ids= array();
            $grupos=Grupo::whereRaw($sql2)->get(array('grupos.id'));

            foreach ($grupos as $grupo) {
                array_push($grupos_ids, $grupo->id);
            }
            $asistentes= Asistente::whereIn('grupo_id', $grupos_ids);
            //$this->discipulos=$asistentes;
        }
        else
        {
            $asistentes= Asistente::whereRaw('1=2');
        }
        if($tipo=="array"){
            $asistentes=$asistentes->get(array('id'));
            foreach($asistentes as $asist){
                array_push($asistentes_id, $asist->id);
            }
            return $asistentes_id;
        }
        else return $asistentes;

    }*/

    public function lideres($tipo="objeto")
    {
        $array_lideres=array();
        if(isset($this->grupo->id))
        {
            $grupo=$this->grupo;
            while(isset($grupo->id))
            {
                $array_lideres=array_merge($array_lideres, Helper::obtenerArrayIds($grupo->encargados));
                $grupo=$grupo->padre;
            }
            if($tipo=="objeto")
            {
                $array_lideres= Asistente::whereIn('asistentes.id', $array_lideres); 
            }
        }
        else if($tipo=="objeto") $array_lideres= Asistente::whereRaw('1=2'); 
            
        return $array_lideres;
    }

    /*
    //todos los grupos directos e indirectos del asistente
    public function gruposMinisterio($tipo="objeto")
    {
        if($this->grupos()->count()>0)
        {
            $grupos=$this->grupos()->get();
            $c=0;
            $sql="";
            foreach ($grupos as $grupo) 
            {
                if($c!=0)
                    $sql.=" OR ";
                $sql.="branch LIKE '%,".$grupo->id.",%'";
                $c++;
            }

            $grupos_indirectos=Grupo::whereRaw($sql);
        }
        else
        {
            $grupos_indirectos=Grupo::whereRaw("1=2");
        }
        return $grupos_indirectos;
    }

    public function calcularBranch()
     {
        //se obtiene el primer encargado del grupo para luego obtener todos sus grupos.
        $asistente=$this;
        $grupos_hijos=$asistente->gruposMinisterio()->get();
        //se mira el grupo al que pertenecen los encargados del grupo al que se le va cambiar la branch
        $grupo_padre=$asistente->grupo();
        
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

    public function cambiarLinea($id_linea, $cambio="sin-ministerio"){
        if($id_linea!=""){
            $this->linea_id=$id_linea;
        }
        else{
            $this->linea_id=null;
        }

        if($this->save() && $cambio=="con-ministerio")
        {
            foreach ($this->discipulos()->get() as $discipulo) {
                if($id_linea!=""){
                    $discipulo->linea_id=$id_linea;
                }
                else{
                    $discipulo->linea_id=null;
                }
                $discipulo->save();
            }
        }
    }

    public function cambiarGrupo($id_grupo, $cambio="sin-ministerio")
    {
        if($this->grupo_id!=$id_grupo)
        {
            $linea_id="";
            $grupo_nuevo=Grupo::find($id_grupo);
            $this->grupo_id = $id_grupo;
            if(isset($grupo_nuevo->linea()->id)){
                $linea_id=$grupo_nuevo->linea()->id;
                $this->linea_id = $linea_id;
            }
            else{
                $this->linea_id = null;
            }
            if($this->save())
            {
                $sql2="";
                $descripcion_asistente="ha realizado el traspaso de un asistente en tu ministerio";
                if($this->grupos()->count()>0)
                {
                    if($cambio=="con-ministerio")
                    {
                        //cambiaria el padre de los grupos directos
                        //$this->calcularBranch();
                        foreach($this->grupos as $grupo_ministerio)
                        {
                            $grupo_ministerio->grupo_padre=$id_grupo;
                            if($grupo_ministerio->encargados()->count()>1)
                            {
                                foreach($grupo_ministerio->encargados as $encargado){
                                    if($encargado->id!=$this->id){
                                        $grupo_ministerio->eliminarEncargado($encargado->id);
                                    }
                                }
                            }
                            $grupo_ministerio->save();
                        }

                        if(isset($grupo_nuevo->linea()->id)){
                            $linea_id=$grupo_nuevo->linea()->id;
                            $this->cambiarLinea($linea_id, "con-ministerio");
                        }
                        else
                            $this->cambiarLinea("", "con-ministerio");


                        $descripcion_asistente.=" y todos sus respectivos grupos";
                    }
                    else if($cambio=="sin-ministerio")
                    {
                        $this->grupos()->detach();
                    }
                }////fin if verifica si el asistente tiene grupos
                //se hace la notificaciones correspondientes
                //se notifican los nuevos lideres del asistente
                $descripcion_administrador="ha realizado el traspaso de un asistente";
                $url="/asistentes/perfil/".$this->id;
                Notificacion::notificarLideres($this->id,2, "Traspaso de asistente", $descripcion_asistente, $descripcion_administrador, $url);

                //se notifica el asistente
                $descripcion_asistente="te ha cambiado de grupo";
                $url="/asistentes/perfil/".$this->id;
                Notificacion::notificarUsuario($this->user->id,2, "Cambio de grupo", $descripcion_asistente, "", $url);
                //fin notificacion
                return true;
            }
            else
                return false;
        }
        else
            return false;

        
    }


    public static function lideresPrincipales($tipo="objeto")
    {
        $lideres=array();
        $grupos=Grupo::gruposPrincipales()->get();
        foreach ($grupos as $grupo) {
            $lideres=array_merge($lideres, Helper::obtenerArrayIds($grupo->asistentes));
        }
        if($tipo=="objeto"){
            $lideres= Asistente::whereIn('asistentes.id', $lideres); 
        }

        return $lideres;

    }

    //Funcion para definir estado inactivo a los que llevan mas de un mes sin reportarse en la iglesia
    public static function definirInactivosCulto(){

        $hoy = date("Y-m-d");
        $hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
        $hace30dias = date ( 'Y-m-d' , $hace30dias );
        $reportes_recientes = ReporteReunion::where("fecha", ">", $hace30dias)->get();

        $asistentes=array();
        foreach ($reportes_recientes as $reporte) {
            array_push($asistentes, $reporte->asistentes()->get()); 
        }

        $asistentes_ids_fin=array();
        for ($i=0;$i<count($asistentes); $i++) {
            $asistentes_reporte=$asistentes[$i];
            foreach($asistentes_reporte as $asistente)
            {
                if(isset($asistente->id))
                array_push($asistentes_ids_fin, $asistente->id);
            }
        }
        $asistentes_ids = array_unique($asistentes_ids_fin);
        
        $asistentes_inactivos=  Asistente::whereNotIn('id', $asistentes_ids)
                        ->get();

        foreach($asistentes_inactivos as $asistente)
            {
                $asistente->inactivo_iglesia=1;
                $asistente->save();
            }               

        return "Terminado";
    }

    public static function definirInactivosGrupo(){
        $hoy = date("Y-m-d");
        $hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
        $hace30dias = date ( 'Y-m-d' , $hace30dias );
        $asistentes= Asistente::get();
        foreach ($asistentes as $asistente) {
            $reportes_ultimo_mes=$asistente->reportesGrupo()->where('reporte_grupos.fecha', ">", $hace30dias)->where('asistio', '=', "1" );
            if($reportes_ultimo_mes->count()>0)
                $asistente->inactivo_grupo=0;
            else
                $asistente->inactivo_grupo=1;

            $asistente->save();
        }

        return "Terminado";
    }

}

?>