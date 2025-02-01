<?php
require 'header.php';
require '../config.php'; // Include header
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>

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
        <h1>Event Description</h1>
    </div>
    <div class="container mt-5 mb-5">
        <div id="event-details" class="row">
            <!-- Event details will be dynamically loaded here -->
        </div>


      
    </div>
      <div class="d-flex justify-content-center mt-4 mb-4">
            <button style="
                background-color: #ff6f61;
                color: white;
                border: none;
                padding: 15px 30px;
                border-radius: 30px;
                font-size: 1rem;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            "><a href="event_registration.php" style="    color: white;
    text-decoration: none;">Make Reservation</a></button>
        </div>

    <script>
        // Get event ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('id');

        if (!eventId) {
            document.getElementById('event-details').innerHTML = '<p class="text-danger">Invalid Event ID</p>';
        } else {
            fetchEventDetails(eventId);
        }

        function fetchEventDetails(id) {
            fetch(`http://localhost/EventManagement/Attendee/read_description.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log("API Response:", data);

                    if (data.status === 200 && data.data) {
                        displayEventDetails(data.data);
                    } else {
                        document.getElementById('event-details').innerHTML = `<p class="text-danger">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching event details:', error);
                    document.getElementById('event-details').innerHTML = `<p class="text-danger">Failed to load event details. Please try again later.</p>`;
                });
        }

        function displayEventDetails(event) {
            const eventDetails = document.getElementById('event-details');
            eventDetails.innerHTML = `
                <div class="col-md-6">
                    <img src="${event.event_image}" alt="${event.event_name}" width="100%" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2>${event.event_name}</h2>
                    <p><strong>Date:</strong> ${event.event_date || 'TBD'}</p>
                    <p><strong>Description:</strong> ${event.event_time || 'No description available'}</p>
                    <p><strong>Location:</strong> ${event.location || 'TBD'}</p>
                    <p><strong>Description:</strong> ${event.description || 'No description available'}</p>
                    <p><strong>Maximum Capacity:</strong> ${event.max_capacity || 'No description available'}</p>
                    <p><strong>Organizer Name:</strong> ${event.organizer_name || 'No description available'}</p>
                </div>
            `;
        }
    </script>
    
    <?php require 'footer.php'; // Include footer ?>
</main>
