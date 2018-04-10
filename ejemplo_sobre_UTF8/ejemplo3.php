<?php
    $cnx = mysqli_connect("localhost", "root", "", "ejemplobd", "3306");
	$tmp = mysqli_query($cnx,"set names utf8");
	$sql = "select * from tabla_ejemplo";
	$tmp = mysqli_query($cnx, $sql);
	$rpta = mysqli_fetch_assoc($tmp);
	echo $rpta['caracter'];
?>