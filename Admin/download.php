<?php
require '../config.php';

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';

if ($event_id) {
    // Fetch event name for filename
    $eventQuery = "SELECT event_name FROM events WHERE id = ?";
    $stmtEvent = $conn->prepare($eventQuery);
    $stmtEvent->bind_param("i", $event_id);
    $stmtEvent->execute();
    $eventResult = $stmtEvent->get_result();
    $eventRow = $eventResult->fetch_assoc();
    $event_name = $eventRow['event_name'] ?? 'Unknown_Event';

    // Fetch attendees for the selected event_id
    $sql = "SELECT reservation_id, fullname, email, phone, address, ticket_type FROM reservations WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=attendees_' . str_replace(' ', '_', $event_name) . '.csv');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Column headers
    fputcsv($output, ['ReservationID', 'FullName', 'Email', 'Phone', 'Address', 'Ticket Type']);

    // Fetch and write data rows
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
} else {
    echo "Please select an event.";
}

$conn->close();
?>
