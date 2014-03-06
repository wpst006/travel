<?php include('includes/includefiles.php'); ?>    

<?php
$objShoppingCart = new ShoppingCart();
$shoppingCartData = $objShoppingCart->getShoppingCart();
$total = $objShoppingCart->getSubTotal();

if (isset($_POST['submitted'])) {
    //******************************************************************************************************************************************
    //Filling Data
    $payment_id = autoID::get_payment_id();
    $booking_id = autoID::get_booking_id();
    $cardno = $_POST['cardno'];
    $cardtype = $_POST['cardtype'];
    $cardholdername = $_POST['cardholdername'];
    $securitycode = $_POST['securitycode'];
    //******************************************************************************************************************************************
    //"payment" Table Insert
    $paymentInsert_sql = "INSERT INTO " .
            "payments(payment_id,paymentdate,booking_id,cardno,cardtype,cardholdername,securitycode) " .
            "VALUES('$payment_id','" . date('Y-m-d H:i:s') . "','$booking_id','$cardno','$cardtype','$cardholdername','$securitycode')";

    mysql_query($paymentInsert_sql) or die(mysql_error());
    //******************************************************************************************************************************************
    //Getting "member_id" from "Session"
    $customer_id=$_SESSION['user']['user_id'];
    //******************************************************************************************************************************************
    //"bookings" Table Insert
    $bookingInsert_sql = "INSERT INTO " .
            "bookings(booking_id,booking_date,customer_id,total,status) " .
            "VALUES('$booking_id','" . date('Y-m-d H:i:s') . "','$customer_id',$total,1)";
    
    mysql_query($bookingInsert_sql) or die(mysql_error());
    //******************************************************************************************************************************************
    foreach ($shoppingCartData as $index=>$shoppingCartItem){
        $package_id=$shoppingCartItem['package_id'];
        $duration=$shoppingCartItem['duration'];
        $no_of_people=$shoppingCartItem['no_of_people'];
        $price=$shoppingCartItem['price'];
        
        $bookingDetailInsert_sql = "INSERT INTO " .
            "bookingdetails(booking_id,package_id,duration,no_of_people,price) " .
            "VALUES('$booking_id','$package_id','$duration','$no_of_people',$price)";
    
        mysql_query($bookingDetailInsert_sql) or die(mysql_error());
    }
    //******************************************************************************************************************************************
    $message = "Payment is successfully made with Payment ID : " . $payment_id . ".";
    messageHelper::setMessage($message, MESSAGE_TYPE_SUCCESS);
    header("Location:index.php");
    exit();
} else {

    if (count($shoppingCartData) == 0) {
        $error = true;
        $message = 'There is no item in shopping cart. Please Try again.';
        messageHelper::setMessage($message, MESSAGE_TYPE_ERROR);
    }   
}
?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="checkout" name="checkout" action="checkout.php" method="post" class="form-horizontal">

            <div class="form-group">
                <label class="col-sm-3 control-label">Total Amount</label>
                <div class="col-sm-9">
                    <p id="total" class="form-control-static"><?php echo $total; ?></p>
                    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Card No :</div>
                <div class="col-sm-9">
                    <input type="text" id="cardno" name="cardno" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Card Type :</div>
                <div class="col-sm-9">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="cardtype" id="mastercard" value="mastercard" checked>
                            Master
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="cardtype" id="visacard" value="visacard">
                            Visa
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="cardtype" id="amex" value="amex">
                            American Express
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Card Holder :</div>
                <div class="col-sm-9">
                    <input type="text" id="cardholdername" name="cardholdername" class="form-control"  value="" maxlength="4"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Security Code :</div>
                <div class="col-sm-9">
                    <input type="text" id="securitycode" name="securitycode" class="form-control"  value="" maxlength="4"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Check Out</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>                        
            </div>
        </form>
    </div>
</div>                           

<script type="text/javascript">
    $("#checkout").validate({
        rules: {
            cardno: 
                {
                required: true
            },
            cardholdername: 
                {
                required: true
            },
            securitycode: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            cardno: "Please enter card number.",
            cardholdername: "Please enter card holder name.",
            securitycode: "Please enter security code.",                     
        }
    });
</script>

<?php include ('includes/footer.php'); ?>