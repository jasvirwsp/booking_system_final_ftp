<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

//Check API Key
if(safe_post("booking_user_id")){
    $user_id = safe_post("booking_user_id");
}   else   {
    if (!$wsp_auth->check_access_token_m(safe_post("access_token"))) {
        $status_array = array("message" => "Sorry. Authentication Failed", "status" => "failure");
        $status_array_response["Response"] = $status_array;
        $response["response"] = $status_array;
        $final_json = json_encode($response);
        print_r($final_json);
        exit();
        } else {
        //Get User Details
        //Where array
        $where_array_user = array("access_token" => safe_post("access_token"));
        $results_user = $records_fetch_controller->fetch_record_with_where(["users", $where_array_user]);
        $count_results_user = count($results_user);
        $user_id = get_single_value($results_user, "id");
    }
}

$desk_meta = get_rec_meta_with_where("desk", ["desk_size" => safe_post("booking_party_size"), "desk_status" => "on"], ["limit" => 1]);
if (count($desk_meta) == 1) {
    $star_time = add_time_to_time(get_single_value($desk_meta, "desk_start_time"), "minutes", 0, "12");
    
    $end_time = get_single_value($desk_meta, "desk_closing_time");
    //Check Time
    if(strtotime(get_current_time()) < strtotime($end_time) && strtotime(get_current_time()) > strtotime(get_single_value($desk_meta, "desk_start_time"))){
    $visit_time = $star_time;
    $average_desk_time = get_single_value($desk_meta, "desk_time");
    $get_current_bookings = get_rec_meta_with_where("booking", ["booking_party_size" => safe_post("booking_party_size"), "date(date_created)" => get_today_date()], ["limit" => 1, "orderBy" => "record_id DESC"]);
    $is_manual_booking = "no";
    if (count($get_current_bookings) == 1) {
        $visit_time = add_time_to_time(get_single_value($get_current_bookings, "booking_visit_time"), "minutes", $average_desk_time, "12");
        if(safe_post("booking_visit_time") != ""){    
            $visit_time = safe_post("booking_visit_time");
            $visit_time = date("g:i a", strtotime($visit_time));
            $is_manual_booking = "yes";
        }
    }
    $visit_time = safe_post("booking_visit_time");
    
    //insert query of booking s #start
    $record_insert_controller = new records_insert_controller();
    $record_type_booking_s = "booking";
    $record_type_array_booking_s = array(
        "booking_user_id" => $user_id,
        "booking_visit_time" => $visit_time,
        "booking_is_manual"=>$is_manual_booking,
        "booking_visit_date" => safe_post("booking_visit_date"),
        "booking_party_size" => safe_post("booking_party_size"),
        "booking_special_requirements" => safe_post("booking_special_requirements"),
        "booking_status" => safe_post("booking_status"),
        "date_created" => generate_mysql_timestamp(),
        "date_updated" => generate_mysql_timestamp(),
        "booking_insert_author" => $user_id
    );
    $insert_record_booking_s = $record_insert_controller->insert_record([$record_type_array_booking_s, $record_type_booking_s]);
    $insert_id_booking_s = $insert_record_booking_s["record_id"];
    //insert query of booking  s #ends    
    $get_booking_meta = get_rec_meta_by_rec_id("booking", $insert_id_booking_s);
    $get_booking_meta[0]["date_created"] = beautify_date($get_booking_meta[0]["date_created"],"beauty");
    $response["response"] = ["status"=>"success","substatus"=>"booking_confirmed","booking_details"=>$get_booking_meta[0]];
    $response = json_encode($response);
    print_r($response);
        }  else  {
    $response["response"] = ["status"=>"failure","message"=>"Booking is not available or We are closed.","substatus"=>"timeout"];
    $response = json_encode($response);
    print_r($response);
    }
} else {
    $response["response"] = ["status"=>"failure","message"=>"There is no queue for selected party size. Come down, Be Quick","substatus"=>"no_queue"];
    $response = json_encode($response);
    print_r($response);
}
