<?php
	ini_set('display_errors',0);
	require_once('lib/nusoap.php');

	$cliente=new nusoap_client("http://localhost/clase_01/soap_00/soap_servidor/00_webservice.php");
	
	$llega=$cliente->call("mostrarMensaje");
	echo $llega . "<br/>";
	
	$parametro=array('persona'=>"PERCY2");
	$llega2=$cliente->call("mostrarSaludo",$parametro);
	echo $llega2 . "<br/>";
	
	$valores=array('v1'=>12,'v2'=>100);
	$llega3=$cliente->call('operacionMultiplicar',$valores);
	echo $llega3 . '<br/>';
?>