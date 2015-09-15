<?php
	require_once('webbshop-php.php');

	session_start();
	$db = $_SESSION['db'];
	$id = $_SESSION['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
	$db->openConnection();
	$products = $db->getProducts();
  $login = $db->userLogin($username, $password);
  if($login == true) {
    $_SESSION['user_logged_in'] = $username;
  } else {
    $_SESSION['user_logged_in'] = null;
  }
	$db->closeConnection();
?>


<html>

<head>
<title>HYCO</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

});</script>


</head>

<body>
<h1>HYCOs Webbshop</h1>
<div class = "login">
<div class="ar login_popup">
    <a class="button" href="#" ><b>Login</b></a>
    <b>Shopping Cart (1)</b>

</div>
<div  class = "middle">
<?php
	for ($i = 1; $i <= count($products); $i++) {
  echo $products[$i]["name"];
  echo $products[$i]["articleID"];
  echo $products[$i]["price"];
  echo $products[$i]["quantity"];

    }

?>





</div>

</body>


</html>
