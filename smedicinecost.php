<?php 

require_once("connection.php");
require_once("lib/nusoap.php");

$server = new nusoap_server();

$server->register('mcost');


function mcost($group,$patient_id){
	if( !$group || !$patient_id ){ 
		return new soap_fault('Client','','Put Your Name!'); 
		echo "error";
	}

	$query = "select sum(cost) as mcost from group_medicine natural join medicine where medicine_group='$group' ";
	//return $query;
	$result=mysql_query($query);
	$arr=mysql_fetch_assoc($result);
	$mcost=$arr['mcost'];
	//return $mcost;
	$query = "update patient set total_paid=(total_paid + $mcost) where patient_id='$patient_id' ";
	//return $query;
	mysql_query($query);
	$query = "update account set amount=(amount + $mcost) where patient_id='$patient_id' ";
	//return $query;
	mysql_query($query);	

	$query = "select medicine_name as naam, cost from group_medicine natural join medicine where medicine_group='$group' ";
	//return $query;
	$result=mysql_query($query);
	while ($arr=mysql_fetch_row($result)){
			$darshan[] =array($arr[0],$arr[1]);
	}
	

	return $darshan;

}

// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
 


 ?>