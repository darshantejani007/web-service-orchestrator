<?php 
	$username = "root";
	$passwd="";
	$database = "dbis_hospital";
	$localhost ="localhost"; 
	$con = mysql_connect($localhost,$username,$passwd) or die("couldn't connect to server");
	mysql_select_db($database, $con) or die("Could not select database");

 ?>