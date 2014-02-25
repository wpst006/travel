<?php include ('includes/includefiles.php'); ?>

<?php
if (isset($_POST['submitted'])) {
    $error = false;
    //*********************************************************************
    //Filling Data
    $customer_id = autoID::getAutoID('users', 'user_id', 'CUS', 6);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $passport_no = $_POST['passport_no'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $phone_no = $_POST['phone_no'];
    //*********************************************************************
    //"customers" Table Insert
    $customerInsert_sql = "INSERT INTO " .
            "customers(customer_id,firstname,lastname,passport_no,country,postalcode,phone_no) " .
            "VALUES('$customer_id','$firstname','$lastname','$passport_no','$country','$postalcode','$phone_no')";

    mysql_query($customerInsert_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Insert
    $userInsert_sql = "INSERT INTO " .
            "`users`(user_id,username,email,password,role) " .
            "VALUES('$customer_id','$username','$email','$password','member')";

    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************					
    messageHelper::setMessage("You have successfully registered. Please log in to continue.", MESSAGE_TYPE_SUCCESS);
    header("Location:login.php");
    exit();
}
?>

<?php include ('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="register" name="register" action="register.php" method="post" class="form-horizontal">

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
                <div class="col-sm-3 control-label">Confirm Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Email :</div>
                <div class="col-sm-9">
                    <input type="text" id="email" name="email" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">First Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="firstname" name="firstname" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Last Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="lastname" name="lastname" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Passport No:</div>
                <div class="col-sm-9">
                    <input type="text" id="passport_no" name="passport_no" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Country :</div>
                <div class="col-sm-9">
                    <input type="text" id="country" name="country" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Postal Code :</div>
                <div class="col-sm-9">
                    <input type="text" id="postalcode" name="postalcode" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Phone No :</div>
                <div class="col-sm-9">
                    <input type="text" id="phone_no" name="phone_no" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>                        
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $("#register").validate({
        rules: {
            username: 
                {
                required: true
            },
            password: 
                {
                required: true
            },
            confirm_password: 
                {
                required:true,
                equalTo: "#password"
            },
            email: 
                {
                required: true,
                email: true
            },
            firstname: 
                {
                required: true
            },
            lastname: 
                {
                required: true
            },
            passport_no:
                {
                required: true
            },
            country:
                {
                required: true
            },
            postalcode:
                {
                required: true
            },
            phone_no:
                {
                required: true
            },
        },
        //set messages to appear inline
        messages: 
            {
            username: "Please enter user name.",
            password: "Please enter a password.",
            confirm_password: 
                {
                required: "Please enter a confirm password.",
                equalTo: "Password and Confirm Password not match."
            },
            email: 
                { 
                required: "Please enter a E-Mail address.",
                email: "Please enter a valid E-Mail address."
            },
            firstname: "Please enter first name.",
            lastname: "Please enter last name.", 
            passport_no: "Please enter Passport No.",
            country: "Please enter Country.",
            postalcode: "Please enter Postal Code.",
            phone_no: "Please enter Phone No.",
        }
    });
</script>

<?php include ('includes/footer.php'); ?>