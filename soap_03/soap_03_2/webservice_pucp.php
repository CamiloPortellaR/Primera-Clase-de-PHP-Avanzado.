<?php
    ini_set('display_errors',0);
	require_once("lib/nusoap.php");
	require 'clase_lista_pucp.php';

	function buscar_alumnos($profesor){
		$lista = new lista_pucp($profesor);
		$salida = $lista->get_raw_lista();
		return $salida;
	}	

	if(!isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	}
	
	$servicio_obj= new soap_server();
	$servicio_obj->configureWSDL("Informacion sobre WEB service PUCP","urn:servicio_web_pucp");
	$servicio_obj->soap_defencoding = 'utf-8';
	$servicio_obj->register("buscar_alumnos",
	                        array('profesor'=>'xsd:string'),
	                        array('return'=>'xsd:string'),
	                        'urn:servicio_web_pucp',
	                        'urn:servicio_web_pucp#buscar_alumnos',
	                        'rpc',
	                        'encoded',
	                        'funcion que sirve para mostrar los alumnos asociados a un detreminado profesor'
							);
	
	$servicio_obj->service($HTTP_RAW_POST_DATA);
?>