<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/packageTourHelper.php'); ?>
<?php

if ($objLogIn->isMemberLogIn()==false){
     messageHelper::setMessage("You haven't logged into the system. Please log in to continue.", MESSAGE_TYPE_INFO);
    header("Location:login.php");
    exit();
}

$package_id = $_GET['package_id'];
$title = $_GET['title'];
$price = $_GET['price'];
?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="add_booking_details" name="add_booking_details" action="addBooking.php" method="get" class="form-horizontal">

            <input type="hidden" id="package_id" name="package_id" value="<?php echo $package_id; ?>" />
            <input type="hidden" id="title" name="title" value="<?php echo $title; ?>" />
            <input type="hidden" id="price" name="price" value="<?php echo $price; ?>" />
            <input type="hidden" id="action" name="action" value="add2cart" />

            <div class="form-group">
                <label class="col-sm-3 control-label">Title</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $title; ?></p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Price</div>
                <div class="col-sm-9">
                    <p id="price" class="form-control-static"><?php echo $price; ?></p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Duration :</div>
                <div class="col-sm-9">
                    <?php
                    $durationData = packageTourHelper::getDuration();
                    ?>
                    <select id="duration" name="duration" class="chosen-select">
                        <?php for ($i = 0; $i < count($durationData); $i++) { ?>
                            <option value="<?php echo $durationData[$i]; ?>"><?php echo $durationData[$i] . " day(s)"; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">No of People :</div>
                <div class="col-sm-9">
                    <select id="no_of_people" name="no_of_people" class="chosen-select">
                        <?php for ($i = 1; $i < 100; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i . " person(s)"; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Add to Booking</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "100%"});
    });
</script>

<?php include ('includes/footer.php'); ?>