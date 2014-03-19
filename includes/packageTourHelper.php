<?php

require_once('hotelHelper.php');

class packageTourHelper {

    public static function selectAll() {
        $sql = "SELECT packagetours.* " .
                "FROM packagetours " .
                "ORDER BY package_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $hotelData = hotelHelper::getPackageTourHotelByPackageID($row['package_id']);

            $hotel_string = '';

            foreach ($hotelData as $hotel) {
                $hotel_string.=$hotel['hotel_name'] . ", ";
            }

            if ($hotel_string == '') {
                $hotel_string = "No Hotel";
            }

            //Remove last "comma" from the string
            $hotel_string = rtrim($hotel_string, ', ');

            $output[] = array(
                'package_id' => $row['package_id'],
                'title' => $row['title'],
                'duration' => $row['duration'],
                'hotel' => $hotel_string,
                'price' => $row['price'],
            );
        }

        return $output;
    }

    public static function getDuration() {
        $arr = array();

        for ($i = 1; $i < 10; $i++) {
            $arr[] = $i;
        }

        return $arr;
    }

    public static function getPackageTourByPackageID($package_id) {
        $sql = "SELECT packagetours.* " .
                "FROM packagetours " .
                "WHERE package_id='" . $package_id . "'";

        $result = mysql_query($sql) or die(mysql_error());

        if (mysql_num_rows($result) == 0) {
            return null;
        }

        $row = mysql_fetch_array($result);

        $output = array(
            'package_id' => $row['package_id'],
            'title' => $row['title'],
            'duration' => $row['duration'],
            'price' => $row['price'],
        );

        return $output;
    }

}

?>
