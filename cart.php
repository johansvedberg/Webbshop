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
    <div class="popup">
        <form>
            <P><span class="title">Username</span> <input name="" type="text" /></P>
            <P><span class="title">Password</span> <input name="" type="password" /></P>
            <P><input name="" type="button" value="Login" /></P>
        </form>
        <a href="#" class="close">Close</a>
    </div>
</div>

</div>
<div  class = "middle">
<?php
	for ($i = 1; $i <= count($pallets); $i++) {


  }


?>





</div>

</body>


</html>
