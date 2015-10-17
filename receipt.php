<?php
require_once('webbshop-php.php');
session_start();
if($_SESSION['CSRFTokenCart'] != $_POST['CSRFTokenCart']) {
    header("Location: cart.php");
    exit();
}
$cart = $_SESSION['cart'];

$db = $_SESSION['db'];
$db->openConnection();
$cartitems = $db->getCartItems($cart);
$db->closeConnection();
$_SESSION['cart'] = array();
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
    <a class="button" href="index.php" ><b>Back</b></a>
    <b>Shopping Cart (0)
    </b>

</div>

</div>
<div  class = "middle">
<?php
   $sum = 0;
    if(sizeof($cartitems) == 1) {
        echo "<h2> You have ordered ".sizeof($cartitems) . " item! </h2>" ;
    } else {
        echo "<h2> You have ordered ".sizeof($cartitems) . " items! </h2>" ;
    }


	for ($i = 0; $i < count($cartitems); $i++) {
        echo "<p>";
        echo "Name: " .$cartitems[$i][0];
        echo "    ArticleID: " .$cartitems[$i][1];
        echo "    Price: " .$cartitems[$i][2]. " kr";
        $sum += $cartitems[$i][2];
        echo "<br>";
        echo "</p>";
  }

  echo "<h2> Total amount: ".$sum . " kr </h2>";

?>
</div>


</body>


</html>
