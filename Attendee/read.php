<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

include('function.php'); // Include your database connection or functions file

// Get query parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';

// Validate page number
if ($page < 1) {
    $page = 1;
}

// Set the number of events per page
$events_per_page = 4;
$offset = ($page - 1) * $events_per_page;

// Sort logic
$order_by = 'event_name'; // Default sorting by event name
if ($sort === 'date_asc') {
    $order_by = 'event_date ASC';
} elseif ($sort === 'date_desc') {
    $order_by = 'event_date DESC';
} elseif ($sort === 'name_asc') {
    $order_by = 'event_name ASC';
} elseif ($sort === 'name_desc') {
    $order_by = 'event_name DESC';
}

// Base SQL query
$sql = "SELECT * FROM events WHERE 1=1";

// Add search filter
if (!empty($search)) {
    $sql .= " AND event_name LIKE '%$search%'";
}

// Add date filter
if (!empty($date)) {
    $sql .= " AND event_date = '$date'";
}

// Add time filter
if (!empty($time)) {
    $sql .= " AND event_time = '$time'";
}


$sql .= " ORDER BY $order_by LIMIT $events_per_page OFFSET $offset";


$result = $conn->query($sql);


$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}


$sql_total = "SELECT COUNT(*) AS total FROM events WHERE 1=1";
if (!empty($search)) {
    $sql_total .= " AND event_name LIKE '%$search%'";
}
if (!empty($date)) {
    $sql_total .= " AND event_date = '$date'";
}
if (!empty($time)) {
    $sql_total .= " AND event_time = '$time'";
}
$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_events = $row_total['total'];


$total_pages = ceil($total_events / $events_per_page);


echo json_encode([
    'status' => 200,
    'data' => $events,
    'total_pages' => $total_pages
]);
?>