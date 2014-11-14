<?php 
require('connection.php');
$query = "select medicine_name as naam, cost from group_medicine natural join medicine where medicine_group='fever3' ";
	echo $query;
	$result=mysql_query($query);
	while ($arr=mysql_fetch_assoc($result)){
		 $darshan[] = array($arr['naam'],$arr['cost']);
	}
	echo "<br><br>";
	foreach ($darshan as $key => $value) {
		foreach ($value as $key2 => $value2) {
			echo "\t".$value2."\t";
		}
		echo "<br>";
	}
 ?>