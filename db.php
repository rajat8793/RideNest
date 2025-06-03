<?php
if (!class_exists('mysqli')) {
    die("Error: The MySQLi extension is not enabled in your PHP environment. Please enable it in your php.ini file.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_system";

// Create connection using procedural style as fallback
$conn = @new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: Unable to connect to database. Please check your database settings.");
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
