<?php include ('includes/includefiles.php'); ?>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM packagetours WHERE package_id='" . $_GET['package_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************    
        messageHelper::setMessage("You have successfully deleted a tour package.", MESSAGE_TYPE_SUCCESS);
        header("Location:package-tour-display.php");
        exit();
    }
}
?>

<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <table id="package-tour-table">
            <thead>
            <th>Package ID</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Price</th>           
            <th></th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT packagetours.* " .
                        "FROM packagetours " .
                        "ORDER BY package_id";

                $result = mysql_query($sql) or die(mysql_error());
                ?>
                <?php while ($row = mysql_fetch_array($result)) { ?>
                    <tr>                        
                        <td><?php echo $row['package_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['duration']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td class="text-right">
                            <a href="package-tour.php?package_id=<?php echo $row['package_id']; ?>">Edit</a>
                            &nbsp;<a href="package-tour-display.php?package_id=<?php echo $row['package_id']; ?>&action=delete" class="delete-link">Delete</a>
                            &nbsp;<a href="addHotel.php?package_id=<?php echo $row['package_id']; ?>">Hotel Set Up</a>
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
        $('#package-tour-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
        });                      
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the package?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>