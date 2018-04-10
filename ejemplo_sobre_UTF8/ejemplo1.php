<?php
    $cnx= mysqli_connect('localhost','root','','ss');
	$tmp = mysqli_query($cnx,"set names utf8");
	
	$sql = "select * from na";
	$tmp = mysqli_query($cnx, $sql);
	
	$rpta = mysqli_fetch_assoc($tmp);
	var_export($rpta);
?>