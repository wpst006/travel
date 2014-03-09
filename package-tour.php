<?php include ('includes/includefiles.php'); ?>
<?php require_once('includes/packageTourHelper.php'); ?>
<?php
if (isset($_POST['submitted'])) {
    //*********************************************************************
    //Filling Data
    if (isset($_POST['package_id'])){
        $package_id=$_POST['package_id'];
    }else{
        $package_id = autoID::getAutoID('packagetours', 'package_id', 'PKG_', 6);
    }
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    //*********************************************************************
    if (!isset($_POST['package_id'])){
        //"package tours" Table Insert
        $packageTour_sql = "INSERT INTO " .
                "packagetours(package_id,title,duration,price) " .
                "VALUES('$package_id','$title','$duration',$price)";
    }else{
        //"package tours" Table Update
        $packageTour_sql = "UPDATE " .
                "packagetours " .
                "SET title='" . $title . "'," .
                "duration='" . $duration . "'," .
                "price=" . $price . " " .
                "WHERE package_id='" . $package_id . "'";
    }
    mysql_query($packageTour_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully saved a tour package.", MESSAGE_TYPE_SUCCESS);
    header("Location:package-tour-display.php");
    exit();
}else{

    $title='';
    $duration=1;
    $price=0.0;

    if (isset($_GET['package_id'])){
        $package_id=$_GET['package_id'];
        $packageTourData=  packageTourHelper::getPackageTourByPackageID($package_id);
        $title=$packageTourData['title'];
        $duration=$packageTourData['duration'];
        $price=$packageTourData['price'];
    }else{

    }
}
?>

<?php $pageTitle="Package Tour Set Up"; ?>
<?php include ('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="package_tour" name="package_tour" action="package-tour.php" method="post" class="form-horizontal">

            <?php if (isset($_GET['package_id'])){ ?>
            <input type="hidden" id="package_id" name="package_id" value="<?php echo $_GET['package_id']; ?>" />
            <input type="hidden" id="selected_duration" name="selected_duration" value="<?php echo $duration; ?>" />
            <?php } ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">Title :</div>
                <div class="col-sm-9">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Duration :</label>
                <div class="col-sm-9">
                    <?php
                    $durationData = packageTourHelper::getDuration();
                    ?>
                    <select id="duration" name="duration" class="chosen-select">
                        <?php for($i=0;$i<count($durationData);$i++) { ?>
                            <option value="<?php echo $durationData[$i]; ?>"><?php echo $durationData[$i] . " day(s)"; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Price :</div>
                <div class="col-sm-9">
                    <input type="text" id="price" name="price" class="form-control" value="<?php echo $price; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 text-right">
                    <button type="submit" name="submitted" class="btn btn-default btn-success">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
       $(".chosen-select").chosen({width: "100%"});

        if ($('#package_id').length>0){
            $('#duration').val($('#selected_duration').val());
            $("#duration").trigger("chosen:updated");
        }

    });

    $("#package_tour").validate({
        rules: {
            title:
                {
                required: true
            },
            price:
                {
                required:true,
                number: true
            },
        },
        //set messages to appear inline
        messages:
            {
            title: "Please enter package tour title.",
            price:
                {
                required: "Please enter a price for package tour.",
                number: "Please enter a valid number for price."
            },
        }
    });
</script>

<?php include ('includes/footer.php'); ?>