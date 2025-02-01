<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Organizer</title>
    <link rel="stylesheet" href="CSS/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <ul>
        <li><a href="#" class="menu-item" data-page="Events.php">Create Event</a></li>
        <li><a href="#" class="menu-item" data-page="viewEvent.php">View Event</a></li>
        <li><a href="#" class="menu-item" data-page="view_attendeeList.php">View Attendee List</a></li>
        <li><a href="#" class="menu-item" data-page="attendeelist_download.php">Download Attendee List</a></li>
        <li><a href="logout.php" class="menu-item" id="logout-link">Log Out</a></li>
    </ul>
</nav>

<div class="content" id="main-content">
    <h2>Welcome!</h2>
    <p>Click on the sidebar menu to load content.</p>
</div>

<script>
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
}

$(document).ready(function () {
  
    $(".menu-item").not("#logout-link").click(function (e) {
        e.preventDefault();
        var page = $(this).data("page");

        $.ajax({
            url: page,
            type: "GET",
            success: function (response) {
                $("#main-content").html(response);
            }
        });
    });

    // Handle Log Out click
    $("#logout-link").click(function (e) {
        e.preventDefault();
  
        $("#sidebar").hide();
 
        window.location.href = "login.php";
    });
});
</script>

</body>
</html>