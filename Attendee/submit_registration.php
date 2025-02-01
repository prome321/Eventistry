<?php
session_start(); // Start session at the top


if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location: ../Admin/login.php");
    exit();
}


require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $event_id = $_POST['event'];
    $ticket_type = $_POST['ticket_type'];

  
    $sql_capacity = "SELECT max_capacity, 
                            (SELECT COUNT(*) FROM reservations WHERE event_id = ?) AS current_reservations
                     FROM events
                     WHERE id = ?";  

    if ($stmt = $conn->prepare($sql_capacity)) {
        $stmt->bind_param("ii", $event_id, $event_id);  
        $stmt->execute();
        $stmt->bind_result($maximum_capacity, $current_reservations);
        $stmt->fetch();
        $stmt->close();

        // Check if there is space left
        if ($current_reservations >= $maximum_capacity) {
            // Capacity exceeded, show alert message
            echo "<script>alert('Sorry, this event is fully booked.'); window.location.href = 'dashboard.php';</script>";
        } else {
           
            $sql_check_duplicate = "SELECT COUNT(*) FROM reservations WHERE event_id = ? AND email = ? AND fullname = ?";

            if ($stmt = $conn->prepare($sql_check_duplicate)) {
                $stmt->bind_param("iss", $event_id, $email, $fullname);
                $stmt->execute();
                $stmt->bind_result($duplicate_count);
                $stmt->fetch();
                $stmt->close();

                if ($duplicate_count > 0) {
             
                    echo "<script>alert('You have already made a reservation for this event.'); window.location.href = 'dashboard.php';</script>";
                } else {
                
                    $sql_insert = "INSERT INTO reservations (event_id, fullname, email, phone, address, ticket_type) 
                                   VALUES (?, ?, ?, ?, ?, ?)";

                    if ($stmt = $conn->prepare($sql_insert)) {
                        $stmt->bind_param("isssss", $event_id, $fullname, $email, $phone, $address, $ticket_type);
                        $stmt->execute();
                        $stmt->close();

                    
                        $sql_update = "UPDATE events SET max_capacity = max_capacity - 1 WHERE id = ?";
                        
                        if ($stmt = $conn->prepare($sql_update)) {
                            $stmt->bind_param("i", $event_id);  // Bind event_id to the update query
                            $stmt->execute();
                            $stmt->close();
                        }

                     
                        echo "<script>alert('Reservation successful!'); window.location.href = 'dashboard.php';</script>";
                    } else {
                       
                        echo "<script>alert('Error making reservation. Please try again.'); window.location.href = 'dashboard.php';</script>";
                    }
                }
            } else {
             
                echo "<script>alert('Error checking for duplicate reservations.'); window.location.href = 'dashboard.php';</script>";
            }
        }
    } else {
        
        echo "<script>alert('Error fetching event data.'); window.location.href = 'dashboard.php';</script>";
    }
}
?>
