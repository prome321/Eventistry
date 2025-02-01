<?php

require '../config.php';

$sql = "SELECT id, event_name FROM events"; 
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Attendee List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    
    
 
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Select an Event to Download Attendee List</h2>

        <form action="download.php" method="GET">
            <div class="form-group mb-4">
                <label for="event_id">Select Event:</label>
                <select name="event_id" id="event_id" class="form-control" required>
                    <option value="">-- Choose an Event --</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['event_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No Events Found</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn-custom btn btn-block">Download CSV</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (Optional for some Bootstrap components like tooltips or modals) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
