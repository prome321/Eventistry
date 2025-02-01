<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location: ../Admin/login.php");
    exit();
}

require 'header.php'; 
require '../config.php'; 
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="CSS/event_details.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>

<main>
    <div class="event-header">
        <img src="Images/sub-banner-img.jpg" alt="Event Banner">
        <h1>Event Registration</h1>
    </div>
    
    <section class="section">
        <div class="container mt-8">
            <div class="reserve-form">
                <div class="row">
                    <div class="col-6">
                        <div>
                            <img src="Images/reserved_sec9.jpg" style="border-style: solid; border-width: 5px 5px 5px 5px; border-color: white; border-radius: 0px 100px 0px 50px; box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, 0.1)">
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="dashboard-product">
                            <img src="Images/sec6_design_element.png">
                            <h2 style="font-size: 60px;">Make Reservations</h2>
                            <p>Don’t Miss Out! Reserve Your Seat for an Unforgettable Experience</p>
                            <form action="submit_registration.php" method="POST">

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <input type="text" name="fullname" placeholder="Your name" class="input-field" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="email" name="email" placeholder="Your email" class="input-field" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <input type="number" name="phone" placeholder="Phone No" class="input-field" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="address" placeholder="Your Address" class="input-field" required>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <select id="event" name="event" class="input-field" required>
                                        <option value="" disabled selected>Select Event</option>
                                        <!-- Event options will be dynamically loaded here -->
                                    </select>
                                </div>

                                <div class="input-box mt-4">
                                    <select id="ticket_type" name="ticket_type" class="input-field" required>
                                        <option value="" disabled selected>Select Ticket Type</option>
                                        <option value="general">General Admission</option>
                                        <option value="vip">VIP</option>
                                    </select>
                                </div>

                                <button style="margin-top: 20px;" type="submit">Make Reservation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Function to fetch event data and populate the "Select Event" dropdown
        function fetchEvents() {
            fetch('http://localhost/EventManagement/Attendee/fetch_events.php')
                .then(response => response.json())
                .then(data => {
                    const eventDropdown = document.getElementById('event');

                    if (data.status === 200) {
                        data.data.forEach(event => {
                            // Create an option element for each event and append it to the dropdown
                            const option = document.createElement('option');
                            option.value = event.id;
                            option.textContent = event.event_name;
                            eventDropdown.appendChild(option);
                        });
                    } else {
                        console.error('Error fetching events:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Call fetchEvents function on page load
        window.onload = fetchEvents;
    </script>

    <?php
    require 'footer.php'; // Include footer
    ?>
</main>