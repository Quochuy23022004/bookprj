<?php
    session_start();

    if (!isset($_SESSION['username'])) {
      header("Location: signin.php"); 
    }


    $dbConn = new mysqli("localhost", "root", "", "WSUBook");
    if($dbConn->connect_error) {
        die("Failed to connect to database " . $dbConn->connect_error);
    }

    $sql = "SELECT * FROM booking";
    $result = $dbConn->query($sql);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookingID = intval($_POST['bookingID']);
        $updateSql = "UPDATE booking SET status = 'Confirmed', staff_username = ? WHERE bookingId = ?";
        $stmt = $dbConn->prepare($updateSql);
        $stmt->bind_param("si", $_SESSION['username'], $bookingID);
        $stmt->execute();
        $stmt->close();

        header("Location: showbooking.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Booking - WSUBook</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styleconfirm.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-container" >  
        <h2>Show Bookings</h2>
        <table class="table-scroll">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Service Type</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            <?php 
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if($_SESSION['usertype'] === 'student') {
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['bookingID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['service_type']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date_time']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "</tr>";
                        } else {
                            if($row['status'] == 'pending') {
                                echo 
                                    "<tr>";
                                        echo "<td><a href='confirmbooking.php?bookingID=" . urlencode($row['bookingID']) . "'>"
                                        . htmlspecialchars($row['bookingID']) . "</a>
                                    </td>";
                                    echo "<td>" . htmlspecialchars($row['service_type']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['date_time']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                } else {
                    echo "<tr><td colspan='6'>No pending bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$dbConn->close();
?>