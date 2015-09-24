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
$db->signUp($email, $password, $firstname, $lastname, $address);
$db->closeConnection();
header("Location: index.php");
die();
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



</body>


</html>
