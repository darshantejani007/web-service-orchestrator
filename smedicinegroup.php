<?php 

require_once("connection.php");
require_once("lib/nusoap.php");

$server = new nusoap_server();

$server->register('group');


function group($disease,$patient_id ,$strength){
	if( !$disease || !$patient_id || !$strength){ 
		return new soap_fault('Client','','Put Your Name!'); 
		echo "error";
	}

	$query = "select cost_of_diseases.medicine_group as mgroup from cost_of_diseases join patient using (disease_name,disease_strength) where patient_id='$patient_id' and disease_name='$disease' and disease_strength='$strength' ";
	//return $query;
	$result=mysql_query($query);
	$arr=mysql_fetch_assoc($result);
	$group=$arr['mgroup'];
	$query = "update patient set medicine_group= '$group' where patient_id='$patient_id'";
	//return $query;
	mysql_query($query);
	
	//$doctor_name= $arr['naam'];
	//$id=$arr['id'];
	//$feedback = $arr['maxima'];
	return $group;

}

// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
 


 ?>