<?php
	ini_set('display_errors',0);
	require_once('lib/nusoap.php');
	$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0,'wsdl'");

	$parametro=array('profesor'=>"arevalo");
	$llega2=$cliente->call("buscar_alumnos",$parametro);
	echo $llega2;
?>