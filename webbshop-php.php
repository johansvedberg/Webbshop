<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webshopDB";


	public function __construct($servername, $username, $password, $dbname) {
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
	}

	public function openConnection() {

		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
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
		$sql = "select failedLogins, password, salt from users where username = ?";
		$result = $this->executeQuery($sql, array($username));
		if( $result[0]["failedLogins"] >= 3) {
			return false;
		} else {
			$hashed = hash('sha256', $password . $result[0]["salt"]);
			if($hashed == $result[0]["password"]) {
				return true;
			} else {
				$sql2 = "update users set failedLogins = failedLogins + 1 where username = ?";
				$result2 = $this->executeUpdate($sql2, array($username));
				return false;
			}

		}
	}

	public function signUp($username, $password, $firstname, $lastname, $address) {
		$salt =  sha1(time());
		$sql = "insert into users values (?, ?, ?, ?, ?)";
		$result = $this->executeQuery($sql, array()
	}
// Create connection


// Check connection


// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (firstName, lastName, address, password, email, salt) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $address, $password, $email, $salt);


// set parameters and execute

$firstname = "";
$lastname = "";
$address = "";
$password = "";
$email = "":
$salt = "";
