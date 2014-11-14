<?php 

require_once("connection.php");
require_once("lib/nusoap.php");

$server = new nusoap_server();

$server->register('search');


function search($disease,$strength,$patient_id){
	if( !$disease || !$strength || !$patient_id){ 
		return new soap_fault('Client','','Put Your Name!'); 
		echo "error"; 
	}

	$query="select doctor.doctor_id as id,doctor.name as naam,total_feedbacks,avg_feedback, max(avg_feedback) as maxima from cost_of_diseases natural join doctor_disease natural join doctor where disease_name = '$disease' and disease_strength = '$strength'";
	//return $query;
	$result=mysql_query($query);
	$arrr=mysql_fetch_assoc($result);
	$doctor_name= $arrr['naam'];
	$id=$arrr['id'];
	$feedback = $arrr['maxima'];

	$arr=array('naam'=>"$doctor_name",'id'=>"$id",'feedback'=>"$feedback",'avg_feedback'=>$arrr['avg_feedback'],'total_feedbacks'=>$arrr['total_feedbacks']);
	$query="update patient set doctor_id='$id' where patient_id='$patient_id'";
	mysql_query($query);
	return $arr;

}

// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
 


 