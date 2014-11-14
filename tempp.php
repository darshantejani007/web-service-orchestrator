<?php 
require('connection.php');
$query = "select medicine_name as naam, cost from group_medicine natural join medicine where medicine_group='fever3' ";
	echo $query;
	$result=mysql_query($query);
	
	while ($arr=mysql_fetch_assoc($result)){
		echo $arr['naam']."     ".$arr['cost']."<br>";
	}

 ?>