<?php
require '../config.php'; // Include database connection

$message = ''; // Initialize message variable

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    $query = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        $message = "<p class='alert alert-danger'>Event not found!</p>";
        exit;
    }
} else {
    $message = "<p class='alert alert-danger'>Event ID is missing!</p>";
    exit;
}

if (isset($_POST['update_event'])) {
    $eventName = mysqli_real_escape_string($conn, $_POST['event_name']);
    $eventDate = mysqli_real_escape_string($conn, $_POST['event_date']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['event_time']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $maximumCapacity = intval($_POST['max_capacity']);
    $organizerId = intval($_POST['organizer_id']);

    if (empty($eventName) || empty($eventDate) || empty($eventTime) || empty($location) || empty($description) || empty($maximumCapacity) || empty($organizerId)) {
        $message = "<p class='alert alert-danger'>All fields are required.</p>";
        exit;
    }

    $query = "SELECT fullname FROM users WHERE id = $organizerId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $organizer = $result->fetch_assoc();
        $organizerName = $organizer['fullname'];
    } else {
        $message = "<p class='alert alert-danger'>Organizer not found.</p>";
        exit;
    }

    $eventImage = $event['event_image'];

    if ($_FILES['event_image']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["event_image"]["name"]);
        if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
            $eventImage = $_FILES["event_image"]["name"];
        }
    }

    $update_query = "UPDATE events SET event_name = ?, event_date = ?, event_time = ?, location = ?, description = ?, max_capacity = ?, event_image = ?, organizer_name = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssisss", $eventName, $eventDate, $eventTime, $location, $description, $maximumCapacity, $eventImage, $organizerName, $event_id);

    if ($stmt->execute()) {
        $message = "<p class='alert alert-success'>Event updated successfully!</p>";
    } else {
        $message = "<p class='alert alert-danger'>Error updating event. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<section>
    <div class="container mt-5">
        <h2 class="mb-4">Update Event</h2>

        <!-- Display success or error message -->
        <?php echo $message; ?>

        <!-- Update Event Form -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $event['event_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= $event['description'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" value="<?= $event['event_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="event_time" class="form-label">Event Time</label>
                <input type="time" class="form-control" id="event_time" name="event_time" value="<?= $event['event_time'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= $event['location'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="max_capacity" class="form-label">Max Capacity</label>
                <input type="number" class="form-control" id="max_capacity" name="max_capacity" value="<?= $event['max_capacity'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="organizer_id" class="form-label">Organizer Name</label>
                <select class="form-control" id="organizer_id" name="organizer_id" required>
                    <option value="">Select Organizer</option>
                    <?php 
                    $result = $conn->query("SELECT id, fullname FROM users WHERE usertype = 'organizer'");

                    if ($result->num_rows > 0) {
                        while ($organizer = $result->fetch_assoc()) {
                            $selected = ($event['organizer_name'] == $organizer['fullname']) ? 'selected' : '';
                            echo "<option value='{$organizer['id']}' $selected>{$organizer['fullname']}</option>";
                        }
                    } else {
                        echo "<option value=''>No organizers available</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="event_image" class="form-label">Event Image</label>
                <input type="file" class="form-control" id="event_image" name="event_image">
                <img src="<?= htmlspecialchars($event['event_image']) ?>" alt="Event Image" 
                style="width: 100px; height: auto; margin-top: 10px;">
            </div>

            <button type="submit" name="update_event" class="btn btn-primary">Update Event</button>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
    <?php if ($message && strpos($message, 'success') !== false): ?>
        setTimeout(function() {
            window.location.href = "index.php"; // Redirect after 2 seconds
        }, 2000);
    <?php endif; ?>
</script>

</body>
</html>
