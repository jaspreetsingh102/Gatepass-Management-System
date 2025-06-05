<?php
$servername = "localhost";  // Change if needed
$username = "root";         // MySQL username (default: root)
$password = "";             // MySQL password (default: empty)
$database = "gatepass";  // Your main database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>