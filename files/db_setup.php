<?php
$servername = "localhost";
$username = "szhang85";
$password = "kBMB7AtR";
$db = "szhang85_1";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else echo "Connected successfully";

?>