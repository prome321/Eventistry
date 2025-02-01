<?php
session_start();
require '../config.php';  // Include your database configuration
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Event</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

  <section>
    <div class="container mt-5">
        <h2 class="mb-4">Events List</h2>

        <!-- Events Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Event Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Max Capacity</th>
                    <th>Organizer Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SQL Query to fetch event data
                $query = "SELECT * FROM events";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result->fetch_assoc()) {
                   
                        $imagePath = $row['event_image'];

                     
                        echo "<tr>
                                <th scope='row'>{$counter}</th>
                                <td>{$row['event_name']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['event_date']}</td>
                                <td>{$row['event_time']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['max_capacity']}</td>
                                <td>{$row['organizer_name']}</td>
                                <td>";

                        // Check if the image exists and display it
                        if (!empty($row['event_image']) && file_exists($imagePath)) {
                            echo "<img src='../uploads/{$imagePath}' alt='Event Image' style='width: 100px; height: auto;'>";
                        } else {
                            echo "<img src='https://via.placeholder.com/100' alt='No Image Available' style='width: 100px; height: auto;'>";
                        }

                        echo "</td>
                                <td>
                                
                                    <a href='update_event.php?id={$row['id']}' class='btn btn-sm btn-warning'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <a href='delete_event.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this event?\")'>
                                        <i class='fas fa-trash'></i>
                                    </a>
                                </td>
                            </tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No events found</td></tr>";
                }

                // Close the database connection
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
