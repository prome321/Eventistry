<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="CSS/Login.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    
    <div id="message" style="text-align: center;"></div>

    <div class="content">
      <!-- Registration form -->
      <form id="registrationForm" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="fullname" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" required>
          </div>
          <div class="input-box">
            <span class="details">Usertype</span>
            <select class="form-select" name="usertype" required>
              <option value="" disabled selected>Choose Usertype</option>
              <option value="attendee">Attendee</option>
              <option value="organizer">Organizer</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Birth-date</span>
            <input type="date" name="birthdate" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirm_password" required>
          </div>
        </div>
        
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="Male" required>
          <input type="radio" name="gender" id="dot-2" value="Female">
          <input type="radio" name="gender" id="dot-3" value="Prefer not to say">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Male</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Female</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>

        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>

      <!-- Back to Home link with arrow -->
      <div style="text-align: center; margin-top: 20px;">
        <a href="../Attendee/dashboard.php" style="text-decoration: none; color: #F4A492;">Back to Home →</a>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // When the form is submitted
      $("#registrationForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
          url: 'register_process.php', // PHP script for handling the registration
          type: 'POST',
          data: formData,
          success: function(response) {
            // Inject the response (success or error message) into the #message div
            $('#message').html(response);

            // If registration was successful, clear the form fields
            if (response.indexOf("Registration Successful!") !== -1) {
              $('#registrationForm')[0].reset(); // This will reset all form fields
            }
          },
          error: function() {
            $('#message').html("<div style='color:red;'>An error occurred. Please try again.</div>");
          }
        });
      });
    });
  </script>
</body>
</html>