<?php
include 'db/db_config.php';

// Check if form data is set
if (isset($_POST['creator_name']) && isset($_POST['specialization']) && isset($_POST['experience'])) {
    $creator_name = $_POST['creator_name'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];

    // Insert query
    $sql = "INSERT INTO creators (creator_name, specialization, experience) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $creator_name, $specialization, $experience);

        if ($stmt->execute()) {
            echo "Creator details saved successfully.";
        } else {
            echo "Error saving creator details: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Please fill in all fields.";
}

