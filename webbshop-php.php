<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webshopDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
