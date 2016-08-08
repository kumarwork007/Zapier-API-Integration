<?php

if(!empty($_GET['leadid']))
{
	
	header("Content-type:application/json");
	$lid=$_GET['leadid'];
	$conn=mysqli_connect('localhost','root','','technoch_aritra');
	$query="select * from sp_lead_generate where id='$lid'";
	$runq=mysqli_query($conn,$query);
	$num=mysqli_num_rows($runq);
	if($num>0)
	{	
	$rows=mysqli_fetch_array($runq);
	$lgi = $rows['lead_group_id'];
	$ci = $rows['content_id'];
	$lci = $rows['client_id'];
	$lcn = $rows['lead_contact_no'];
	$ld = $rows['lead_date'];
	deliver_response(200,"Lead Data here",$lid,$lgi,$ci,$lci,$lcn,$ld);
	}
	else
	{
	deliver_response(200,"No Lead Data",NULL,NULL,NULL,NULL,NULL,NULL);
	}
}
else
{
	$conn=mysqli_connect('localhost','root','','technoch_aritra');
	$query="select * from sp_lead_generate";
	$runq=mysqli_query($conn,$query);
	while ($rows=mysqli_fetch_array($runq))
	{
	$lid=$rows['id'];
	$lgi = $rows['lead_group_id'];
	$ci = $rows['content_id'];
	$lci = $rows['client_id'];
	$lcn = $rows['lead_contact_no'];
	$ld = $rows['lead_date'];
	deliver_response(200,"Lead Data here",$lid,$lgi,$ci,$lci,$lcn,$ld);
	}
}
function deliver_response($status,$status_msg,$id,$grpid,$con_id,$cli_id,$contact,$date)
{
	header("HTTP/1.1 $status $status_msg");
	
	$response=array();
	$response['status']=$status;
	$response['status_msg']=$status_msg;
	$response['id']=$id;
	$response['grpid']=$grpid;
	$response['content']=$con_id;
	$response['client']=$cli_id;
	$response['contact']=$contact;
	$response['date']=$date;
	
	echo "\n";
	$json_response=json_encode($response);
	echo $json_response;
}
?>