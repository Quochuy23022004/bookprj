<?php
    session_start();
    $dbConn = new mysqli("localhost", "root", "", "WSUBook");
    if($dbConn->connect_error) {
        die("Failed to connect to database " . $dbConn->connect_error);
    }

    $name = "";
    $password = "";
    $nameMsg = "";
    $passMsg = "";
    $errorMsg = "";


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($dbConn, trim($_POST['name'] ?? ''));
        $password = trim($_POST['password'] ?? '');

        if (empty($name)) {
            $nameMsg = "This field is mandatory. Please enter your username!";
        }

        if (empty($password)) {
            $passMsg = "This field is mandatory. Please enter your password!";
        } 

        if (empty($nameMsg) && empty($passMsg)) {
            $hash_password = hash('sha256', $password);
            $sql = "SELECT username, user_type, password FROM user WHERE username = '$name' LIMIT 1";
            $result = $dbConn->query($sql);
            if ($result && $result->num_rows > 0 ) {
                $row = $result->fetch_assoc();

                if ($hash_password ===  $row['password']) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['usertype'] = $row['user_type'];

                    if ($row['user_type'] == "student") {
                        header("Location: makebooking.php");
                    }
                    else {
                        header("Location: checkingbooking.php");
                    }     
                } else {
                    $errorMsg = "Invalid password. Please try again!";
                }
            } else {
                $errorMsg = "Invalid username. Please try again!";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-container">
        <?php if (!empty($errorMsg)): ?>
            <div class="error-message">
                <p style="text-align:center; color:#c33535"><?php echo htmlspecialchars($errorMsg); ?></p>
            </div>
        <?php endif; ?>

        <form id="info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>USER LOGIN</h2>
            <p class="form-desc">Please fill in the form below. All the fields are mandatory.</p>
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameMsg; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <span class="error"><?php echo $passMsg; ?></span>
            </div>
            <div class="form-group">
                <label>User Type</label>
                <div class="radio-group">
                    <label><input type="radio" name="usertype" value="Student"> Student</label>
                    <label><input type="radio" name="usertype" value="Staff"> Staff</label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn-login">Sign In</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
$dbConn->close();
?>
