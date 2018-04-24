<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Mostrar_Personas</title>
		<meta name="description" content="">
		<meta name="author" content="Administrator">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="Cabezera_0.css"/>
	    
	</head>
<?php

	ini_set('display_errors',0);
	ini_set("session.use_strict_mode",1);   //////////////  IMPORTANTE
	require_once('lib/nusoap.php');
	
	// CON ESTO ACCEDEMOS AL SERVIDOR LOCAL
	$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0,'wsdl'");
	
	//ESTO SIRVE PARA REALIZAR DEPURACION.
	//$cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0&XDEBUG_SESSION_START=ECLIPSE_DBGP_15235985228061,'wsdl'");

	// CON ESTO ACCEDEMOS A LA NUBE
	//$cliente=new nusoap_client("http://52.173.29.193/webservice_uni.php?wsdl&debug=0,'wsdl'");
	
	
	$parametro1=array('id_persona'=>"");
	$buscar_personas=$cliente->call("buscar_personas",$parametro1);
	$buscar_personas = json_decode($buscar_personas);
	//echo PHP_EOL."buscar_personas:".$buscar_personas.PHP_EOL.PHP_EOL;
	
	//$parametros2=array('nombre'=>"rosa",'ahorro'=>19,'sexo'=>'mujer','id_pais'=>7);
	//$insertar_persona=$cliente->call("insertar_persona",$parametros2);
	//echo "insertar_persona: ".$insertar_persona.PHP_EOL.PHP_EOL;
	
	//$parametros3=array('id_persona'=>2,'nombre'=>'monci','ahorro'=>990,'sexo'=>'hombre','id_pais'=>3);
	//$actualizar_persona=$cliente->call("actualizar_persona",$parametros3);
	//echo "actualizar_persona: ".$actualizar_persona;
?>
	<body onload="camilo()">
		<div class="container-fluid">
			
			 <div class="row" style="text-align: center">
			 	<h2>Lista de Personas</h2> 
			 </div>
			
			<div class="container-fluid" style="margin-top: 15px;text-align: center">
 	         		<div id="mensajes_configuracion_linealizacion_titulacion_y_alarmas" class="row">
 	         			<?php session_start(); ?>
 	         			<?php if(array_key_exists("mensaje", $_SESSION)) : ?>
                      	   <span class="glyphicon glyphicon-ok" style="color: red;"></span> <span style="color: red;font-weight: bolder;font-style: oblique;"> 
                      	   	 <?php echo $_SESSION['mensaje'];  session_unset($_SESSION['mensaje'])  ?></span>
                        <?php endif; ?>
                    </div>
 	        </div>
			
			<div class="row" style="overflow-x:auto;padding-left: 15px;padding-right: 15px;">
               
              <table id="customers" style="white-space:nowrap;margin: auto;">
                <thead>
                	<tr>
	                	<th>Id</th>
	                	<th>Nombre</th>
	                	<th>Ahorro</th>
	                	<th>Sexo</th>
	                	<th>Pais</th>
                	</tr>
                </thead>
                <tfoot>
                	<tr>
	                	<td colspan="5" style="text-align: center;background: #4caf50;color: white;">Fin de tabla</td>
                	</tr>
                </tfoot>
                
                <?php if(!empty($buscar_personas)): 
                        foreach ($buscar_personas as $persona) :
				?>
				
                <tbody>
                	<tr>
	                	<td><?php echo $persona->Id ?></td>
	                	<td><?php echo $persona->Nombre ?></td>
	                	<td><?php echo $persona->Ahorro ?></td>
	                	<td><?php echo $persona->Sexo ?></td>
	                	<td><?php echo $persona->Nombre_Pais ?></td>
                	</tr>
                </tbody>
                
               <?php 
                        endforeach; 
                        endif; 
               ?>
               
               </table>
               </div>
               
              <div class="row" style="text-align: center;margin-top: 20px;">
                 <div style="display: inline-block;border-right-width: 20px;margin-bottom: 20px;">
	              	<a href="adicionar.php">Adicionar Registro</a>
	             </div>
	              	<div style="display: inline-block;border-right-width: 20px;margin-bottom: 20px;">
	              	<a id="id_id" href="actualizar.php?id=">Actualizar Registro</a></button>
	             </div>
	             <div style="display: inline-block;border-right-width: 20px;margin-bottom: 20px;">
	              	<a id="id2" href="eliminar.php?id=">Eliminar Registro</a>
	             </div>
              	 
              </div>
              	 
              	 <div class="row" id="Linea_inferior">
	              <p id="Datos_autor">&copy; Copyright  by Camilo SAC</p>
              </div> 
              	 
              </div> 
              <script>
              	
              	var id_usuario=document.querySelector("#id_id").href;
              	var id_usuario2=document.querySelector("#id2").href;
              	
              	function camilo(){
              	   var x = document.querySelectorAll("#customers > tbody tr");
              	   //alert(x.length);
              	   for (i = 0; i < x.length; i++){ 
              	       x[i].addEventListener("click",displayId);
              	    }
              }
              		function displayId()
              		{
              			
              			var x = document.querySelectorAll("#customers > tbody tr");
              			 for (i = 0; i < x.length; i++){ 
              	            x[i].style.backgroundColor="#f2f2f2";
              	        }
              	        document.querySelectorAll("#customers").borderCollapse="collapse";
              			 this.style.backgroundColor = "red";
              			var nodelist = this.querySelector("td").innerHTML;
              			console.log(nodelist);
              			var z = id_usuario + nodelist;
              			var v = id_usuario2 +nodelist;
              			document.querySelector("#id_id").href = z;
              			document.querySelector("#id2").href= v;
              	    }
              	
              </script>

	</body>
</html>
