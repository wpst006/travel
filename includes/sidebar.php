<div id="sidebar">
    <div id="logo">        
    </div>
    <!-- end header -->
    <div id="menu">
        <ul>
            <li class="first"><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <?php if ($isLoggedIn == false) { ?>
                <li><a href="login.php">Log In</a></li>
            <?php } else { ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php } ?>    
            <?php if ($objLogIn->isAdminLogIn()) { ?>
                <li><a href="package-tour.php">Packge Tour Set Up</a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- end sidebar -->