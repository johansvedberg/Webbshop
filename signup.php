<?php
require_once('webbshop-php.php');
session_start();
$db = $_SESSION['db'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$address = $_REQUEST['address'];
$db->openConnection();
$signupOK = $db->signUp($email, $password, $firstname, $lastname, $address);
$db->closeConnection();
if($signupOK == true) {
	header("Location: index.php");
	die();
}


 ?>


<html>

<head>
<title>HYCO</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

</head>

<body>
<h1>HYCOs Webbshop</h1>
<div class = "login">
<div class="ar login_popup">
    <a class="button" href="index.php" ><b>Home</b></a>

</div>
</div>

<div id="middle">
	<?php
		if(strlen($password) < 8) {
			echo "<p>Your password was only ".strlen($password)." characters long. It needs to be at least 8 characters long</p>";
		} else {
			echo "<p>Something went wrong!</p>";
		}
		?>
		</div>


</body>


</html>
