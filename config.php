<?php
// Database configuration
$servername = "localhost"; // or your database server IP address
$username = "root"; // MySQL username
$password = ""; // MySQL password (if any)
$dbname = "resume_builder"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
