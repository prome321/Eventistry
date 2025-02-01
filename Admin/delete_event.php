<?php
session_start();
require '../config.php'; // Include your database configuration

// Check if 'id' is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the event ID to prevent SQL injection
    $event_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to delete the event from the database
    $query = "DELETE FROM events WHERE id = '$event_id'";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        // Redirect to the event list page after successful deletion
        $_SESSION['message'] = "Event deleted successfully.";
        header('Location: index.php');
        exit();
    } else {
        // Handle errors if the deletion failed
        $_SESSION['message'] = "Error deleting event: " . $conn->error;
        header('Location: index.php');
        exit();
    }
} else {
    // If no 'id' is passed, redirect with an error message
    $_SESSION['message'] = "Invalid event ID.";
    header('Location: index.php');
    exit();
}

// Close the database connection
$conn->close();
?>
