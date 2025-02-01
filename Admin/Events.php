<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Events</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <section>
    <div class="container" style="width:1200px">
      <h2>Create Events</h2>
      <form method="POST" enctype="multipart/form-data" id="createEvent">

        <div class="mb-3">
    <label for="eventName" class="form-label">Event Name</label>
    <input type="text" class="form-control" id="eventName" name="eventName" required>
  </div>

  <!-- Event Date -->
  <div class="mb-3">
    <label for="eventDate" class="form-label">Event Date</label>
    <input type="date" class="form-control" id="eventDate" name="eventDate" required>
  </div>

  <!-- Event Time -->
  <div class="mb-3">
    <label for="eventTime" class="form-label">Event Time</label>
    <input type="time" class="form-control" id="eventTime" name="eventTime" required>
  </div>

  <!-- Location -->
  <div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control" id="location" name="location" required>
  </div>

  <!-- Description -->
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
  </div>

  <!-- Maximum Capacity -->
  <div class="mb-3">
    <label for="maximumCapacity" class="form-label">Maximum Capacity</label>
    <input type="number" class="form-control" id="maximumCapacity" name="maximumCapacity" min="1" required>
  </div>

  <!-- Image -->
  <div class="mb-3">
    <label for="eventImage" class="form-label">Event Image</label>
   <input type="file" class="form-control" id="eventImage" name="eventImage" accept="image/*" required>
  </div>

  <!-- Submit Button -->
  <button type="submit" class="btn btn-primary" name="save_event">Create Event</button>
</form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    $(document).on("submit", "#createEvent", function (e) {
    e.preventDefault();

    var formData = new FormData(this);  

    $.ajax({
        type: "POST",
        url: "process_form.php",  // Adjust the PHP script according to your needs
        data: formData,
        processData: false,  
        contentType: false, 
        dataType: "text",
        success: function (response) {
            alert(response);  // Show the server response
            
            // Reset the form fields
            $("#createEvent")[0].reset();
        },
        error: function () {
            alert("Error while submitting the form");
        }
    });
});
  </script>
</body>
</html>
