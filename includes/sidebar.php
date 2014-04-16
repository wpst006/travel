<div id="sidebar">
    <div id="logo">        
    </div>
    <!-- end header -->
    <div id="menu">
        <ul>
            <li class="first"><a href="index.php">Home</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="register.php">Register</a></li>
            <?php if ($isLoggedIn == false) { ?>
                <li><a href="login.php">Log In</a></li>
            <?php } else { ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php } ?>    
            <?php if ($objLogIn->isAdminLogIn()) { ?>
                <li><a href="package-tour.php">Packge Tour Set Up</a></li>
                <li><a href="customer-display.php">Customer Report</a></li>
                <li><a href="booking-display.php">Booking Report</a></li>
            <?php } ?>
            <?php
            $logInData = $objLogIn->getLoggedInUserInfo();

            if (isset($logInData)) {
            ?>
                <li>
                    <a href="register.php?customer_id=<?php echo $logInData['user_id']; ?>">
                    Logged in as <?php echo $logInData['username'] . " (" . $logInData['role'] . ")"; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- end sidebar -->