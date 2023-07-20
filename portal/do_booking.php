<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require("wsp_rad/wsp_rad.inc.php");

$party_size = safe_post("booking_party_size");
$party_date = safe_post("booking_visit_date");
$party_time = safe_post("booking_visit_time_hour"). ":". safe_post("booking_visit_time_minutes");
$sitting_time = 0;
$booking_status = "Confirmed";
if($party_size <= 2){
    $sitting_time = get_setting("1_2_sitting_time");
}
if($party_size <= 6 && $party_size >= 3){
    $sitting_time = get_setting("3_6_sitting_time");
}
if($party_size <= 14 && $party_size >= 7){
    $sitting_time = get_setting("7_14_sitting_time");
}
if($party_size >= 15){
    $sitting_time = get_setting("15_plus_sitting_time");
}
if($party_size > 5){
    $booking_status = "Unconfirmed";
}

$booking_slots = timeRanges($party_time, add_time_to_time_without_am_pm($party_time,"minutes",$sitting_time), 15);
$booking_slots = implode(",",$booking_slots);

if($party_size != "" && $party_date != ""){    
    $current_party_size = $party_size;
$booking_id = 0;
    do{
if($current_party_size > 2){
 //fetch query of desk d #start
 $where_array_desk_d = array("desk_size"=>4);
 $options_array_desk_d = array();
 $results_desk_d = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_d,$options_array_desk_d]);
 $count_results_desk_d = count($results_desk_d); 
//fetch query of desk  d #ends    

// Loop all desk 
$slot_available = false;
$available_desk_id = 0;
foreach($results_desk_d as $single_desk){
//fetch query of booking_desk s #start
$where_array_booking_desk_s = array("booking_desk_party_size"=>4,"booking_desk_desk_id"=>$single_desk["record_id"],"booking_desk_date"=>$party_date,"CONCAT(',',booking_desk_slots,',') LIKE ?" => "%,".$party_time.",%");
$options_array_booking_desk_s = array();
$results_booking_desk_s = $records_fetch_controller->fetch_record_with_where(["booking_desk",$where_array_booking_desk_s,$options_array_booking_desk_s]);
// beautify_array($where_array_booking_desk_s);
$count_results_booking_desk_s = count($results_booking_desk_s);
//fetch query of booking_desk  s #ends    
if($count_results_booking_desk_s == 0){
    // echo "test";
    $slot_available = true;
    $available_desk_id = $single_desk["record_id"];
    break;
}
}
if($slot_available && $available_desk_id != 0){
//Create booking
if($booking_id == 0){
    //insert query of booking s #start
$record_insert_controller = new records_insert_controller();
$record_type_booking_s = "booking";
$record_type_array_booking_s = array(
    "booking_user_id"=>0,
    "booking_visit_time"=>$party_time,
    "booking_visit_date"=>$party_date,
    "booking_party_size"=>$party_size,
    "booking_remarks"=>"",
    "booking_status"=>$booking_status,
    "booking_duration"=>$sitting_time,
    "booking_leave_time"=>add_time_to_time_without_am_pm($party_time,"minutes",$sitting_time),
    "booking_name"=>safe_post("booking_name"),
    "booking_email"=>safe_post("booking_email"),
    "booking_special_requirements"=>safe_post("booking_special_requirements"),
    "booking_phone"=>safe_post("booking_phone"),
    "booking_slots"=>$booking_slots,
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
                            );
$insert_record_booking_s = $record_insert_controller->insert_record([$record_type_array_booking_s,$record_type_booking_s]);
$insert_id_booking_s = $insert_record_booking_s["record_id"];
//insert query of booking  s #ends    
$booking_id = $insert_id_booking_s;
}

//insert query of booking_desk d #start
$record_insert_controller = new records_insert_controller();
$record_type_booking_desk_d = "booking_desk";
$record_type_array_booking_desk_d = array(
    "booking_desk_booking_id"=>$booking_id,
    "booking_desk_desk_id"=>$available_desk_id,
    "booking_desk_start_time"=>$party_time,
    "booking_desk_end_time"=>add_time_to_time_without_am_pm($party_time,"minutes",$sitting_time),
    "booking_desk_duration"=>$sitting_time,
    "booking_desk_party_size"=>4,
    "booking_desk_date"=>$party_date,
    "booking_desk_status"=>$booking_status,
    "booking_desk_slots"=>$booking_slots,
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
                            );
$insert_record_booking_desk_d = $record_insert_controller->insert_record([$record_type_array_booking_desk_d,$record_type_booking_desk_d]);
$insert_id_booking_desk_d = $insert_record_booking_desk_d["record_id"];
//insert query of booking_desk  d #ends    

}

$current_party_size = $current_party_size - 4;

}else if($current_party_size == 1 || $current_party_size == 2){
    //fetch query of desk d #start
    $where_array_desk_d = array("desk_size"=>2);
    $options_array_desk_d = array();
    $results_desk_d = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_d,$options_array_desk_d]);
    $count_results_desk_d = count($results_desk_d); 

// Loop all desk for 2
$slot_available = false;
$available_desk_id = 0;
foreach($results_desk_d as $single_desk){
//fetch query of booking_desk s #start
$where_array_booking_desk_s = array("booking_desk_party_size"=>2,"booking_desk_desk_id"=>$single_desk["record_id"],"booking_desk_date"=>$party_date,"CONCAT(',',booking_desk_slots,',') LIKE ?" => "%,".$party_time.",%");
$options_array_booking_desk_s = array();
$results_booking_desk_s = $records_fetch_controller->fetch_record_with_where(["booking_desk",$where_array_booking_desk_s,$options_array_booking_desk_s]);
// beautify_array($where_array_booking_desk_s);
$count_results_booking_desk_s = count($results_booking_desk_s);
//fetch query of booking_desk  s #ends    
if($count_results_booking_desk_s == 0){
    // echo "test 2";
    $slot_available = true;
    $available_desk_id = $single_desk["record_id"];
    break;
}
}
   //fetch query of desk  d #ends    
   if($slot_available && $available_desk_id != 0){
    //Create booking
if($booking_id == 0){
   
    //insert query of booking s #start
$record_insert_controller = new records_insert_controller();
$record_type_booking_s = "booking";
$record_type_array_booking_s = array(
    "booking_user_id"=>0,
    "booking_visit_time"=>$party_time,
    "booking_visit_date"=>$party_date,
    "booking_party_size"=>$party_size,
    "booking_remarks"=>"",
    "booking_status"=>$booking_status,
    "booking_duration"=>$sitting_time,
    "booking_leave_time"=>add_time_to_time_without_am_pm($party_time,"minutes",$sitting_time),
    "booking_name"=>safe_post("booking_name"),
    "booking_email"=>safe_post("booking_email"),
    "booking_special_requirements"=>safe_post("booking_special_requirements"),
    "booking_phone"=>safe_post("booking_phone"),
    "booking_slots"=>$booking_slots,
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
                            );
$insert_record_booking_s = $record_insert_controller->insert_record([$record_type_array_booking_s,$record_type_booking_s]);
$insert_id_booking_s = $insert_record_booking_s["record_id"];
//insert query of booking  s #ends    
$booking_id = $insert_id_booking_s;
}
   //insert query of booking_desk d #start
   $record_insert_controller = new records_insert_controller();
   $record_type_booking_desk_d = "booking_desk";
   $record_type_array_booking_desk_d = array(
       "booking_desk_booking_id"=>$booking_id,
       "booking_desk_desk_id"=>$available_desk_id,
       "booking_desk_start_time"=>$party_time,
       "booking_desk_end_time"=>add_time_to_time_without_am_pm($party_time,"minutes",$sitting_time),
       "booking_desk_duration"=>$sitting_time,
       "booking_desk_party_size"=>2,
       "booking_desk_date"=>$party_date,
       "booking_desk_status"=>$booking_status,
       "booking_desk_slots"=>$booking_slots,
       "date_created"=>generate_mysql_timestamp(),
       "date_updated"=>generate_mysql_timestamp(),
                               );
   $insert_record_booking_desk_d = $record_insert_controller->insert_record([$record_type_array_booking_desk_d,$record_type_booking_desk_d]);
   $insert_id_booking_desk_d = $insert_record_booking_desk_d["record_id"];
   //insert query of booking_desk  d #ends    
   
   }
   
   $current_party_size = $current_party_size - 2;
   
   }


    }while($current_party_size > 0);

 

}

$response = array("status"=>"success","message"=>"Booking Success");
	//Hook
	//after_insert_desk($_POST,$response,$record_type);
	//Hook
    $responsee["response"] = $response;  
	$final = json_encode($responsee);
	print_r($final);
   

?>