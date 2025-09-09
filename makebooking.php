<?php

  session_start();

  if (!isset($_SESSION['username'])) {
    header("Location: signin.php"); 
  } else if($_SESSION['usertype'] != 'student') {
    header("Location: checkingbooking.php");
  }

  $dbConn = new mysqli("localhost", "root", "", "WSUBook");
  if($dbConn->connect_error) {
    die("Failed to connect to database " . $dbConn->connect_error);
  }

  $username = "";
  $booktitle = "";
  $date = "";
  $userNameErr = "";
  $bookTitleErr = "";
  $dateErr = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? ''); 
    $booktitle = trim($_POST['booktitle'] ?? ''); 
    $date = trim($_POST['date'] ?? ''); 
    $userNameErr = empty($username) ? "Student username haven't exist, please try again!" : "";
    $bookTitleErr = empty($booktitle) ? "Title haven't exist, please try again!" : "";
    $dateErr = empty($date) ? "Date can't empty, please try again!" : "";
    $flagCheck = empty($userNameErr) && empty($bookTitleErr) && empty($dateErr);
    if($flagCheck) {
      $stmt = $dbConn->prepare("INSERT INTO booking (student_username, staff_username, service_type, date_time, status) VALUES (?, '', ?, ?, 'pending')");
      $stmt->bind_param("sss", $username, $booktitle, $date);

      if ($stmt->execute()) {
        header("Location: showbooking.php");
        exit();
      } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
      }
      $stmt->close();
    }
  }
?>
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
  <?php include 'header.php'; ?>
    
  <!-- Booking Form -->
  <div class="form-container">
    <form action="makebooking.php" method="post" class="signup-form">
      <h2>Make a Booking</h2>
      <p class="form-desc">Please fill in the form below to make your booking.</p>

      <div class="form-group">
        <label for="username">Student Username(*)</label>
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <span class="error-msg"><?php echo $userNameErr; ?></span>
      </div>

      <div class="form-group">
        <label for="booktitle">Book Title(*)</label>
        <select name="booktitle" id="booktitle">
            <option value="">-- Select a book --</option>
            <option value="Academy Support">Academy Support</option>
            <option value="Student Life">Student Life</option>
            <option value="Health And Wellbeing">Health And Wellbeing</option>
            <option value="Administrative Service">Administrative Service</option>
        </select>
        <span class="error-msg"><?php echo $bookTitleErr; ?></span>
      </div>

      <div class="form-group">
        <label for="date">Booking Date</label>
        <input type="date" name="date" id="date"></br>
        <span class="error-msg"><?php echo $dateErr; ?></span>
      </div>

      <button type="submit" name="submit" class="btn">Confirm Booking</button>
    </form>
  </div>

</body>
</html>
<?php
$dbConn->close();
?>