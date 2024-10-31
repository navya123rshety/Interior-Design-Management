<?php
// Start the session if needed
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "Hitler123@kalyana";
$dbname = "interior_design"; // Make sure this is your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO clients (name, email, contact, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $address);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Client entry successful!";
        header("Location: client.html?success=1"); // Redirect back to form with success
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
