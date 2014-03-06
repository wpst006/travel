<?php include('includes/includefiles.php'); ?>

<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}


$objShoppingCart = new ShoppingCart();

//var_dump($objShoppingCart->getShoppingCart());
if ($action == 'add2cart') {
    $package_id = $_GET['package_id'];
    $title = $_GET['title'];
    $duration = $_GET['duration'];
    $no_of_people = $_GET['no_of_people'];
    $price = $_GET['price'];    
    
    if ($objShoppingCart->insert($package_id,$title,$duration,$no_of_people,$price)  == 1) {
        messageHelper::setMessage('Package is successfully added to the booking.', MESSAGE_TYPE_SUCCESS);
    } else {
        messageHelper::setMessage('Error occured while adding seat to the booking.', MESSAGE_TYPE_ERROR);
    }
}

if ($action == 'clear') {
    $objShoppingCart->clear();
    messageHelper::setMessage('Booking is cleared.', MESSAGE_TYPE_INFO);
}

if ($action == 'remove') {
    $seat_id = $_GET['seat_id'];
    $objShoppingCart->remove($seat_id);
    messageHelper::setMessage('Package is successfully removed from the booking.', MESSAGE_TYPE_INFO);
}
?>

<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">   
</style>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="package-tour-display.php" class="btn btn-warning">Go to Package Tour Page</a>
        <a href="checkout.php" class="btn btn-primary">Check Out</a>
        <a href="addBooking.php?action=clear" class="btn btn-danger">Clear</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="seat_table">
            <thead>
                <tr>
                    <th class="title-column">Title</th>
                    <th class="artist-column">Duration</th>
                    <th class="artist-column">No of People</th>
                    <th class="price-column">Price</th>
                    <th class="download-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objShoppingCart->getShoppingCart() as $row) { ?>
                    <tr id="<?php echo $row['package_id']; ?>">
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="artist-column"><?php echo $row['duration']; ?></td>
                        <td class="artist-column"><?php echo $row['no_of_people']; ?></td>
                        <td class="price-column"><?php echo $row['price']; ?></td>                                
                        <td class="remove-column">
                            <a href="addBooking.php?package_id=<?php echo $row['package_id']; ?>&action=remove"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                <?php } ?>                            
            </tbody>
        </table>
    </div>
</div>                

<div class="row">
    <div class="col-md-12 text-right">
        <p><b>Sub Total : </b><?php echo $objShoppingCart->getSubTotal(); ?></p>
    </div>
</div>           

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#seat_table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bPaginate": false
        } );
    });
</script>

<?php include('includes/footer.php'); ?>
