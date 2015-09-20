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


	public function userLogin($username, $password) {
		$sql = "select failedLogins, password, salt from users where email = ?";
		$result = $this->executeQuery($sql, array($username));
		if( $result[0]["failedLogins"] >= 3) {
			return false;
		} else {
			$hashed = hash('sha256', $password . $result[0]["salt"]);
			if($hashed == $result[0]["password"]) {
				return true;
			} else {
				$sql2 = "update users set failedLogins = failedLogins + 1 where email = ?";
				$result2 = $this->executeUpdate($sql2, array($username));
				return false;
			}

		}
	}

	public function signUp($username, $password, $firstname, $lastname, $address) {
		$salt =  sha1(time());
		$sql = "insert into users values (?, ?, ?, ?, ?, ?, 0)";
		try {
			$result = $this->executeUpdate($sql, array($firstname, $lastname, $address, $username, $password, $salt));
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
}

?>