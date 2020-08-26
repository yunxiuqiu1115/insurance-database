<?php
$servername = "127.0.0.1";
$username = "yunxiuqiu1115";
$password = "19951115";
$db = "insurance_data";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else echo "Connected successfully";

?>