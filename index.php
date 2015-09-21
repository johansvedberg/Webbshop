<?php
    require_once('webbshop-php.php');

    $db = new Database("localhost", "host", "host", "webbshopDB", "3306");
    $db->openConnection();
    if (!$db->isConnected()) {
        header("Location: cannotConnect.html");
        exit();
    }

    //$id = $_SESSION['id'];
    $username_login = $_POST['username'];
    $loginhej;
    $password_login = $_POST['password'];
    $products = $db->getProducts();
    $login = $db->userLogin($username_login, $password_login);
    session_start();
    if($login == true) {
        $_SESSION['user_logged_in'] = $username_login;
        $loggedin = "Inloggad";
    } else {
        $_SESSION['user_logged_in'] = null;
        $loggedin = "Ej inloggad";
    }
    $db->closeConnection();
    $_SESSION['db'] = $db;
?>


<html>

<head>
<title>HYCO</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>

<body>
<h1>HYCOs Webbshop</h1>
<div class = "login">
<div class="ar login_popup">
    <a class="button" href="login.html" ><b>Login</b></a>
    <a class="button" href="signup.html" ><b>Sign Up</b></a>
    <b>Shopping Cart (1)</b>
</div>
</div>
<div  class = "middle">
<?php
 echo $loggedin;
 echo "<br>";

 echo "<br>";
	for ($i = 0; $i < count($products); $i++) {

  echo "Name: " .$products[$i][0];
  echo "<br>";
  echo "ArticleID: " .$products[$i][1];
  echo "<br>";
  echo "Price: " .$products[$i][2];
  echo "<br>";
  echo "Quantity: " .$products[$i][3];
  echo "<br>";
  echo "<br>";

    }

?>
</div>

<div class = "shopping">
  <?php
  echo $_SESSION['user_logged_in'];
   ?>

</div>



</body>


</html>
