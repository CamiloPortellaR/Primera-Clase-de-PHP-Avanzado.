<?php
    $cnx = mysqli_connect("localhost", "root", "", "ejemplobd", "3306");
	$sql= "select * from tabla_ejemplo";
	$tmp = mysqli_query($cnx, $sql);
	$rpt = mysqli_fetch_assoc($tmp);
	echo $rpt['caracter'];
?>