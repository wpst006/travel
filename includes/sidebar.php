<div id="sidebar">
    <div id="logo">
        <h1><a href="#">Travel Portal</a></h1>       
    </div>
    <!-- end header -->
    <div id="menu">
        <ul>
            <li class="first"><a href="#">Home</a></li>
            <?php if ($isLoggedIn == false) { ?>
                <li><a href="login.php">Log In</a></li>
            <?php } else { ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php } ?>
            <li><a href="#">Travel Packages</a></li>
            <li><a href="#">Customer Support</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </div>
    <!-- end menu -->
    <div id="login">
        <h2 class="title1">Customer Login</h2>
        <form id="form1" method="post" action="#">
            <fieldset>
                <label for="inputtext1">Username:</label>
                <input id="inputtext1" type="text" name="inputtext1" value="" />
                <label for="inputtext2">Password:</label>
                <input id="inputtext2" type="password" name="inputtext2" value="" />
                <input id="inputsubmit1" type="submit" name="inputsubmit1" value="Sign In" />
                <p><a href="#">Forgot your password?</a><br />
                    <a href="#">Register for Free!</a></p>
            </fieldset>
        </form>
    </div>
</div>
<!-- end sidebar -->