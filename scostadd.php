<?php 

require_once("connection.php");
require_once("lib/nusoap.php");

$server = new nusoap_server();

$server->register('cost');


function cost($disease,$patient_id ,$strength,$doctor_id){
	if( !$disease || !$patient_id || !$strength || !$doctor_id){ 
		return new soap_fault('Client','','Put Your Name!'); 
		echo "error";
	}

	$query = "select cost from cost_of_diseases join patient using (disease_name,disease_strength) where patient_id='$patient_id' and disease_name='$disease' and disease_strength='$strength' ";
	//return $query;
	$result=mysql_query($query);
	$arr=mysql_fetch_assoc($result);
	$cost=$arr['cost'];
	$query = "update doctor set extra_income=(extra_income + ($cost*0.5)) where doctor_id='$doctor_id'";
	mysql_query($query);
	$query="insert into account values ('$doctor_id','$patient_id',$cost*0.5)";
	mysql_query($query);
	$query = "update patient set total_paid=(total_paid + $cost) where patient_id='$patient_id'";
	mysql_query($query);
	
	//$doctor_name= $arr['naam'];
	//$id=$arr['id'];
	//$feedback = $arr['maxima'];
	return $cost;

}

// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
 


 ?>