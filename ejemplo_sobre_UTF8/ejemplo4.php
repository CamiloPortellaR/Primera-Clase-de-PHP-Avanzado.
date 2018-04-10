<?php
    $cnx = mysqli_connect("localhost", "root", "", "bdCirilico", "3306");
	$sql = "select * from ejemplobd";
	$tmp = mysqli_query($cnx, $sql);
	$rpta = mysqli_fetch_assoc($tmp);
	echo $rpta["caracter"];
?>