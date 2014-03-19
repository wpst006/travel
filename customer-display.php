<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/customerHelper.php'); ?>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM customer WHERE customer_id='" . $_GET['customer_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted a customer package.", MESSAGE_TYPE_SUCCESS);
        header("Location:customer-display.php");
        exit();
    }
}

if (isset($_POST['submitted'])) {

    if (isset($_POST['searchKey'])) {
        $searchKey = $_POST['searchKey'];
    }

    $customerData = customerHelper::searchCustomer($searchKey);
} else {
    $customerData = customerHelper::selectAll();
}
?>
<?php $pageTitle = "Customer Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="customer-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Customer :</label>
                <input type="text" id="searchKey" name="searchKey" class="form-control" value="<?php echo isset($_POST['searchKey']) ? $_POST['searchKey'] : "" ?>" maxlength="30" placeholder="Search"/>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-success my-btn">Search</button>
                <?php
                $link = "print_customer.php";

                if (isset($_POST['searchKey']) || isset($fromDate) || isset($toDate)) {
                    $link.="?searchKey=" . $_POST['searchKey'];
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-success my-btn">Print</a>
            </div>

        </form>
        <br/>

        <table id="customer-table">
            <thead>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Passport No</th>
            <th>Country</th>
            <th>Postal Code</th>
            <th>Phone No</th>
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($customerData as $row) { ?>
                    <tr>
                        <td><?php echo $row['customer_id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>                        
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['passport_no']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['postalcode']; ?></td>
                        <td><?php echo $row['phone_no']; ?></td>
                        <td class="text-right">
                            <a href="customer-display.php?customer_id=<?php echo $row['customer_id']; ?>&action=delete" class="delete-link">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#customer-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });

        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the customer?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>