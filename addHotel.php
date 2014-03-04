<?php include ('includes/includefiles.php'); ?>
<?php require_once('includes/packageTourHelper.php'); ?>
<?php require_once('includes/hotelHelper.php'); ?>

<?php
$title = '';
$duration = 1;
$price = 0.0;

if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $packageTourData = packageTourHelper::getPackageTourByPackageID($package_id);
    $title = $packageTourData['title'];
    $duration = $packageTourData['duration'];
    $price = $packageTourData['price'];
    
    $packageHotelData= hotelHelper::getPackageTourHotelByPackageID($package_id);
    
    $hotel_ids_string='';
    
    foreach ($packageHotelData as $key=>$hotel) {        
        $hotel_ids_string .= $hotel['hotel_id'] . ',';
    }
    //Remove last "comma" from the string
    $hotel_ids_string = rtrim($hotel_ids_string, ',');
}

if (isset($_POST['submitted'])) {
    $package_id=$_POST['package_id'];
    $hotel_id_array = $_POST['hotel_id'];
    
    $status=hotelHelper::update_packageTour_Hotel($hotel_id_array, $package_id);
    
    if ($status == true) {
        messageHelper::setMessage("Package tour is successfully saved.",MESSAGE_TYPE_SUCCESS);
        header("location:addHotel.php?package_id=" . $package_id);
    }
}
?>

<?php include ('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="addHotel" name="addHotel" action="addHotel.php?package_id=<?php echo $package_id; ?>" method="post" class="form-horizontal">

            <div class="form-group">
                <div class="col-sm-3 control-label">Package ID :</div>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $package_id; ?></p>
                    <input type="hidden" id="package_id" name="package_id" value="<?php echo $package_id; ?>" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Title :</div>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $title; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Duration :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $duration; ?>&nbsp;day(s)</p>
                </div>                            
            </div>             

            <div class="form-group">
                <div class="col-sm-3 control-label">Price :</div>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $price; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Hotel (s) :</label>
                <div class="col-sm-9">
                    <?php
                    $hotelData=hotelHelper::selectAll();
                    ?>
                    <select id="hotel_id" name="hotel_id[]" class="chosen-select" multiple="true" data-placeholder="Choose hotel(s) ...">
                        <?php foreach ($hotelData as $key=>$hotel) { ?>
                            <option value="<?php echo $hotel['hotel_id']; ?>"><?php echo $hotel['hotel_name']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="hotel_ids_string" name="hotel_ids_string" value="<?php echo $hotel_ids_string; ?>" />
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
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "100%"});    
        
        if ($('#hotel_ids_string').val()!=''){
            var hotel_ids_string=$('#hotel_ids_string').val();
            var temp=hotel_ids_string.split(",");
            var hotelIDArray=new Array();
            
            for (var i=0;i<temp.length;i++){
                hotelIDArray.push(temp[i]);
            }
            
            $('#hotel_id').val(hotelIDArray);
            $("#hotel_id").trigger("chosen:updated");
        }
    });
</script>

<?php include ('includes/footer.php'); ?>