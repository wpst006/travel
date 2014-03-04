<?php

class hotelHelper {

    public static function selectAll() {
        $sql = "SELECT * " .
                "FROM hotels " .
                "ORDER BY hotel_name";

        $result = mysql_query($sql) or die(mysql_error());

        if (mysql_num_rows($result) == 0) {
            return null;
        }

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'hotel_id' => $row['hotel_id'],
                'hotel_name' => $row['hotel_name'],
            );
        }

        return $output;
    }

    public static function getPackageTourHotelByPackageID($package_id) {
        $sql = "SELECT * " .
                "FROM packagetour_hotel " .
                "WHERE packagetour_id='" . $package_id . "' " .
                "ORDER BY hotel_id";

        $result = mysql_query($sql) or die(mysql_error());

        if (mysql_num_rows($result) == 0) {
            return null;
        }

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'id' => $row['id'],
                'hotel_id' => $row['hotel_id'],
                'packagetour_id' => $row['packagetour_id'],
            );
        }

        return $output;
    }

    public static function saveNew_packageTour_Hotel($hotel_id_array,$packagetour_id) {        
        for ($i = 0; $i < count($hotel_id_array); $i++) {
            $insertSQL = "INSERT INTO " .
                    "`packagetour_hotel`(hotel_id,packagetour_id) " .
                    "VALUES('$hotel_id_array[$i]','$packagetour_id')";

            mysql_query($insertSQL) or die(mysql_error());
        }

        return true;
    }

    public static function update_packageTour_Hotel($hotel_id_array,$packagetour_id) {
        $artist_songs_Delete_sql = "DELETE FROM `packagetour_hotel` " .
                "WHERE `packagetour_id`='" . $packagetour_id . "'";

        mysql_query($artist_songs_Delete_sql) or die(mysql_error());
        hotelHelper::saveNew_packageTour_Hotel($hotel_id_array,$packagetour_id);
        
        return true;
    }

//    public static function getHotelByHotelID($package_id) {
//        $sql = "SELECT packagetours.* " .
//                "FROM packagetours " .
//                "WHERE package_id='" . $package_id . "'";
//
//        $result = mysql_query($sql) or die(mysql_error());
//        
//        if (mysql_num_rows($result)==0){
//            return null;
//        }
//        
//        $row = mysql_fetch_array($result);        
//        
//        $output=array(
//            'package_id' => $row['package_id'],
//            'title' => $row['title'],
//            'duration' => $row['duration'],
//            'price' => $row['price'],
//        );
//        
//        return $output;        
//    }
}

?>
