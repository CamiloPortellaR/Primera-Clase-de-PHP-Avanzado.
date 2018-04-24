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
	
	function buscar_personas($id_persona=""){
		$obj_persona = new Ahorro();
		return $obj_persona->seleccionar_persona($id_persona);
	}
	
	function insertar_persona($nombre,$ahorro,$sexo,$id_pais){
		$obj_persona = new Ahorro();
		return $obj_persona->insertar_persona($nombre, $ahorro, $sexo, $id_pais);
	}
	
	function actualizar_persona($id_persona,$nombre,$ahorro,$sexo,$id_pais){
		$obj_persona = new Ahorro();
		return $obj_persona->actualizar_persona($id_persona, $nombre, $ahorro, $sexo, $id_pais);
	}
	
	function obtener_lista_paises(){
		$obj_pais = new Ahorro();
		return $obj_pais->obtener_lista_paises();
	}
	
	function borrar_persona($Id)
	{
		$obj_persona = new Ahorro();
		return $obj_persona->borrar_persona($Id);
	}
	
	$servicio = new nusoap_server();
	$servicio->configureWSDL("Web Service de la UNI","urn:miserviciowsdl");
	$servicio->register("buscar_personas",
	                     array('id_persona' => "xsd:integer"),
						 array('return'=>"xsd:string"),
						 "urn:miserviciowsdl",
						 'urn:miserviciowsdl#buscar_personas',
						 "rpc",
						 "encoded",
						 "Devuelve la lista de todas las personas o de una en particular"
	);
	$servicio->register("insertar_persona",
	                     array('nombre'=>"xsd:string",'ahorro'=>"xsd:integer",'sexo'=>"xsd:string",'id_pais'=>"xsd:integer"),
	                     array('return'=>"xsd:string"),
	                     "urn:miserviciowsdl",
						 'urn:miserviciowsdl#insertar_persona',
						 "rpc",
						 "encoded",
						 "Permite la insercion de personas"
	);
	$servicio->register("actualizar_persona",
	                     array('id_persona'=>'xsd:integer','nombre'=>"xsd:string",'ahorro'=>"xsd:integer",'sexo'=>"xsd:string",'id_pais'=>"xsd:integer"),
	                     array('return'=>"xsd:string"),
	                     "urn:miserviciowsdl",
						 'urn:miserviciowsdl#actualizar_persona',
						 "rpc",
						 "encoded",
						 "Permite la actualizacion de personas"
	);
	
	$servicio->register("obtener_lista_paises",
	                     array(),
	                     array('return'=>"xsd:string"),
	                     "urn:miserviciowsdl",
						 'urn:miserviciowsdl#obtener_lista_paises',
						 "rpc",
						 "encoded",
						 "Permite cargar la lista de paises"
	);
	$servicio->register("borrar_persona",
	                     array('Id'=>'xsd:integer'),
	                     array('return'=>"xsd:string"),
	                     "urn:miserviciowsdl",
						 'urn:miserviciowsdl#borrar_persona',
						 "rpc",
						 "encoded",
						 "Permite eliminar a una persona"
	);
						 
    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA = file_get_contents("php://input");
    }

    $servicio->service($HTTP_RAW_POST_DATA);
?>