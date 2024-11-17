<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Clients</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #9DACFF;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-top: 30px;
        }

        /* Table Styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: color: #003366;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Section Styles */
        .section {
            margin-top: 30px;
        }

        /* Button Styles */
        button {
            padding: 8px 16px;
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* No Data Found Message */
        .no-data {
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                width: 70%;
                height:40%;
                padding: 15px;
            }
            .user-icon {
                width: 60px;
                height: 60px;
            }
            h2 {
                font-size: 20px;
            }
            .input-group input {
                font-size: 13px;
                padding: 8px;
            }
            .submit-button {
                width: 100%;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 95%;
            }
            h2 {
                font-size: 18px;
            }
            .input-group input {
                font-size: 12px;
                padding: 6px;
            }
            .submit-button {
                width: 100%;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <h2>Client List</h2>
    <?php
    include 'db/db_config.php';

    // Create connection
    $conn = new mysqli("localhost", "root", "Hitler123@kalyana", "interior_design");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select all clients
    $client_sql = "SELECT * FROM clients";
    $client_result = $conn->query($client_sql);

    if ($client_result->num_rows > 0) {
        // Display table with client details
        echo "<table><tr><th>Client ID</th><th>Name</th><th>Contact</th><th>Email</th><th>Address</th></tr>";
        
        while ($row = $client_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p class='no-data'>No clients found.</p>";
    }

    // Query to select all bookings
    echo "<div class='section'>";
    echo "<h2>Booking Details</h2>";

    $booking_sql = "SELECT * FROM bookings";
    $booking_result = $conn->query($booking_sql);

    if ($booking_result->num_rows > 0) {
        // Display table with booking details
        echo "<table><tr><th>Booking ID</th><th>Client ID</th><th>Due Date</th><th>Service Type</th><th>Design Id</th><th>Created At</th><th>Action</th></tr>";
        
        while ($booking = $booking_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($booking["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($booking["client_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($booking["due_date"]) . "</td>";
            echo "<td>" . htmlspecialchars($booking["service_type"]) . "</td>";
            echo "<td>" . htmlspecialchars($booking["design_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($booking["created_at"]) . "</td>";
            echo "<td>
                    <form method='POST' action='delete_booking.php' style='display:inline;'>
                        <input type='hidden' name='booking_id' value='" . htmlspecialchars($booking["id"]) . "'>
                        <button type='submit'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='no-data'>No bookings found.</p>";
    }

    echo "</div>";

    $conn->close();
    ?>
</body>
</html>
