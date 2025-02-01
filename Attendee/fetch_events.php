<?php
// fetch_events.php
require '../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');

header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

// Fetch events from the database
$sql = "SELECT id, event_name FROM events"; // Adjust your query based on your table structure
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all events as an associative array
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    // Return events as JSON
    echo json_encode(['status' => 200, 'data' => $events]);
} else {
    // Return an error if no events found
    echo json_encode(['status' => 404, 'message' => 'No events found']);
}
?>
