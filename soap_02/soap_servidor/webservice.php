<?php
    ini_set("display_errors", 0);
    include_once 'lib/nusoap.php';
    $servicio = new soap_server();

    $ns = "urn:miserviciowsdl";
    $servicio->configureWSDL("MiPrimerServicioWeb",$ns);
    $servicio->schemaTargetNamespace = $ns;

    $servicio->register("MiFuncion", array('num1' => 'xsd:integer', 'num2' => 'xsd:integer'), array('return' => 'xsd:string'), $ns );

 /**
* nusoap_client_mime client supporting MIME attachments defined at
* http://www.w3.org/TR/SOAP-attachments.  It depends on the PEAR Mail_MIME library.
*
* @author   Camilo Portella
* @version  1
* @param integer $num1
* @param integer $num2
* @return string Devuelve el resultado de la suma y el contenido de los que recibio del cliente($HTTP_ROW_POST_DATA)
* @access public
*/
function MiFuncion($num1, $num2){

 global $HTTP_RAW_POST_DATA;

 $resultadoSuma = $num1 + $num2;
 $resultado = "El resultado de la suma de " . $num1 . "+" .$num2 . " es: ".$resultadoSuma.PHP_EOL.
 ' y el $HTTP_RAW_POST_DATA es: '.PHP_EOL.$HTTP_RAW_POST_DATA;	
 return $resultado;
 
}

    if( !isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	}
	
    //ESTO YA ESTA DEPRECADO.
    //$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    
    $servicio->service($HTTP_RAW_POST_DATA);
	
?>