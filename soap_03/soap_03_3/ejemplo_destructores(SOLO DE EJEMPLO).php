<?php
   /**
   * @author   Camilo Portella <camiloportella1@gmail.com>
   * @version  1.0
   * @access   public
   **/
   
   class lista_UNI_destrutores{
   	
	   private $lista_alumnos = "";
       
	   
	    function __destruct(){
	   	
		echo "finalizando instancia lista_UNI : $this->lista_alumnos".PHP_EOL;
		
	   }
       function __construct($profesor) {
           
		   echo "iniciando instancia lista_UNI ... profesor : $profesor".PHP_EOL;
		   $this->lista_alumnos=$profesor;
		   
       }
	   
	   public function probar($value)
	   {
		   echo "ingresaste el valor $value".PHP_EOL;
	   }
	   
	  
   }
   
   $d = new lista_UNI("camilo");
   $d->probar(4);
   
    $e = new lista_UNI("pedro");  
	sleep(4);
	$d->probar(5);
	sleep(4);
?>