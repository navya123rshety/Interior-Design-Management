<?php
include 'db/db_config.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if booking_id is set
    if (isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];

        // Create a connection to the database
        $conn = new mysqli("localhost", "root", "Hitler123@kalyana", "interior_design");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to delete the booking by booking_id
        $delete_sql = "DELETE FROM bookings WHERE id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($delete_sql)) {
            // Bind the parameter
            $stmt->bind_param("i", $booking_id);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Redirect back to the client page after successful deletion
                header("Location: view_clients.php");
                exit();
            } else {
                echo "Error deleting booking.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement.";
        }

        $conn->close();
    }
}
?>
