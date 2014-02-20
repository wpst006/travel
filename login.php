<?php include ('includes/header.php'); ?>

<?php
if (isset($_POST['submitted'])) {
    //**************************************************************************************
    //Filling Data
    $username = $_POST['username'];
    $password = $_POST['password'];
    //**************************************************************************************
    $objLogIn = new logIn;
    $logInOK = $objLogIn->isLogInOK($username, $password);

    if ($logInOK == false) {
        $error = true;
        $message = "Invalid User Name and Password";
    } else {
        
    }
}
?>

<?php include ('includes/sidebar.php'); ?>
<div id="content">
    <?php include ('includes/banner.php'); ?>

                <?php
            if (isset($message)) {
                if ($error)
                    echo "<div class='error-message'>$message</div>";
                else
                    echo "<div class='success-message'>$message</div>";
            }
            ?> 
    
    <div class="row">
        <div class="col-md-12">

            <form role="form" id="login_form" name="login_form" action="login.php" method="post" class="form-horizontal">

                <div class="form-group">
                    <div class="col-sm-3 control-label">User Name :</div>
                    <div class="col-sm-9">
                        <input type="text" id="username" name="username" class="form-control" value="" maxlength="30"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label">Password :</div>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" class="form-control" value="" maxlength="30"/>
                    </div>
                </div>                  

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" name="submitted" class="btn btn-default btn-primary">Log In</button>
                        <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- end content -->
<div style="clear: both;">&nbsp;</div>

<script type="text/javascript">
    $("#login_form").validate({
        rules: {
            username: 
                {
                required: true
            },
            password: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            username: "Please enter user name.",
            password: "Please enter a password.",                   
        }
    });
</script>

<?php include ('includes/footer.php'); ?>