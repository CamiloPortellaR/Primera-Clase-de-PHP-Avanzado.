<?php
	ini_set('display_errors',0);
	require_once("lib/nusoap.php");
	
	/* ================== */
	function mostrarMensaje(){
		$mensaje="Mensaje de prueba";
		return $mensaje;
	}
	function mostrarSaludo($persona){
		$salida="Buen dia : $persona";
		return $salida;
	}
	
	function operacionMultiplicar($v1,$v2){
		$salida="El resultado de $v1 * $v2 es ::: " .$v1 * $v2;
		return $salida;
	}
	/* ================== */
	
	
	if( !isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	}
	
	
	$server=new soap_server;
	$server->configureWSDL("Info WS01","urn:infows00");
	
	$server->register("mostrarMensaje",
						array(), //parametro
						array('return'=>'xsd:string'), // respuesta
						'urn:infows00', //namespace
						'urn:infows00#mostrarMensaje', //accion
						'rpc', // estilo
						'encoded', // uso
						'Muestra descripcion del ws0');
						
	$server->register("mostrarSaludo",
						array('persona'=>'xsd:string'), //parametro
						array('return'=>'xsd:string'), // respuesta
						'urn:infows00', //namespace
						'urn:infows00#mostrarSaludo', //accion
						'rpc', // estilo
						'encoded', // uso
						'Muestra saludo a persona');
						
	$server->register("operacionMultiplicar",
						array('v1'=>'xsd:integer','v2'=>'xsd:integer'), //parametro
						array('return'=>'xsd:string'), // respuesta
						'urn:infows00', //namespace
						'urn:infows00#operacionMultiplicar', //accion
						'rpc', // estilo
						'encoded', // uso
						'Muestra saludo a persona');
	
	$server->service($HTTP_RAW_POST_DATA);
?>