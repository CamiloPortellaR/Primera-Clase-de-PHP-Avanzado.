<?php

  /**
   * @author  Camilo Portella Retuerto
   * @version 2.0
   * @access  public
   **/
   
   /// ESTO NO LO USE EN PRODUCCION   --->    ini_set('display_errors',0);
   //ini_set('display_errors',1);
 class Ahorro 
 {
     
	 private $errores = array(array("sql_state"=>"23000","error"=>"1062","descripcion"=>"El nombre que ingreso ya existia"),
	                          array("sql_state"=>"90001","error"=>"12345","descripcion"=>"El sexo no era ni hombre ni mujer"),
	                          array("sql_state"=>"90002","error"=>"12346","descripcion"=>"El sexo no era ni hombre ni mujer"),
	                          array("sql_state"=>"23000","error"=>"1452","descripcion"=>"El id del pais seleccionado no existe")
	                          );
	 
     function __construct() {
     }
	 
	 private function detectar_error($error)
	 {
	 	 $error_final = array("error_capturado"=>$error);
		 foreach ($this->errores as $key) {
		 	
			$pos_sql_state = strpos($error, $key['sql_state']);
			$pos_error = strpos($error, $key['error']); 
			
		    if($pos_sql_state !== false  && $pos_error !== false){
			   $error_final['error_capturado'] = $key['descripcion'];
			   break;
		    }
			 
		 };
		 
		 return json_encode($error_final);
	 }
	 
	 function _call($metodo){
	 	echo "El metodo de nombre $metodo no existe";
	 }
	 
	 public function seleccionar_persona($id_persona="")
	 {
		try
		{
		   $obj_pdo = new PDO('mysql:host=localhost;dbname=soap_03_03',"root","",array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8')); 
		   $obj_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		   $sql = ($id_persona=="")?  "CALL `select_todos_los_datos`()": "CALL `datos_persona`(:Id)";
		   $obj_pdo_stmt = $obj_pdo->prepare($sql);
		   ($id_persona=="")? $obj_pdo_stmt->execute(): $obj_pdo_stmt->execute(array(':Id'=>$id_persona));
		   $array_total=array();
		   while($resultado = $obj_pdo_stmt->fetch(PDO::FETCH_ASSOC)){
		   	array_push($array_total,$resultado);
		   }
		   $array_total = json_encode($array_total);
		   return $array_total;
		}catch(exception $e)
		{
		   return $e->getMessage();
		}
	 } 
	 
	 public function insertar_persona($nombre,$ahorro,$sexo,$id_pais)
	 {
	 	try{
	 	$obj_pdo = new PDO("mysql:host=127.0.0.1;dbname=soap_03_03","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
		$obj_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CALL `insertar_tabla_ahorro`(:nombre,:ahorro,:sexo,:id_pais)";
		$obj_stmt = $obj_pdo->prepare($sql);
		$obj_stmt->execute(array(':nombre'=>$nombre,':ahorro'=>$ahorro,':sexo'=>$sexo,':id_pais'=>$id_pais));
		$array_total = array();
		while( $resultado = $obj_stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($array_total,$resultado);
		}
		return json_encode($array_total);
	    }catch(exception $e){
	    	return $this->detectar_error($e->getMessage());
	    }
	 }
	 
	 public function actualizar_persona($Id,$Nombre,$Ahorro,$Sexo,$Id_Pais)
	 {
	 	try{
	 	$obj_pdo = new PDO("mysql:host=127.0.0.1;dbname=soap_03_03","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
		$obj_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql="CALL `actualizar_persona`(:Id,:Nombre,:Ahorro,:Sexo,:Id_Pais)";
		$obj_stmt = $obj_pdo->prepare($sql);
		$obj_stmt->execute(array(":Id"=>$Id,":Nombre"=>$Nombre,":Ahorro"=>$Ahorro,":Sexo"=>$Sexo,"Id_Pais"=>$Id_Pais));
		$array_total = array();
		while($resultado = $obj_stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($array_total,$resultado);
		}
		return json_encode($array_total);
	    }catch(exception $e){
	    	return $this->detectar_error($e->getMessage());
	    }
	 }

	 public function obtener_lista_paises()
	 {
	 	try
	 	{
	 	  $obj_pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=soap_03_03',"root","",array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
		  $obj_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		  $sql = "CALL obtener_lista_paises()";
		  $obj_stmt = $obj_pdo->prepare($sql);
		  $obj_stmt->execute(array());
		  $array_total=array();
		  while($resultado=$obj_stmt->fetch(PDO::FETCH_ASSOC))
		  {
		  	array_push($array_total,$resultado);
		  }
		  $obj_stmt->closeCursor();
		  $array_total=json_encode($array_total);
		  return $array_total;
	 	}catch(exception $e)
		{
			return $e->getMessage();
		}
	 }
	 
	 public function borrar_persona($Id)
	 {
	 	try{
	 		$obj_pdo = new PDO('mysql:host=127.0.0.1;dbname=soap_03_03',"root","",array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
			$obj_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = "call  `eliminar_persona`(:Id)";
			$obj_stmt = $obj_pdo->prepare($sql);
			$obj_stmt->execute(array(':Id'=>$Id));
			$array_total = array();
			while ($resultado = $obj_stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($array_total,$resultado);
			}
			$array_total=json_encode($array_total);
			$obj_stmt->closeCursor();
			return $array_total;
	 	}catch(exception $e){
	 		return $this->detectar_error($e->getMessage());
	 	}
	 }
	 
 }

  //$obj = new Ahorro();
  //echo $obj->obtener_lista_paises();
  //echo $obj->seleccionar_persona();
  //echo $obj->insertar_persona("Carla",234,"mujer",7);
  //echo $obj->actualizar_persona(24,'rosa1dfg',9,'Hombcghcre',88);
  //echo $obj->borrar_persona(75);

?>