//Glöm inte att ändra document root i httpd-ssl.conf
<?php

class Database {
	private $host;
	private $username;
	private $password;
	private $database;
	private $port;
	private $conn;

	public function __construct($host, $username, $password, $database, $port) {
		$this->host = $host;
		$this->userName = $username;
		$this->password = $password;
		$this->database = $database;
		$this->port = $port;

	}

	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database",
					"root",  "root");


			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection ERROR: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}

	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	public function isConnected() {
		return isset($this->conn);
	}

	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "ERROR: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}

	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
		} catch (PDOException $e) {
			$error = "ERROR: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $stmt->rowCount();
	}

	public function userCheck($username, $ip) {
		$sql = "select session from users where email = ?";
		$result = $this->executeQuery($sql, array($username));
		if(hash('sha256', $username . $ip) == $result[0]['session']) {
			return true;
		}
		return false;
	}

	public function userLogin($username, $password) {
		$sql = "select email, failedLogins, password, salt from users where email = ?";
		$result = $this->executeQuery($sql, array($username));
		$ip = $_SERVER['REMOTE_ADDR'];
		if( $result[0]["failedLogins"] >= 100 || $result[0]['email'] == null) {
			return false;
		} else {
			$hashed = hash('sha256', $password . $result[0]["salt"]);
			$sql3 = "insert into LoginAttempts values(?, ?, ?, ?, ?)";

			$hostname = gethostbyaddr($ip);
			if($hashed == $result[0]["password"]) {
				$sql5 = "update users set session = ? where email = ?";
				$session = hash('sha256', $username . $ip);
				$result5 = $this->executeupdate($sql5, array($session, $username));
				$time = date('Y-m-d G:i:s');
				$result3 = $this->executeUpdate($sql3, array(0,$username,$time,$hostname,true));
				return true;
			} else {
				$sql2 = "update users set failedLogins = failedLogins + 1 where email = ?";
				$result2 = $this->executeUpdate($sql2, array($username));

				$result4 = $this->executeUpdate($sql3, array(0,$username,$time,$hostname,false));


				return false;
			}

		}
	}

	public function userLogout($username) {
		$sql =  "update users set session = null where email = ?";
		$result =  $this->executeUpdate($sql, array($username));
		if($result == null) {
			return false;
		}
		return true;

	}

	public function signUp($username, $password, $firstname, $lastname, $address) {
			//$salt = '123';
		$salt =  sha1(time());
		$saltedpassword = hash('sha256', $password . $salt);
		$sql = "insert into users values (?, ?, ?, ?, ?, ?, ?,?)";
		try {
			$result = $this->executeUpdate($sql, array($firstname, $lastname, $address, $username, $saltedpassword, $salt, 0, null));
		}	catch(PDOException $e) {
				return false;
		}
		return true;
	}
// Create connection

	public function getProducts() {
		$sql = "select name, articleID, price, quantity from Products";
		$result = $this->executeQuery($sql, null);
		$r = [];
		for($i = 0; $i < count($result); $i++) {
			$a = [];
			array_push($a, $result[$i]["name"]);
			array_push($a, $result[$i]["articleID"]);
			array_push($a, $result[$i]["price"]);
			array_push($a, $result[$i]["quantity"]);
			array_push($r, $a);
		}
		return $r;
	}

	public function getCartItems($items) {
		$sql = "select name, articleID, price from Products where articleID = ?";
		$r = [];
		for($i = 0; $i < count($items); $i++) {
			$result = $this->executeQuery($sql, array($items[$i]));
			$a = [];
			array_push($a, $result[0]["name"]);
			array_push($a, $result[0]["articleID"]);
			array_push($a, $result[0]["price"]);
			array_push($r, $a);
		}
		return $r;
	}

	public function getPosts() {
		$sql = "select email, postText, time from Posts";
		$result = $this->executeQuery($sql, null);
		$r = [];
		for($i = 0; $i < count($result); $i++) {
			$a = [];
			array_push($a, $result[$i]["email"]);
			array_push($a, $result[$i]["postText"]);
			array_push($a, $result[$i]["time"]);
			array_push($r, $a);
		}
		return $r;
	}

	public function postPost($email, $postText) {
		$sql = "insert into Posts values (?,?,?)";
		$time = date('Y-m-d G:i:s');
		try {
			$result =  $this->executeUpdate($sql, array($email, $postText, $time));
		} catch(PDOException $e) {
			return false;
		}
		return $result;

	}
}

?>
