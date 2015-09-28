<?php 
session_start();

array_push($_SESSION['cart'], $_POST['item_to_cart']);

<html>

<head>
<title>HYCO</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".button").click(function(e) {
        $("body").append('');
        $(".popup").show();
        $(".close").click(function(e) {
        $(".popup, .overlay").hide();
        });
    });
});</script>


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
    $cartitems = $_SESSION['db']->getCartItems($_SESSION['cart']);
	for ($i = 1; $i < sizeof($_SESSION['cart']); $i++) {
        echo "Name: " .$products[$i][0];
        echo "/t";
        echo "ArticleID: " .$products[$i][1];
        echo "/t";
        echo "Price: " .$products[$i][2];
        echo "<br>";

  }


?>





</div>

</body>


</html>
