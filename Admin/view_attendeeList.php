<?php
session_start();
require '../config.php';  // Include your database configuration

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// SQL Query to fetch attendee details along with event name
$query = "SELECT r.*, e.event_name 
          FROM reservations r
          JOIN events e ON r.event_id = e.id";

if (!empty($search)) {
    $query .= " WHERE r.fullname LIKE '%$search%'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Attendee List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

  <section>
    <div class="container mt-3">
        <h2 class="mb-4">Attendee List</h2>

        <!-- Search Bar -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search attendee by name..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Attendee Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Ticket Type</th>
                    <th>Event Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <th scope='row'>{$counter}</th>
                                <td>{$row['fullname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['ticket_type']}</td>
                                <td>{$row['event_name']}</td>
                              </tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No Attendee found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
  </section>

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
