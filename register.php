<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/customerHelper.php"); ?>    

<?php
$customer_id = null;
$username = '';
$password = '';
$email = '';
$firstname = '';
$lastname = '';
$passport_no = '';
$country = '';
$postalcode = '';
$phone_no = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['customer_id'])) {
        $customer_id = $_POST['customer_id'];
        updateCustomer($customer_id);
    } else {
        saveNewCustomer($customer_id);
    }
} else {

    if (isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];
        fillDataForEditMode($customer_id, $username, $password, $email, $firstname, $lastname, $passport_no, $country, $postalcode, $phone_no);
    }
}

function saveNewCustomer(&$customer_id) {
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
    //Check if the customer name already exist
    $isUserNameAlreadyExist = customerHelper::isUserNameAlreadyExist($username);

    if ($isUserNameAlreadyExist == true) {
        messageHelper::setMessage("The user name <b>$username</b> already existed. Please try again", MESSAGE_TYPE_SUCCESS);
        header("Location:register.php");
        exit();
    }
    //*********************************************************************
    //"members" Table Insert
    $cutomerInsert_sql = "INSERT INTO " .
            "customers(customer_id,firstname,lastname,passport_no,country,postalcode,phone_no) " .
            "VALUES('$customer_id','$firstname','$lastname','$passport_no','$country','$postalcode','$phone_no')";

    mysql_query($cutomerInsert_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Insert
    $userInsert_sql = "INSERT INTO " .
            "`users`(user_id,username,email,password,role) " .
            "VALUES('$customer_id','$username','$email','$password','customer')";

    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully registered. Please log in to continue.", MESSAGE_TYPE_SUCCESS);
    header("Location:login.php");
    exit();
    //*********************************************************************
}

function updateCustomer(&$customer_id) {
    //*********************************************************************
    //Filling Data
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
    //"customers" Table Update
    $customer_sql = "UPDATE customers " .
            "SET " .
            "firstname='" . $firstname . "'," .
            "lastname='" . $lastname . "'," .
            "passport_no='" . $passport_no . "'," .
            "country='" . $country . "'," .
            "postalcode='" . $postalcode . "'," .
            "phone_no='" . $phone_no . "' " .
            "WHERE customer_id='" . $customer_id . "'";

    mysql_query($customer_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Update
    $userInsert_sql = "UPDATE `users` " .
            "SET email='" . $email . "', " .
            "password='" . $password . "' " .
            "WHERE user_id='" . $customer_id . "'";

    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully updated your information.", MESSAGE_TYPE_SUCCESS);
    header("Location:register.php?customer_id=" . $customer_id);
    exit();
    //*********************************************************************
}

function fillDataForEditMode($customer_id, &$username, &$password, &$email, &$firstname, &$lastname, &$passport_no, &$country, &$postalcode, &$phone_no) {
    $data = customerHelper::getCustomerByCustomerID($customer_id);
    $customer_id = $data[0]['customer_id'];
    $username = $data[0]['username'];
    $password = $data[0]['password'];
    $email = $data[0]['email'];
    $firstname = $data[0]['firstname'];
    $lastname = $data[0]['lastname'];
    $passport_no = $data[0]['passport_no'];
    $country = $data[0]['country'];
    $postalcode = $data[0]['postalcode'];
    $phone_no = $data[0]['phone_no'];
}
?>

<?php $pageTitle = "Register" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="register" name="register" action="register.php" method="post" class="form-horizontal">

            <?php if (isset($customer_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Customer ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $customer_id; ?></p>                                    
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">User Name :</div>
                <div class="col-sm-9">
                    <?php if (isset($customer_id)) { ?>
                        <p class="form-control-static"><?php echo $username; ?></p>      
                        <input type="hidden" id="username" name="username" value="<?php echo $username; ?>"/>
                    <?php } else { ?>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" maxlength="30"/>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label" style="font-size:10pt;">Confirm Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="<?php echo $password; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Email :</div>
                <div class="col-sm-9">
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">First Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Last Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname; ?>" maxlength="30"/>
                </div>
            </div>            

            <div class="form-group">
                <div class="col-sm-3 control-label">Passport No :</div>
                <div class="col-sm-9">
                    <input type="text" id="passport_no" name="passport_no" class="form-control" value="<?php echo $passport_no; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Country :</div>
                <div class="col-sm-9">
                    <input type="text" id="country" name="country" class="form-control" value="<?php echo $country; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Post Code :</div>
                <div class="col-sm-9">
                    <input type="text" id="postalcode" name="postalcode" class="form-control" value="<?php echo $postalcode; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Phone No :</div>
                <div class="col-sm-9">
                    <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $phone_no; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary" onclick="return userInputValidate();">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>

        </form>
    </div> 
</div>                    

<?php include ('includes/footer.php'); ?>
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
            passport_no: "Please enter NRC No.",
            country: "Please enter country.",
            postalcode: "Please enter post Code.",  
            phone_no: "Please enter phone no.",              
        }
    });
</script>