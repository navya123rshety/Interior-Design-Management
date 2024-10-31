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
    $due_date = $_POST['due_date'];
    $service_type = $_POST['service_type'];
    $color_scheme = $_POST['color_scheme'];
    $client_id = 4; // Temporarily set to an existing client_id

    $stmt = $conn->prepare("INSERT INTO bookings (client_id, due_date, service_type, color_scheme) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $client_id, $due_date, $service_type, $color_scheme);

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
