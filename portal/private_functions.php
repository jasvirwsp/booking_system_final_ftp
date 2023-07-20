<?php
include("wsp_rad/wsp_rad.inc.php");

$function_to_call = safe_get("fn");

//#How to use : Create a function like snippet below, while making call to a function url will be like ?fn=your_function_name and GET Parameters like ?fn=do_this&param1=test . in the function you will have the access to parameters like param1 directly. 

// function function_name($parameters){
// return ""   ;
// }

function update_desk($parameters){
    //update query of desk s #start
$record_update_controller = new records_update_controller();
$record_type_desk_s = "desk";
$update_array_desk_s = array(
    "desk_status"=>$parameters["status"]
                            );
$where_array_desk_s = array("desk_size"=>$parameters["party_size"]);
$update_record_desk_s = $record_update_controller->update_record_with_new_values_and_where([$update_array_desk_s,$where_array_desk_s,$record_type_desk_s]);
//update query of desk  s #ends    

return "updated"   ;
}

function update_messages($parameters){
    session_start();
    //update query of desk s #start
$record_update_controller = new records_update_controller();
$record_type_desk_s = "messages";
$update_array_desk_s = array(
    "status"=>'read'
                            );
$where_array_desk_s = array("incoming_msg_id"=>$parameters["user_id"]);
$update_record_desk_s = $record_update_controller->update_record_with_new_values_and_where([$update_array_desk_s,$where_array_desk_s,$record_type_desk_s]);
//update query of desk  s #ends    

return "updated"   ;
}


function check_messages($parameters){
    
    $unread = get_rec_meta_with_where("messages", ["incoming_msg_id" => $parameters["user_id"], "status" => "unread"],[]);   

return count($unread)   ;
}



if(isset($_GET["fn"])){
    $function = safe_get("fn");
    $return_value = $function($_GET);
    echo $return_value;
}
?>