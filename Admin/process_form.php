<?php
session_start();
require '../config.php';

if (!isset($_SESSION['userid'])) {
    echo "User is not logged in.";
    exit;
}

$userId = $_SESSION['userid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] == 0) {
        $imageTmpName = $_FILES['eventImage']['tmp_name'];
        $imageType = $_FILES['eventImage']['type'];
        $imageSize = $_FILES['eventImage']['size'];
        $uploadDir = '../uploads/'; // Safe directory
        $imagePath = "";

    

        // File validation
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!in_array($imageType, $allowedTypes)) {
            echo "Invalid image type. Only JPEG, PNG, and GIF are allowed.";
            exit;
        }
        if ($imageSize > 5000000) { // 5MB limit
            echo "Image size exceeds the 5MB limit.";
            exit;
        }

        // Unique file name
        $imageName = uniqid() . "_" . basename($_FILES['eventImage']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            $imagePath = '../uploads/'.$imageName; // Store relative path
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        echo "Please upload an event image.";
        exit;
    }

   
    $roleCheckQuery = "SELECT usertype, fullname FROM users WHERE id = ?";
    $stmt = $conn->prepare($roleCheckQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "User not found.";
        exit;
    }
    $stmt->bind_result($role, $organizerName);
    $stmt->fetch();
    $stmt->close();

    if ($role !== 'organizer') {
        echo "Unauthorized action.";
        exit;
    }

    $eventName = mysqli_real_escape_string($conn, $_POST['eventName']);
    $eventDate = mysqli_real_escape_string($conn, $_POST['eventDate']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['eventTime']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $maximumCapacity = intval($_POST['maximumCapacity']);

    if (empty($eventName) || empty($eventDate) || empty($eventTime) || empty($location) || empty($description) || empty($maximumCapacity)) {
        echo "All fields are required.";
        exit;
    }

   
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, event_time, location, description, max_capacity, event_image, organizer_name) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiss", $eventName, $eventDate, $eventTime, $location, $description, $maximumCapacity, $imagePath, $organizerName);

    if ($stmt->execute()) {
        echo "Event created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
