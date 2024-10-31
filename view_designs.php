<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Designs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Design List</h2>
    <?php
    include 'db/db_config.php'; 
    $conn = new mysqli("localhost", "root", "", "interior_design");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM designs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Design Name</th><th>Category</th><th>Cost</th><th>Image</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["design_name"] . "</td>
                    <td>" . $row["category"] . "</td>
                    <td>" . $row["cost"] . "</td>
                    <td><img src='" . $row["image_path"] . "' alt='Design Image' style='width:100px; height:auto;'></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No designs found.";
    }

    $conn->close();
    ?>
</body>
</html>
