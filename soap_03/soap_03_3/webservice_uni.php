<?php
    ini_set("display_errors",0);
	include_once("lib/nusoap.php");
	include_once "clase_lista_uni.php";
	
	/**
	 * @param  profesor->string
	 * @return lista_completa_de_alumnos->string
	 */
	 
	function __autoload($nombreclase){
	   echo "La clase de nombre $nombreclase no existe";
	   exit;
	}
	
	function buscar_alumnos($alumnos){
		$alumnos_obj = new lista_uni($alumnos);
		return $alumnos_obj->get_raw_lista();
	}
	
	$servicio = new nusoap_server();
	$servicio->configureWSDL("Web Service de la UNI","urn:miserviciowsdl");
	$servicio->register("buscar_alumnos",
	                     array('profesor' => "xsd:string"),
						 array('return'=>"xsd:string"),
						 "urn:miserviciowsdl",
						 'urn:miserviciowsdl#buscar_alumnos',
						 "rpc",
						 "encoded",
						 "Esta funcion le devuelve la siguiente lista de alumnos acorde al profesor selecionado"
	);
						 
    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA = file_get_contents("php://input");
    }

    $servicio->service($HTTP_RAW_POST_DATA); buscar_alumnos($alumnos);
?>