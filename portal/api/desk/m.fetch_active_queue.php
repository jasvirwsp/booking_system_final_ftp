<?php
header("Access-Control-Allow-Origin: *");
require("../../wsp_rad/wsp_rad.inc.php");
header('Content-Type: application/json');

$where_array_desk_s = array("desk_status" => "on");
$results_desk_s_count = $records_fetch_controller->fetch_count_by_record_type_and_where_array(["desk", $where_array_desk_s]);
//fetch query of desk  s #ends    
if ($results_desk_s_count > 0) {
    $response_array["response"] = ["status" => "on"];

    $response = json_encode($response_array);
    print_r($response);
} else {
    $response_array["response"] = ["status" => "off"];

    $response = json_encode($response_array);
    print_r($response);
}
