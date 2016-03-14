<?php namespace Helpers;

class Helper {

    public static function obtenerArrayIds($array_objetos,$tabla="")
    {
        $array_final= array();
		foreach ($array_objetos as $objeto) {
            if($tabla=="")
			    array_push($array_final, $objeto->id);
            else
                array_push($array_final, $objeto[$tabla.'.id']);
		}

		return $array_final;

    }

    public static function transcurrido($time) {
        $frase="";
        date_default_timezone_set('America/Bogota');
        $transcurido = time()-$time;
        $tc['minutos'] = @$transcurido/60;
        $tc['horas'] = @$transcurido/3600;
        $tc['dias'] = @$transcurido/86400;
        $tc['meses'] = @$transcurido/'2629743,83';
        $tc['años'] = @$transcurido/31556926;
        $plu['minutos'] = (intval($tc['minutos'])==1) ? NULL : 's';
        $plu['horas'] = (intval($tc['horas'])==1) ? NULL : 's';
        $plu['dias'] = (intval($tc['dias'])==1) ? NULL : 's';
        $plu['meses'] = (intval($tc['meses'])==1) ? NULL : 's';
        $plu['años'] = (intval($tc['años'])==1) ? NULL : 's';
        $frase = ($transcurido<=60 AND $transcurido>0) ? 'menos de un minuto' : $frase;
        $frase = ($transcurido>60 AND $transcurido<=3600) ? intval($tc['minutos']).' minuto'.$plu['minutos'] : $frase;
        $frase = ($transcurido>3600 AND $transcurido<=86400) ? intval($tc['horas']).' hora'.$plu['horas'] : $frase;
        $frase = ($transcurido>86000 AND $transcurido<'2629743,83') ? intval($tc['dias']).' dia'.$plu['dias'] : $frase;
        $frase = ($transcurido>'2629743,83' AND $transcurido<31556926) ? intval($tc['meses']).' mes'.$plu['meses'] : $frase;
        $frase = ($transcurido>31556926 AND $transcurido<315569260) ? intval($tc['años']).' año'.$plu['años'] : $frase;
        $frase = ($transcurido>3155692600) ? 'mas de 10 años' : $frase;

        return $frase;
    }

    public static function listadoGeneral($tipo_objeto = "asistente", $objetos) {
        $array_campos_objeto;
        $listado="";
        $crearArreglo = $tipo_objeto;
        
        foreach ($objetos as $objeto) 
        {
             $array_campos_objeto=$crearArreglo();
             

        }

        return $listado;
    }

    //funcion para devolver el articulo correspondiente (el, la , los, las)
    //$genero (F/M), $sinplu es para definir si el articulo debe ser singular o plural, 
    //$opcion para otras opciones como la palabra "de" para devolver: del o de la
    public static function articulo($genero, $sinplu, $opcion=""){
        $articulo="";
        if($genero=="m"){
            if($sinplu=="singular"){
                if($opcion=="de"){
                    $articulo="del";
                }
                else if($opcion=="a"){
                    $articulo="al";
                }
                else{
                    $articulo="el";
                }
            }
            else{
                if($opcion=="de"){
                    $articulo="de los";
                }
                else if($opcion=="a"){
                    $articulo="a los";
                }
                else{
                    $articulo="los";
                }
            }
        }
        else if($genero=="f"){
            if($sinplu=="singular"){
                if($opcion=="de"){
                    $articulo="de la";
                }
                else if($opcion=="a"){
                    $articulo="a la";
                }
                else{
                    $articulo="la";
                }
            }
            else{
                if($opcion=="de"){
                    $articulo="de las";
                }
                else if($opcion=="a"){
                    $articulo="a las";
                }
                else{
                    $articulo="las";
                }
            }
        }

        return $articulo;
    }

    public static function separadorMiles($numero){
        return number_format($numero, 0, ',', '.');
    }

    /** * Reemplaza todos los acentos por sus equivalentes sin ellos * * @param $string * string la cadena a sanear * * @return $string * string saneada */ 
    public static function sanearString($string) { 
        $string = trim($string); 
        $string = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string ); 
        $string = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string ); 
        $string = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string ); 
        $string = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string ); 
        $string = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string ); 
        $string = str_replace( array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string ); 
        //Esta parte se encarga de eliminar cualquier caracter extraño 
        $string = str_replace( array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">“, “< ", ";", ",", ":", ".", " "), '', $string ); 
        return $string; 
    } 

    public static function sumaDiasFecha($fecha, $ndias)
    {
        $fecha_nueva = strtotime ( $ndias.' day' , strtotime ( $fecha ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
        $fecha_nueva = date ( 'Y-m-d' , $fecha_nueva );
        return $fecha_nueva;
    }

    public static function sumaMesesFecha($fecha, $nmeses, $formato="Y-m-d")
    {
        $fecha_nueva = strtotime ( $nmeses.' month' , strtotime ( $fecha ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
        $fecha_nueva = date ( $formato , $fecha_nueva );
        return $fecha_nueva;
    }

    public static function finalMes($elAnio,$elMes, $formato="Y-m-d") {
      return date($formato, (mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

    public static function fechaFormateada($fecha)
    {
        $date = date($fecha);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        return $dias[date("w", strtotime($date))]." ".date("d", strtotime($date))." de ".$meses[date("n", strtotime($date))-1]. " de ".date("Y", strtotime($date)) ;
    }

    /*public static function construyeUrlGet($variables){
        foreach ($variables as $variable) {
            if(isset($buscar)){
                if($buscar!="")
                {
                  $variables_get.="buscar=$buscar";
                  $n++;
                }
            }
        }
    }*/
    /*function asistente(){
     echo "función uno";
    }*/
}