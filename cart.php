<?php 
require_once('webbshop-php.php');
session_start();
$cart = $_SESSION['cart'];
if($_POST['item_to_cart'] != null) {
   array_push($cart, $_POST['item_to_cart']); 
}
$db = $_SESSION['db'];
$db->openConnection();
$cartitems = $db->getCartItems($cart);
$db->closeConnection();
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
    <a class="button" href="#" ><b>Login</b></a>
    <b>Shopping Cart (1)</b>
    
</div>

</div>
<div  class = "middle">
<?php
    echo $_POST['item_to_cart'];
    echo sizeof($cart);
	for ($i = 0; $i < sizeof($cart); $i++) {
        echo "<p>";
        echo "Name: " .$cartitems[$i][0];
        echo "    ArticleID: " .$cartitems[$i][1];
        echo "    Price: " .$cartitems[$i][2];
        echo "<br>";
        echo "</p>";
  }


?>





</div>

</body>


</html>
