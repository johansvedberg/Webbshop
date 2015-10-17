<?php
	require_once('webbshop-php.php');
	session_start();


	$db = $_SESSION['db'];
	$db->openConnection();
	if($_POST['postText'] != null and $_SESSION['CSRFTokenBook'] == $_POST['CSRFTokenBook']) {
		$postText = htmlspecialchars($_POST['postText'], ENT_QUOTES, 'UTF-8');
		$db->postPost($_SESSION['user_logged_in'], $postText);
	}
	$_SESSION['CSRFTokenBook'] = hash('sha256', time());
	$posts = $db->getPosts();
	$db->closeConnection();
?>

<html>
	<head>
		<title>
			Guestbook
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	</head>

<body>
<a href="index.php" class="button">Back</a>

<h1>HYCOs Webbshop</h1>

<div  class = "middle">
<?php
	for ($i = 0; $i < count($posts); $i++) {
        echo "<p>";
        echo $posts[$i][0];
				echo "    (" .$posts[$i][2]. ")";
				echo "<br>";
				echo "<br>";
        echo $posts[$i][1];
        echo "<br>";
        echo "</p>";
  }

?>

<div style="clear: both">
	<form action="guestbook.php" method="post">
		<textarea name="postText" id="textarea" cols="30" rows="10"></textarea>
		<?php
			echo "<input type='hidden' value=". $_SESSION['CSRFTokenBook'] . " name='CSRFTokenBook'>";
		?>
		<input type="submit" name="button" id="button" value="Send" />
	</form>
</div>





</body>
</html>
