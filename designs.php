<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "interior_design");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch designs from the database
$sql = "SELECT id, design_id, cost, image_path FROM designs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designs</title>
    <style>
        /* Your CSS styling here */
    </style>
</head>
<body>
    <h1>Designs Gallery</h1>
    <div class="design-container">
        <?php
        // Check if there are any designs in the database
        if ($result->num_rows > 0) {
            // Output data for each design
            while ($row = $result->fetch_assoc()) {
                echo '<div class="design-card">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Design Image">';
                echo '<div class="design-info">';
                echo '<div class="design-id">Design ID: ' . htmlspecialchars($row['design_id']) . '</div>';
                echo '<div class="design-cost">$' . htmlspecialchars($row['cost']) . '</div>';
                echo '<a href="booking.html?design_id=' . htmlspecialchars($row['design_id']) . '" class="view-details">View Details</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No designs available at the moment.</p>';
        }
        ?>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
