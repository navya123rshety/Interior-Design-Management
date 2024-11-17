<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Hitler123@kalyana";
$dbname = "interior_design"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Prepare and execute the query to insert the client
    $stmt = $conn->prepare("INSERT INTO clients (name, email, contact, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $address);

    if ($stmt->execute()) {
        // Retrieve the inserted client_id
        $client_id = $conn->insert_id; // This gets the last inserted ID (the client's ID)

        // Store the client_id in the session
        $_SESSION['client_id'] = $client_id;

        echo "Client entry successful!";
        // Redirect to another page (e.g., client.html or dashboard)
        header("Location: client.html?success=1"); 
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
