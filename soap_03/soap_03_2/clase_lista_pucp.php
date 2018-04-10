<?php
/**
* 
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @author   Scott Nichol <snichol@users.sourceforge.net>
* @version  $Id: class.wsdl.php,v 1.76 2010/04/26 20:15:08 snichol Exp $
* @access public 
*/
  class lista_pucp{
  	
	private $raw_lista="";
	public  $alumno;
	
	function __construct($profesor){
		
		$cnx = mysqli_connect("localhost", "root", "", "soap_03_02", "3306");
		
		if(mysqli_connect_errno()){
			echo "No se puedo realizar la conexion";
			exit();
		}
	   
	    mysqli_set_charset($cnx,"UTF8");
		
		$sql = "SELECT * FROM lista_alumnos_pucp where nombre_profesor = ?";
		$preparar_sentencia = mysqli_prepare($cnx,$sql);
		mysqli_stmt_bind_param($preparar_sentencia, 's',$profesor);
		
		$resultado = mysqli_stmt_execute($preparar_sentencia);
		
		mysqli_stmt_bind_result($preparar_sentencia,$nombre_alumno,$telefono,$edad,$fecha_nac,$nombre_profesor,$promedio);
		
		if(!$resultado){
		    echo "Error al ejecutar consulta";
		}else {
			while ($file =  mysqli_stmt_fetch($preparar_sentencia)) {
			       $this->raw_lista .= $nombre_alumno.$telefono.$edad.$fecha_nac.$nombre_profesor.$promedio.PHP_EOL; 
			}
		}
		mysqli_stmt_close($preparar_sentencia);
	    mysqli_close($cnx);
	  }
	
	function get_raw_lista(){
		return $this->raw_lista;
	}
	
  }
?>