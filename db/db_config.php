<?php
// Database configuration
$servername = "localhost";
$username = "root";       // Default username for XAMPP
$password = "Hitler123@kalyana";           // Default password for XAMPP (usually empty)
$dbname = "interior_design";  // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

