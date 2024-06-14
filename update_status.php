<?php
// Include your database connection file if it's not already included
include('inc/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if leave ID and status are set in the POST data
    if (isset($_POST['leave_id']) && isset($_POST['status'])) {
        // Sanitize the input
        $leave_id = mysqli_real_escape_string($con, $_POST['leave_id']);
        $status = mysqli_real_escape_string($con, $_POST['status']);

        // Update the status in the database
        $sql = "UPDATE leaves SET status = '$status' WHERE id = '$leave_id'";
        if (mysqli_query($con, $sql)) {
            // Status updated successfully
            // Redirect back to the previous page
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        } else {
            // Error updating status
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        // Invalid request
        echo "Invalid request.";
    }
} else {
    // Redirect if accessed directly
    header("Location: index.php");
    exit;
}
?>
