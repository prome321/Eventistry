<?php
session_start();

require '../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password)) {
        $error_message = "Username and password are required.";
    } else {
        $check_user = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check_user->bind_param("s", $username);
        $check_user->execute();
        $result = $check_user->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['usertype'] = $user['usertype'];
                $_SESSION['userid'] = $user['id']; // Assuming there's a user ID
                $_SESSION['is_logged_in'] = true; // Set logged-in status

                if ($user['usertype'] === 'admin') {
                    header("Location: ../Admin/index.php"); // Redirect to the admin dashboard
                    exit;
                } else if ($user['usertype'] === 'organizer') {
                    header("Location: ../Admin/index.php");
                    exit;
                } else {
                    header("Location: ../Attendee/dashboard.php"); // Redirect to user dashboard
                    exit;
                }
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "No user found with that username.";
        }
        $check_user->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="CSS/Style.css">
</head>
<body>
  <div class="container">
    <!-- Title section -->
    <div class="title">Login</div>
    <div class="content">
      <!-- Login form -->
      <form method="POST">
        <div class="user-box">
          <!-- Input for Username -->
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required>
          </div>

          <!-- Input for Password -->
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password" required>
          </div>
        </div>

        <!-- Submit button -->
        <div class="button">
          <input type="submit" value="Login">
        </div>

        <div style="text-align: center; margin-top: 10px;">
          <span>Don't have an account?</span>
          <a href="register.php" style="text-decoration: none; color: #007bff;">Sign up</a>
        </div>

        <!-- Back to Home link with arrow -->
        <div style="text-align: center; margin-top: 10px;">
          <a href="../Attendee/dashboard.php" style="text-decoration: none; color: #F4A492;">Back to Home →</a>
        </div>

        <?php if (isset($error_message)) { ?>
          <div style="color: red; text-align: center;"><?php echo $error_message; ?></div>
        <?php } ?>
      </form>
    </div>
  </div>
</body>
</html>