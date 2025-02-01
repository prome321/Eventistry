<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" type="text/css" href="CSS/header.css">
</head>
<body>
    <nav class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; max-width: 1200px!important; align-items: center;">
            <div class="logo">
                <span>Eventistry</span>
            </div>
            <div class="menu">
                <a href="dashboard.php" class="active">Home</a>
                <a href="event_dashboard.php">Dashboard</a>
                <a href="event_registration.php">Reservation</a>
            </div>
            <div class="actions">
                <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                
                    <a href="../Admin/logout.php">
                        <button class="contact-btn">Logout</button>
                    </a>
                <?php else: ?>
                    <!-- Show Login Button if User is Not Logged In -->
                    <a href="../Admin/login.php">
                        <button class="contact-btn">Login</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</body>
</html>