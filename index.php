<?php
    require_once('webbshop-php.php');
    require_once('db_login_info.php');
    
    $db = new Database($host, $username, $password, $dbname);
    $db->openConnection();
    if (!$db->isConnected()) {
        header("Location: cannotConnect.html");
        exit();
    }

    //$id = $_SESSION['id'];
    $username_login = $_POST['username'];
    $password_login = $_POST['password'];
    //$products = $db->getProducts();
    $db->closeConnection();
    $login = $db->userLogin($username_login, $password_login);
    session_start();
    
    if($login == true) {
        $_SESSION['user_logged_in'] = $username_login;
    } else {
        $_SESSION['user_logged_in'] = null;
    }
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
