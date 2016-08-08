<?php
	session_start();
	if(isset($_SESSION['valid_user'])){
		echo 'you are already logged in as: '.$_SESSION['valid_user'].' <br />';
		echo 'Redirecting to home page please wait';
		header("Refresh:3 ; url=leads.php");
		}else{
			if(!isset($_POST['submit'])){
	// Visitor need to enter the username and password
?>

<!DOCTYPE html>
<html>
	<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css1.css" >
	
	</head>
	<body>
	
		<form class="login" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<fieldset>
		<legend>Login</legend>
		<div id="content">
		<div class="label">
		<label>Username:</label><br/>
		<label>Password:</label>
		</div>
		<div class="input">
		<input type="text" placeholder="Enter Username" id="input1" name="user" required>
		<input type="password" placeholder="Enter password" id="input1" name="pass" required>
		</div>
		<button type="button" name="Back" class="button" id="back"><a href="index.php" style="text-decoration:none" >Back</a></button>
		<button type="submit" name="submit" class="button">Login</a></button>
		</div>
		</fieldset>
		</form>
	</body>
</html>

<?php 
	}else{
		//connect to mysql
		$con= mysqli_connect("localhost","root","","test");
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$url="http://localhost/zap/loginapi.php?username=".$user."&password=".$pass;
		$client=curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	$response=curl_exec($client);
	$result=json_decode($response);
	$result = json_decode(json_encode($result), true);
	$count=$result['num'];
	echo $response;
		if($count == 1){
				echo "Login successful";
				$_SESSION['valid_user'] = $result['user'];
				echo '<br/>';
				echo "Redirecting to home page please wait";
				header("Refresh:2 ; url=leads.php");
			}else{
			echo "You are not an authorized user";
					header("Refresh:2 ; url=login.php");
				}
	}
}
?>