<?php
include 'db_connect.php';

// Check if the ID to delete is provided
if (isset($_POST['id'])) {
    $schedule_id = $_POST['id'];

    // Prepare the SQL DELETE statement
    $stmt = $conn->prepare("DELETE FROM `schedule_list` WHERE `id` = ?");
    $stmt->bind_param("i", $schedule_id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Redirect to the calendar page upon successful deletion
        header("Location: calendar.php");
        exit(); // Ensure the script stops executing after redirection
    } else {
        // If not successful, return an error response
        echo "Failed to delete schedule. Please try again.";
    }

    // Close the statement
    $stmt->close();
} else {
    // If ID is not provided, return an error response
    echo "No schedule ID provided.";
}

// Close the database connection
$conn->close();
?>
