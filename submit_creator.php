<?php
$servername = "localhost";
$username = "root";
$password = "Hitler123@kalyana";
$dbname = "interior_design"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $experience_years = $_POST['experience_years'];

    $stmt = $conn->prepare("INSERT INTO creators (name, specialty, experience_years) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $specialty, $experience_years);

    if ($stmt->execute()) {
        echo "Creator added successfully!";
        header("Location: admin.html"); // Redirect back to admin page after success
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
