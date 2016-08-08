<?php

if(!empty($_GET['username'])&&!empty($_GET['password']))
{
	
	header("Content-type:application/json");
	$un=$_GET['username'];
	$pwd=$_GET['password'];
	$conn=mysqli_connect('localhost','root','','technoch_aritra');
	$query="select * from users where username='$un' and password='$pwd'";
	$runq=mysqli_query($conn,$query);
	$num=mysqli_num_rows($runq);
	if($num==1)
	{	
	$rows=mysqli_fetch_array($runq);
	$un = $rows['username'];
	$pwd = $rows['password'];
	deliver_response(200,"User Data here",$un,$pwd,$num);
	}
	else
	{
	deliver_response(200,"No Lead Data",NULL,NULL,NULL);
	}
}else if(empty($_GET['username'])&&empty($_GET['password']))

{
	$conn=mysqli_connect('localhost','root','','technoch_aritra');
	
	$query="select * from users";
	$runq=mysqli_query($conn,$query) or die(mysqli_error());
	$num=mysqli_num_rows($runq);
	while($rows=mysqli_fetch_array($runq))
	{
	$un = $rows['username'];
	$pwd = $rows['password'];
	deliver_response(200,"User Data here",$un,$pwd,0);	
	}
	
}
function deliver_response($status,$status_msg,$un,$pd,$n)
{
	header("HTTP/1.1 $status $status_msg");
	
	$response=array();
	$response['status']=$status;
	$response['status_msg']=$status_msg;
	$response['user']=$un;
	$response['pass']=$pd;
	$response['num']=$n;
	echo "\n";
	$json_response=json_encode($response);
	echo $json_response;
}
?>