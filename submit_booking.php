<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Hitler123@kalyana";
$dbname = "interior_design";

// Ensure client is logged in
if (!isset($_SESSION['client_id'])) {
    die("Client not logged in");
}

$client_id = $_SESSION['client_id']; // Retrieve client_id from session

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $due_date = $_POST['due_date'];
    $service_type = $_POST['service_type'];
    $design_id = $_POST['design_id']; // Get design_id from form input

    // Prepare SQL query to insert booking
    $stmt = $conn->prepare("INSERT INTO bookings (client_id, due_date, service_type, design_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $client_id, $due_date, $service_type, $design_id);

    if ($stmt->execute()) {
        echo "Booking successful!";
        header("Location: booking.html?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
