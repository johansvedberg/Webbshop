<?php
	require_once('webbshop-php.php');
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();	
	$db->userLogout($_SESSION['user_logged_in']);
	$_SESSION['user_logged_in'] = null;
	$db->closeConnection();
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

        <p>You are logged out!</p>
       

</body>


</html>
