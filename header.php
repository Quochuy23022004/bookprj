<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Navigation -->
<div class="menu">
<nav class="navbar" style="display:flex">
    <div class="logo">WSUBook</div>
    <ul>
        <?php if ($current_page === "signin.php" || $current_page === "signup.php"): ?>
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="signup.php" class="<?php echo $current_page == 'signup.php' ? 'active' : ''; ?>">Sign Up</a></li>
            <li><a href="signin.php" class="<?php echo $current_page == 'signin.php' ? 'active' : ''; ?>">Sign In</a></li>
            <li><a href="makebooking.php" class="<?php echo $current_page == 'logout.php' ? 'active' : ''; ?>">Make Booking</a></li>
            <li><a href="confirmbooking.php" class="<?php echo $current_page == 'confirmbooking.php' ? 'active' : ''; ?>">Confirm Booking</a></li>
        <?php elseif ($current_page === "makebooking.php" || $current_page === "confirmbooking.php"): ?>
            <li><a href="information.php" class="<?php echo $current_page == 'information.php' ? 'active' : ''; ?>"><?php echo $_SESSION['username'];?></a></li>
            <li><a href="showbooking.php" class="<?php echo $current_page == 'showbooking.php' ? 'active' : ''; ?>">Show Booking</a></li>
            <li><a href="logout.php" class="<?php echo $current_page == 'logout.php' ? 'active' : ''; ?>">Logout</a></li>
        <?php elseif ($current_page === "showbooking.php"): ?>
            <li><a href="information.php" class="<?php echo $current_page == 'information.php' ? 'active' : ''; ?>"><?php echo $_SESSION['username'];?></a></li>
            <li><a href="makebooking.php" class="<?php echo $current_page == 'makebooking.php' ? 'active' : ''; ?>">Make Booking</a></li>
            <li><a href="logout.php" class="<?php echo $current_page == 'logout.php' ? 'active' : ''; ?>">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>
</div>