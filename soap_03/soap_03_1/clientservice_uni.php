<?php

	ini_set('display_errors',0);
	require_once('lib/nusoap.php');
	$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0,'wsdl'");
	
	//ESTO SIRVE PARA REALIZAR DEPURACION.
	//$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0&XDEBUG_SESSION_START=ECLIPSE_DBGP_15235985228061,'wsdl'");

	// CON ESTO ACCEDEMOS A LA NUBE
	//$cliente=new nusoap_client("http://52.173.29.193/webservice_uni.php?wsdl&debug=0,'wsdl'");
	
	/*
	$parametro1=array('id_persona'=>"");
	$llega1=$cliente->call("buscar_personas",$parametro1);
	echo PHP_EOL."buscar_personas:".$llega1.PHP_EOL.PHP_EOL;
	
	$parametros2=array('nombre'=>"rosa",'ahorro'=>19,'sexo'=>'mujer','id_pais'=>7);
	$llega2=$cliente->call("insertar_persona",$parametros2);
	echo "insertar_persona: ".$llega2.PHP_EOL.PHP_EOL;
	
	$parametros3=array('id_persona'=>2,'nombre'=>'monci','ahorro'=>990,'sexo'=>'hombre','id_pais'=>3);
	$llega3=$cliente->call("actualizar_persona",$parametros3);
	echo "actualizar_persona: ".$llega3;
	*/
	 
	$parametros4=array();
	$llega4=$cliente->call("obtener_lista_paises",$parametros4);
	echo "obtener_lista_paises: ".$llega4;
	
?>