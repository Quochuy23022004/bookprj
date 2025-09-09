<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WSUBook - Make Booking</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
  <!-- Booking Form -->
  <div class="form-container">
    <form action="makebooking.php" method="post" class="signup-form">
      <h2>Make a Booking</h2>
      <p class="form-desc">Please fill in the form below to make your booking.</p>

      <div class="form-group">
        <label for="username">Student Username(*)</label>
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <span class="error-msg">Student haven't exist, please try again!</span>
      </div>

      <div class="form-group">
        <label for="booktitle">Book Title(*)</label>
        <select name="booktitle" id="booktitle">
            <option value="">-- Select a book --</option>
            <option value="book1">Academy Support</option>
            <option value="book2">Student Life</option>
            <option value="book3">Health And Wellbeing</option>
            <option value="book4">Administrative Service</option>
        </select>
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
