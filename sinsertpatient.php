<?php 

require_once("connection.php");
require_once("lib/nusoap.php");

$server = new nusoap_server();

$server->register('insert_patient');


//function insert_patient($name , $contact, $bloodgroup, $disease,$strength){
function insert_patient($name , $contact, $bloodgroup, $disease,$strength){	
	if(!$name || !$contact || !$bloodgroup || !$disease || !$strength){ 
		return new soap_fault('Client','','Put Your Name!'); 
		echo "error";
	}
	
	$query="insert into patient(name,bloodgroup,contact_no,disease_name,disease_strength) values ('$name','$bloodgroup','$contact','$disease','$strength')";
	//return $query;
	$bool=mysql_query($query);
	$query="select patient_id,name from patient where name='$name' and bloodgroup='$bloodgroup' and contact_no='$contact' and disease_name='$disease' and disease_strength='$strength'";
	//return $query;
	$result=mysql_query($query);
	$arr=mysql_fetch_assoc($result);
	return $arr;
}




// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
 


 ?>