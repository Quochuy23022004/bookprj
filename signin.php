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
    } 
    if (empty($nameMsg) && empty($passMsg)) {
       $hash_password = hash('sha256', $password);
$sql = "SELECT password FROM user WHERE username = '$name' LIMIT 1";
$result = $dbConn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
 echo "<p>Welcome to TWA Prac Set 2, " . htmlspecialchars($name) . "!</p>";      
}
 else {
            echo "<p>Invalid username or password. Please try again!</p>";
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
    <h2>USER LOGIN</h2>
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
        <br>
        <label for="usertype">User Type></label>
        <input type="radio" name="usertype" value="Student">
        <input type="radio" name="usertype" value="Staff">
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
<?php
$dbConn->close();
?>
