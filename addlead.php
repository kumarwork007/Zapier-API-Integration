<?php
	session_start();
	if(isset($_SESSION['valid_user'])){
		echo 'you are already logged in as: '.$_SESSION['valid_user'].' <br />';
		echo 'Redirecting to home page please wait';
		header("Refresh:3 ; url=addlead.php");
		}else{
			if(!isset($_POST['submit'])){
	// Visitor need to enter the username and password
?>

<!DOCTYPE html>
<html>
	<head>
	<title>Lead Creation</title>
	<link rel="stylesheet" type="text/css" href="css1.css" >
	
	</head>
	<body>
	
		<form class="login" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<fieldset>
		<legend>Create Lead</legend>
		<div id="content">
		<div class="label">
		<label>Lead Group ID:</label><br/>
		<label>Client ID:</label>
		<label>Client Company:</label>
		<label>Engage ID:</label>
		<label>Engage URL:</label>	
		<label>Lead Date:</label>	
		
		</div>
		<div class="input">
		<input type="text"  id="input1" name="lgid" required>
		<input type="text"  id="input1" name="cliid" required>
		<input type="text"  id="input1" name="clicom" required>
		<input type="text"  id="input1" name="engid" required>
		<input type="text"  id="input1" name="engurl" required>
		<input type="date"  id="input1" name="ldate" required>
		</div>
		<button type="button" name="Back" class="button" id="back"><a href="leads.php" style="text-decoration:none" >View all leads</a></button>
		<button type="submit" name="submit" class="button">Create</a></button>
		</div>
		</fieldset>
		</form>
	</body>
</html>

<?php 
	}else{
		//connect to mysql
		$con= mysqli_connect("localhost","technoch_aritra",'lBOT}O)$x&=V',"technoch_aritra");
		$f1 = $_POST['lgid'];
		$f2 = $_POST['cliid'];
		$f3 = $_POST['clicom'];
		$f4 = $_POST['engid'];
		$f5 = $_POST['engurl'];
		$f6 = $_POST['ldate'];
		$query="INSERT INTO `technoch_aritra`.`sp_lead_generate` (`id`, `lead_group_id`, `content_id`, `client_id`, `client_comp`, `lead_request`, `lead_contact_no`, `request_comp`, `city`, `category`, `vertical`, `get_remark`, `doe`, `dou`, `ip_address`, `engage_form_id`, `engage_form_url`, `source`, `lead_date`, `valid`, `deleted`) VALUES (NULL, '$f1', '0', '$f2', '$f3', '1', '1', '1', '1', '', '', '', '2016-06-27 13:03:31', '2016-06-29 13:03:34', '1', '$f4', '$f5', '1', '$f6', '1', '0');";		
		$runq=mysqli_query($con,$query);
		echo "Successful";
		
	}
}
?>