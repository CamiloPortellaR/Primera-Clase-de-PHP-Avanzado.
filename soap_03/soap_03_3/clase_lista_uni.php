<?php
   /**
   * @author   Camilo Portella <camiloportella1@gmail.com>
   * @version  1.0
   * @access   public
   **/
   
   class lista_uni{
   	
	   private $lista_alumnos = "";
       
       public function __construct($profesor) {
       	
		 try{
           $mysqli_PDO_obj = new PDO('mysql:host=localhost;dbname=soap_03_03','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8')); 
		   $mysqli_PDO_obj->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		   $consulta_sql= "call obtener_datos(:nombre_profesor)";
		   $pdo_stmt=$mysqli_PDO_obj->prepare($consulta_sql);
		   $pdo_stmt->execute(array(':nombre_profesor'=>$profesor));
		   while ($registro=$pdo_stmt->fetch(PDO::FETCH_ASSOC)){
		   	  $this->lista_alumnos .= $registro["email"].PHP_EOL;
		   }
		   $pdo_stmt->closeCursor();
		 }catch(PDOException $e){
		 	die('Error:'.$e->__toString());
		 }
       }
	   
	   function __call($metodo,$atributos){
		   echo "Se ha invocado a una funcion inexistente de nombre :$metodo y atributos : $atributos";
	   }
	   
	   public function get_raw_lista(){
	   	  return $this->lista_alumnos;
	   }
   }
?>