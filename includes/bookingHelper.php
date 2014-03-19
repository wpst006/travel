<?php

class bookingHelper{
    public static function getBooking($fromDate=null,$toDate=null,$customer=null){
        $filter='';
        $customerFilter=null;
        $dateFilter=null;
        
        if (isset($fromDate) || isset($toDate) || isset($customer)){
            $filter="WHERE ";
        }
        
        if (isset($customer)){
            $customerFilter="customers.firstname LIKE '%" . $customer . "%' ";            
        }
        
        if (isset($fromDate) && isset($toDate)){
            $dateFilter="bookings.booking_date BETWEEN '$fromDate' AND '$toDate' ";
        }
        
        if (isset($customerFilter) && isset($dateFilter)){
            $filter.=$customerFilter . " AND " . $dateFilter;
        }else if (isset($customerFilter)){
            $filter.=$customerFilter;
        }else if (isset($dateFilter)){
            $filter.=$dateFilter;
        }
        
        $sql = "SELECT bookings.*,customers.* " .
                "FROM bookings " .
                "INNER JOIN customers " . 
                "ON bookings.customer_id=customers.customer_id " .
                $filter . 
                "ORDER BY bookings.booking_date DESC";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'booking_id'=>$row['booking_id'],
                'booking_date'=>$row['booking_date'],
                'customer_id'=>$row['customer_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'total'=>$row['total'],                            
            );
        }
        
        return $output;
    }  
    
    public static function getBookingByBookingID($booking_id){
        $sql = "SELECT bookings.*,customers.* " .
                "FROM bookings " .
                "INNER JOIN customers " . 
                "ON bookings.customer_id=customers.customer_id " .
                "WHERE bookings.booking_id='" . $booking_id . "' " .
                "ORDER BY bookings.booking_date DESC";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'booking_id'=>$row['booking_id'],
                'booking_date'=>$row['booking_date'],
                'customer_id'=>$row['customer_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'total'=>$row['total'],                            
            );
        }
        
        return $output;
    }
    
    public static function getBookingDetailsByBookingID($booking_id){
        $sql = "SELECT * " .
                "FROM bookings_view " .                
                "WHERE bookings_view.booking_id='" . $booking_id . "' " .
                "ORDER BY bookings_view.booking_id";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'bookingdetail_id' =>$row['id'],
                'booking_id'=>$row['booking_id'],
                'package_id'=>$row['package_id'],
                'package_title'=>$row['title'],
                'duration'=>$row['duration'],
                'no_of_people'=>$row['no_of_people'],
                'price'=>$row['price']               
            );
        }
        
        return $output;
    }
}
?>
