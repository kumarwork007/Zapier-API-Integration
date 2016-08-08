<!DOCTYPE html>
<html lang="en">
<head>
<style>
.bml{
text-align:center;
margin-left:20%;
margin-right:20%;
margin-top:5%;
padding-top:20px;
padding-bottom:130px;
height:350px;
}
table
{
width:75%;
margin-left:100px;
}
table td,th
{
padding:10px;
text-align:left;
}
table,table th,table td
{
border:1px solid black;
border-collapse:collapse;
}
table th{
background-color:#337ab7;
border:1px solid black;
	color:white;
height:40px;
	}

</style>
  <title>Contact Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron">
  <h1 style="text-align:center;">Business Automation</h1> 
  <p style="text-align:center;">Manage contacts here!</p> 
</div>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Contact Management</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      </ul>
	 <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Login</a></li>
      <li><a href="#">Register</a></li>
      <li><a href="#">About Us</a></li>
    </ul>
  </div>
</nav>
<div class="bml">
<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "technoch_aritra";
$con = mysqli_connect($host,$user,$pass,$database);
if(mysqli_connect_errno($con)){
	die("failed to connect to database");
}
$query = mysqli_query($con,"select * from sp_contact");
?>
<table class="table">
	<tr>
		<th>ID</th>
		<th>CLIENT ID</th>
		<th>FIRST NAME</th>
		<th>LAST NAME</th>
		<th>EMAIL</th>		
		<th>DESIGNATION</th>		
	</tr>

	<?php
	   while ($row = mysqli_fetch_array($query)) {
	?>
		  <tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['client_id']; ?></td>
		<td><?php echo $row['first_name']; ?></td>
		<td><?php echo $row['last_name']; ?></td>
		<td><?php echo $row['email_id']; ?></td>
		<td><?php echo $row['designation']; ?></td>
	   
		</tr>
	<?php
	   }
	 ?>
</table>
<br /><br />
<h3>Select Client to Proceed</h3>	
<form name="f1" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<?php
$query = mysqli_query($con,"select * from sp_contact");
echo "<select class='input-sm' name='Contact'>"; 
while ($row = mysqli_fetch_array($query)) {
	echo "<option value=\"".$row['id']."\">".$row['first_name']."</option>";
	}
echo "</select>";
?>
<br /><br />
<input class="btn btn-primary" type="submit" name="submit" value="Manage">
</div>
</form>
</div>
</body>

<div class="bml">
<?php
if(isset($_POST['submit']))
{
	$id=$_POST['Contact'];
	$url="http://localhost/zap/cust.php?clientid=$id";
	$client=curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	$response=curl_exec($client);
	$result=json_decode($response);
	$result = json_decode(json_encode($result), true);
	echo $response;
	echo "<br>";
	echo "<p>";
	echo "ID : ".$result['id']."<br>";
	echo "CLIENT ID : ".$result['cliid']."<br>";
	echo "FIRST NAME : ".$result['fname']."<br>";
	echo "LAST NAME: ".$result['lname']."<br>";
	echo "EMAIL: ".$result['email']."<br>";
	echo "DESIGNATION: ".$result['dsgn']."<br>";
	echo "</p>";
}
?>
</div>
</html>