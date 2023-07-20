<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");


//Check API Key
if(safe_post("booking_user_id")){
    $user_id = safe_post("booking_user_id");
}else{
// if (!$wsp_auth->check_access_token_m(safe_post("access_token"))) {
//     $status_array = array("message" => "Sorry. Authentication Failed", "status" => "failure");
//     $status_array_response["Response"] = $status_array;
//     $response["response"] = $status_array;
//     $final_json = json_encode($response);
//     print_r($final_json);
//     exit();
// } else {
//     //Get User Details
//     //Where array
//     $where_array_user = array("access_token" => safe_post("access_token"));
//     $results_user = $records_fetch_controller->fetch_record_with_where(["users", $where_array_user]);
//     $count_results_user = count($results_user);
//     $user_id = get_single_value($results_user, "id");
// }
}

$desk_meta = get_rec_meta_with_where("desk", ["desk_size" => safe_post("booking_party_size"), "desk_status" => "on"], ["limit" => 1]);
if (count($desk_meta) == 1) {
   $response_array["response"] = ["status" => "on"];

    $response = json_encode($response_array);
    print_r($response);
   

} else {
    $response["response"] = ["status"=>"off"];
    $response = json_encode($response);
    print_r($response);
}
