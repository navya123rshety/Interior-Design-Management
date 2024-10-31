<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Clients</title>
    <link rel="stylesheet" href="styles.css">
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
    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table with headers
        echo "<table><tr><th>Name</th><th>Contact</th><th>Email</th><th>Address</th></tr>";
        
        // Loop through and display each client's details
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["contact"]) . "</td><td>" . htmlspecialchars($row["email"]) . "</td><td>" . htmlspecialchars($row["address"]) . "</td></tr>";
        }
        
        echo "</table>";
    } else {
        echo "No clients found.";
    }

    $conn->close();
    ?>
</body>
</html>
