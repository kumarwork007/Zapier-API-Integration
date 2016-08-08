<?php

if(!empty($_GET['compid']))
{
	
	header("Content-type:application/json");
	$lid=$_GET['compid'];
	$conn=mysqli_connect('localhost','root','','technoch_aritra');
	$query="select * from sp_company where comp_id='$lid'";
	$runq=mysqli_query($conn,$query);
	$num=mysqli_num_rows($runq);
	if($num>0)
	{	
	$rows=mysqli_fetch_array($runq);
	$ci = $rows['company_name'];
	$lci = $rows['client_id'];
	$lcn = $rows['company_website'];
	$ld = $rows['target_city'];
	deliver_response(200,"Lead Data here",$lid,$ci,$lci,$lcn,$ld);
	}
	else
	{
	deliver_response(200,"No Lead Data",NULL,NULL,NULL,NULL,NULL);
	}
}
else
{
	deliver_response(400,"Invalid request",NULL,NULL,NULL,NULL,NULL);
	
}
function deliver_response($status,$status_msg,$comid,$comname,$cli_id,$website,$city)
{
	header("HTTP/1.1 $status $status_msg");
	
	$response=array();
	$response['status']=$status;
	$response['status_msg']=$status_msg;
	$response['compid']=$comid;
	$response['compname']=$comname;
	$response['clientid']=$cli_id;
	$response['website']=$website;
	$response['tarcity']=$city;
	
	echo "\n";
	$json_response=json_encode($response);
	echo $json_response;
}
?>