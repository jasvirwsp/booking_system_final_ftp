<?php
$part_size = 9;
$desk_array = array();
$booking_status = "confirm";

$four_table_count = 4;
$two_table_count = 2;

$resturent_open_time = "09:00";
$resturent_close_time = "23:00";

$setting_time = 150;

$assigned_four_table = 0;
$assigned_two_table = 0;

$number_of_persons = $part_size/2;
if(is_float($number_of_persons)){
    $number_of_persons = $part_size + 1;
} else {
    $number_of_persons = $part_size;
}

if(is_float($number_of_persons/4)){

  $rq_four_table = floor($number_of_persons/4);

    if($rq_four_table >= $four_table_count) {

        $avliable_setting = (($four_table_count*4) + ($two_table_count*2));

        if($avliable_setting >= $number_of_persons) {

            if($four_table_count == 0){
                if(($number_of_persons/2) <= $two_table_count) {
                    $assigned_two_table = $number_of_persons/2;
                    $booking_status = "confirm";
                } else {
                    $booking_status = "Not confirm";
                }
            } else {

                $assigned_four_table =  $four_table_count;

                $left_persons = $number_of_persons - ($four_table_count*4);

                $assigned_two_table = $left_persons/2;

                $booking_status = "confirm";
            }

        } else {
            $booking_status = "Not confirm";
        }

        

    } else {

        if($two_table_count != 0){
        $assigned_four_table = floor($number_of_persons/4);
        $assigned_two_table = 1;
        $booking_status = "confirm";

        } else {

            if($four_table_count != 0){
                $assigned_two_table = 0;
                $assigned_four_table = ceil($number_of_persons/4);
                $booking_status = "confirm";
            } else {
                $assigned_two_table = 0;
                $assigned_four_table = 0;
                $booking_status = "Not confirm";
            }

        }
    }

} else {
    
   // $assigned_four_table = $number_of_persons/4;
    
    if($assigned_four_table >= $four_table_count) {
    
        
        if(($number_of_persons/2) <= $two_table_count) {
            $assigned_two_table = $number_of_persons/2;
            $booking_status = "confirm";
        } else {
            $assigned_four_table == 0;
            $assigned_two_table == 0;
            $booking_status = "Not confirm";
        }

    } else {
        $assigned_four_table = $number_of_persons/4;
    }
}

echo "four table - ".$assigned_four_table."<br>";
echo "two table - ".$assigned_two_table."<br>";
echo $booking_status."<br>";

if($booking_status == "confirm"){
    $desk_array['4_person'] = $assigned_four_table;
    $desk_array['2_person'] = $assigned_two_table;
    $desk_array['status'] = $booking_status;
    //$desk_array['arrivel_time'] = $booking_status;
}

print_r($desk_array);

?>