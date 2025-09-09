<?php
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
    } elseif (strlen($password) < 8) {
        $passMsg = "Your password must be longer than 8 characters!";
    }

    if (empty($nameMsg) && empty($passMsg)) {
        $hash_password = hash('sha256', $password);

        $checkUser = $dbConn->query("SELECT * FROM user WHERE username='$name' LIMIT 1");

        if ($checkUser && $checkUser->num_rows > 0) {
            $errorMsg = "Username already exists. Please try another one!";
        } else {
            $sql = "INSERT INTO user (username, password, user_type) 
                    VALUES ('$name', '$hash_password', 'Student')";
            if ($dbConn->query($sql) === TRUE) {
                header("Location: signin.php");
                exit();
            } else {
                $errorMsg = "Error: " . $dbConn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>USER SIGNUP</h2>
    <?php if (!empty($errorMsg)) : ?>
        <p style="color: red;"><?php echo $errorMsg; ?></p>
    <?php endif; ?>
    <form id="info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p>Please fill in the form below. All the fields are mandatory.</p>
        <label for="name">Username</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
        <span style="color: red;"><?php echo $nameMsg; ?></span>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <span style="color: red;"><?php echo $passMsg; ?></span>
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
<?php
$dbConn->close();
?>