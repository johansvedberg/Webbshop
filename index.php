<?php
    require_once('webbshop-php.php');
    session_start();

    
    if($_SESSION['db'] == null) {
        $db = new Database("localhost", "host", "host", "webbshopDB", "3306");
    } else {
        $db = $_SESSION['db'];
    }
    $db->openConnection();
    if (!$db->isConnected()) {
        header("Location: cannotConnect.html");
        exit();
    }

    if(1 == $_POST['login']) {
        $username_login = $_POST['username'];
        $loginhej;
        $password_login = $_POST['password'];
        $login = $db->userLogin($username_login, $password_login);

        if($login == true) {
            $_SESSION['user_logged_in'] = $username_login;
            $loggedin = "Inloggad";
        } else {
            $_SESSION['user_logged_in'] = null;
            $loggedin = "Ej inloggad";
        }
    }


    if(null == $_SESSION['user_logged_in']) {
        header("Location: login.html");
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
        if($db->userCheck($_SESSION['user_logged_in'], $ip) == false) {
            header("Location: login.html");
        }
    }

    if($_SESSION['cart'] == null) {
      $_SESSION['cart'] = array();
    }
    $products = $db->getProducts();
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






  <div class = "login"> <div class="ar login_popup">
  <?php if ($_SESSION['user_logged_in'] == null) {

    echo '<a class="button" href="login.html" ><b>Login</b></a>';
    echo '<a class="button" href="signup.html" ><b>Sign Up</b></a>';
  }else {
    echo "Welcome ";
    echo $_SESSION['user_logged_in'];
    echo "! ";

    echo "<b>Shopping Cart (1)</b>";
    echo "     ";
    echo '<a class="button" href="logout.php" ><b>Logout</b></a>';
  }

   ?>

  </div>

  </div>

<div  class = "middle">

<table  cellspacing="70"  ><tr>
<?php

	for ($i = 0; $i < count($products); $i++) {

        if ($i > 0 && ($i % 3 == 0)) {
            echo("</tr><tr>");
        }

  echo"<td>";

  echo $products[$i][0];
  echo "<br>";
  echo "ArticleID: " .$products[$i][1];
  echo "<br>";
  echo "Price: " .$products[$i][2];
  echo "<br>";
  echo "Quantity: " .$products[$i][3];
  echo "<br>";
  echo "<br>";

  echo "<form action='cart.php' method='post'>";
  echo "<button name='item_to_cart' value=".$products[$i][1]." type='submit'>Add to cart</button>";
  echo "</form>";



  echo "<br>";
  echo "</td>";

    }

?>

</tr></table>







</div>

<div class = "shopping">


</div>




</body>


</html>
