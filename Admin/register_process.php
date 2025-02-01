<?php
session_start();
require '../config.php';

$success_message = "";
$error_message = ""; 

if (!$conn) {
    die("Database connection not established.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $usertype = htmlspecialchars($_POST['usertype']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $gender = htmlspecialchars($_POST['gender']);

  
    if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($usertype) || empty($birthdate) || empty($password) || empty($confirm_password) || empty($gender)) {
        $error_message = "All fields are required. Please fill in all fields.";
    } else {
        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format. Please enter a valid email address.";
        }
   
        elseif (!preg_match('/^\d{10,11}$/', $phone)) {
            $error_message = "Invalid phone number. Please enter a valid  11 digit phone number.";
}

     
        elseif (strlen($password) < 8) {
            $error_message = "Password must be at least 8 characters long.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $error_message = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $error_message = "Password must contain at least one lowercase letter.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $error_message = "Password must contain at least one number.";
        } elseif (!preg_match('/[\W_]/', $password)) {
            $error_message = "Password must contain at least one special character (e.g., !, @, #, $).";
        } elseif ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $hashing_password = password_hash($password, PASSWORD_DEFAULT);

          
            $check_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
            $check_user->bind_param("ss", $email, $username);
            $check_user->execute();
            $result = $check_user->get_result();

            if ($result->num_rows > 0) {
                $error_message = "This email or username is already registered. Please use a different email or username.";
            } else {
             
                $statement = $conn->prepare("INSERT INTO users(fullname, username, email, phone, usertype, birthdate, password, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $statement->bind_param("ssssssss", $fullname, $username, $email, $phone, $usertype, $birthdate, $hashing_password, $gender);

                if ($statement->execute()) {
                    $success_message = "Registration Successful!";
                } else {
                    $error_message = "Error: " . $statement->error;
                }
                $statement->close();
            }
            $check_user->close();
        }
    }

    // Return the appropriate message back to the AJAX success handler
    if ($success_message) {
        echo "<div style='color: green;'>$success_message</div>";
    } else {
        echo "<div style='color: red;'>$error_message</div>";
    }
}
?>
