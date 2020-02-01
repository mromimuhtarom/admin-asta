<?php
$servername = "192.168.1.7:3308";
$username = "root";
$password = "aa123123";
$dbname = "asta_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>