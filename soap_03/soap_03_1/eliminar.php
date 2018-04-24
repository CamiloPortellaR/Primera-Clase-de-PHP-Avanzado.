<?php
   ini_set('display_errors',0);
   ini_set("session.use_strict_mode",1);   //////////////  IMPORTANTE
  require_once('lib/nusoap.php');



  // DESDE UN SERVIDOR EN LA NUBE
  //$cliente=new nusoap_client("http://52.173.29.193/webservice_uni.php?wsdl&debug=0,'wsdl'");
  
  //ESTO SIRVE PARA REALIZAR DEPURACION.
  //$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0&XDEBUG_SESSION_START=ECLIPSE_DBGP_15235985228061,'wsdl'");
  
  // DESDE UN SERVIDOR LOCAL
  $cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0,'wsdl'");


  $Id= test_input($_GET['id']);
  
  if(empty($Id)){
  	session_start();
	$_SESSION['mensaje']= "No ha seleccionado a una persona para eliminar";
	 die(header('Location: index.php'));  
  }
  
  $persona=array('Id'=>$Id);
  $borrar_persona=$cliente->call("borrar_persona",$persona);
  $borrar_persona = json_decode($borrar_persona);
  
  session_start();
  
  if(array_key_exists('error_capturado', $borrar_persona) === FALSE){
	 $_SESSION['mensaje']= "La persona ha sido eliminada satisfactoriamente";
	 die(header('Location: index.php'));
  }
  
  $_SESSION['mensaje']= "La persona no ha podido ser eliminada satisfactoriamente, la razon es :".$buscar_persona->error_capturado;
  
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  
?>