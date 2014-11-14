<center>
<?php 

require_once("connection.php");
require_once("lib/nusoap.php");




$insert_patient = new nusoap_client('http://localhost/dbms/sinsertpatient.php?wsdl');
$searchdoctor = new nusoap_client('http://localhost/dbms/ssearchdoctor.php?wsdl');
$costadd = new nusoap_client('http://localhost/dbms/scostadd.php?wsdl');
$addgroup = new nusoap_client('http://localhost/dbms/smedicinegroup.php?wsdl');
$medicinecost = new nusoap_client('http://localhost/dbms/smedicinecost.php?wsdl');



$name=$_POST['name'];
$contact=$_POST['contact'];
$bloodgroup=$_POST['bloodgroup'];
$disease=$_POST['disease'];
$strength=$_POST['strength'];




//web service 1
$param=array('name'=>"$name",'contact'=>"$contact",'bloodgroup'=>"$bloodgroup",'disease'=>"$disease",'strength'=>"$strength");

$patient = $insert_patient->call('insert_patient',$param); 
//Process result 

if($insert_patient->fault) 
{ 
echo "FAULT: <p>Code: (".$insert_patient->faultcode."</p>"; 
echo "String: ".$insert_patient->faultstring; 
} 
else 
{ 
$patient_id=$patient['patient_id'];
$patient_name=$patient['name'];
echo "<br>**********patient registered -web service 1******************<br>  patient id: ".$patient_id."<br>patient name: " . $name;
}



//web service 2
$param=array('disease'=>"$disease",'strength'=>"$strength",'patient_id'=>"$patient_id");

$arr = $searchdoctor->call('search',$param); 
//Process result 

if($searchdoctor->fault) 
{ 
echo "FAULT: <p>Code: (".$searchdoctor->faultcode."</p>"; 
echo "String: ".$searchdoctor->faultstring; 
} 
else 
{ 
$doctor_id=$arr['id'];
$doctor_name=$arr['naam'];
$avg_feedback=$arr['avg_feedback'];
$total_feedbacks=$arr['total_feedbacks'];
//echo "<br><br>*****".$arr;
echo "<br><br><br>*******doctor assigned -web service 2**********<br>  doctor id: ".$doctor_id."<br>doctor name: ".$doctor_name; 
}



//web service 3
$param=array('disease'=>"$disease",'patient_id'=>"$patient_id",'strength'=>"$strength",'doctor_id'=>"$doctor_id");
$cost= $costadd->call('cost',$param);

if($costadd->fault) 
{ 
echo "FAULT: <p>Code: (".$costadd->faultcode."</p>"; 
echo "String: ".$costadd->faultstring; 
} 
else 
{ 
	echo "<br><br><br>*************money paid for treatment - web service 3***************<br>"."$cost Rs. paid by patient for treatment<br>".$cost*0.5 . "added to doctor's account <br>".$cost*0.5 . "added to hospital account" ;
}


//web service 4
$param=array('disease'=>"$disease",'patient_id'=>"$patient_id",'strength'=>"$strength");
$group= $addgroup->call('group',$param);

if($addgroup->fault) 
{ 
echo "FAULT: <p>Code: (".$addgroup->faultcode."</p>"; 
echo "String: ".$addgroup->faultstring; 
} 
else 
{ 
	echo "<br><br><br>*************medicine group - web service 4***************<br>medicine group is: ".$group ;
}



//web service 5
$param=array('group'=>"$group",'patient_id'=>"$patient_id");
$mcost= $medicinecost->call('mcost',$param);


if($medicinecost->fault) 
{ 
echo "FAULT: <p>Code: (".$medicinecost->faultcode."</p>"; 
echo "String: ".$medicinecost->faultstring; 
} 
else 
{ 
	echo "<br><br><br>*************medicine cost added - web service 5***************<br>medicine list: <br>medicine\t\tcost<br>" ;
	foreach ($mcost as $key => $value) {
		foreach ($value as $key2 => $value2) {
			echo $value2."\t\t";
		}
		echo "<br>";
	}	
	$count=0;
	foreach ($mcost as $key => $value) {
		$count+=$value[1];
	}
	echo "total paid for medicine is : ".$count." (added to hospital account)";
}


 ?>

<br><br>

<form method="POST" action="feedback.php"> 
Rate Us: 
		<select name ="feedback">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select><br>
		<input type="submit" value="submit"/>
</form>
</center>