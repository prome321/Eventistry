<?php
header('Content-Type: application/json');
require_once '../config.php'; 

$eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($eventId <= 0) {
    echo json_encode(['status' => 400, 'message' => 'Invalid Event ID']);
    exit;
}

$sql = "SELECT * FROM events WHERE id = $eventId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
    echo json_encode(['status' => 200, 'data' => $event]);
} else {
    echo json_encode(['status' => 404, 'message' => 'Event not found']);
}

$conn->close();
?>
