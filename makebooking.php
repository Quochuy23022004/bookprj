<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WSUBook - Make Booking</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Navigation -->
   <div class="menu">
        <nav class="navbar">
            <div class="logo">WSUBook</div>
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="signin.php">Sign In</a></li>
            <li><a href="makebooking.php" class="active">Make Booking</a></li>
            <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </div>
    
  <!-- Booking Form -->
  <div class="form-container">
    <form action="makebooking.php" method="post" class="signup-form">
      <h2>Make a Booking</h2>
      <p class="form-desc">Please fill in the form below to make your booking.</p>

      <div class="form-group">
        <label for="username">Student Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <span class="error-msg">Student haven't exist, please try again!</span>
      </div>

      <div class="form-group">
        <label for="booktitle">Book Title</label>
        <input type="text" name="booktitle" id="booktitle" placeholder="Enter book title">
        <span class="error-msg">Title haven't exist, please try again!</span>
      </div>

      <div class="form-group">
        <label for="date">Booking Date</label>
        <input type="date" name="date" id="date"></br>
        <span class="error-msg">Booking Date incorrect, please try again!</span>
      </div>

      <button type="submit" name="submit" class="btn">Confirm Booking</button>
    </form>
  </div>

</body>
</html>
