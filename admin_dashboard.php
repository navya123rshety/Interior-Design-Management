<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>

    <h3>Client Bookings</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Due Date</th>
            <th>Service Type</th>
            <th>Color Scheme</th>
            <th>Booking Date</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "Hitler123@kalyana", "interior_design");
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $bookingQuery = "SELECT * FROM bookings ORDER BY created_at DESC";
        $result = $conn->query($bookingQuery);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["due_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["service_type"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["color_scheme"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No bookings found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
