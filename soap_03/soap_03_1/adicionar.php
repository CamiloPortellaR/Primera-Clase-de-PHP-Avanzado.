<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Adicion_Personas</title>
		<meta name="description" content="">
		<meta name="author" content="Administrator">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        	
	     <!-- Archivo personalizados -->
         <style>
				 #Linea_inferior{
				    position: fixed;/*Fija la posicion respecto del viewport osea de la pagina web*/
				  	bottom: 0%;
				  	/*left: 0%;*/
				  	width: 100%;
				  	font-size: 85%;
				  	background-color: #98ADC8;	
				  	color: #FFF;
				    text-align: center;
				    }
				  #Datos_autor{
				    margin-bottom: 0px;
				    }
         </style>
	</head>
<?php

    ini_set('display_errors',0);
	require_once('lib/nusoap.php');
	ini_set("session.use_strict_mode",1);   //////////////  IMPORTANTE
	
    // DESDE UN SERVIDOR EN LA NUBE
    // $cliente=new nusoap_client("http://52.173.29.193/webservice_uni.php?wsdl&debug=0,'wsdl'");
  
    // DESDE UN SERVIDOR LOCAL
       $cliente=new nusoap_client("http://localhost/clase_01/soap_03/soap_03_3/webservice_uni.php?wsdl&debug=0,'wsdl'");
  
       $paises=array();
	   $obtener_lista_paises=$cliente->call("obtener_lista_paises",$paises);
	   $obtener_lista_paises = json_decode($obtener_lista_paises);
  
    $aviso_advertencia = FALSE;


  if($_SERVER['REQUEST_METHOD']=="POST"){
	
    $nombre = test_input($_POST['nombre']);
	$ahorro =test_input($_POST['ahorro']);
	$sexo = test_input($_POST['sexo']);
	$id_pais = test_input($_POST['id_pais']);
	
	$parametros2=array('nombre'=>$nombre,'ahorro'=>$ahorro,'sexo'=>$sexo,'id_pais'=>$id_pais);
	$insertar_persona=$cliente->call("insertar_persona",$parametros2);
	$insertar_persona=json_decode($insertar_persona);
	
	if(array_key_exists("error_capturado", $insertar_persona) === FALSE){
		session_start();
		$_SESSION['mensaje'] = "Registro adicionado correctamente";
		die(header('Location: index.php'));
	}
	
	$aviso_advertencia = TRUE;
	
  }
  
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


	<body>
		<div class="container-fluid">
			
			 <div class="row" style="text-align: center">
			 	<h2>Adicion de Personas</h2> 
			 </div>
			
			<div class="container-fluid" style="margin-top: 15px;text-align: center">
 	         		<div id="mensajes_configuracion_linealizacion_titulacion_y_alarmas" class="row">
 	         			<?php if($aviso_advertencia) : ?>
                      	   <span class="glyphicon glyphicon-ok" style="color: red;"></span> <span style="color: red;font-weight: bolder;font-style: oblique;"> 
                      	   	El registro no se adiciono por que :<?php echo $insertar_persona->error_capturado; ?></span>
                        <?php endif; ?>
                      </div>
 	        </div>
			
			<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" class="form" method="post">
				
              <div class="row" style="width: 300px;margin: auto;text-align: center;">
                  <label>Nombre:</label>
                  <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre" required="required" value="<?php ($_SERVER['REQUEST_METHOD']=="POST")? print($nombre):print(""); ?>">          
               </div>
                            
               <div class="row" style="width: 300px;margin: auto;text-align: center;margin-top: 25px;">
                  <label>Ahorro:</label>
                  <input type="text" class="form-control" placeholder="Ingrese ahorro" name="ahorro" required="required" value="<?php ($_SERVER['REQUEST_METHOD']=="POST")? print($ahorro):print(""); ?>">  
               </div>
               
               <div style="margin: auto;text-align: center;margin-top: 20px;" id="Creacion_RH_inspeccion_externa">
                  <label>Seleccione Sexo :</label><br>
                  <label>
                  <input type="radio" name="sexo" value="Hombre" <?php if($_SERVER['REQUEST_METHOD']=="POST"){ ($sexo=="Hombre")? print("checked"):print(""); }else{print("checked");} ?>>Hombre
                  </label><br>
                  <label>
                  <input type="radio" name="sexo" value="Mujer" <?php if($_SERVER['REQUEST_METHOD']=="POST"){ ($sexo=="Mujer")? print("checked"):print(""); } ?>>Mujer
                  </label><br>   
               </div>

 	                <div id="Creacion_RH_medio_de_prueba" style="margin:auto;padding-top: 15px;width: 150px;">
 	             	 	<label>Seleccione Pais:</label>
                        <select name="id_pais" class="form-control">
                            <?php foreach ($obtener_lista_paises as $pais): ?>
                              <option value=<?php echo $pais->Id_Pais ?> <?php if(($_SERVER['REQUEST_METHOD']=="POST")){
                              	 ($pais->Id_Pais == $id_pais)? print("selected"):print("");
                              }
							   ?>><?php echo $pais->Nombre_Pais?></option>
                            <?php endforeach; ?>
                         </select>                  
 	                 </div>    
           
               
               <div class="row" style="width: 300px;margin: auto;text-align: center;margin-top: 25px;">
               	 <input type="submit" class="form-control" name="submit_adicionar"/>
               </div>
               
            </form>
            
              	 <div class="row" id="Linea_inferior">
	              <p id="Datos_autor">&copy; Copyright  by Tasami SAC</p>
              </div> 
              	 
              </div> 
	</body>
</html>
