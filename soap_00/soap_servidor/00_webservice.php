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
	$server->register("mostrarMensaje");
	$server->register("mostrarSaludo");
	$server->register("operacionMultiplicar");
	
	$server->service($HTTP_RAW_POST_DATA);
?>