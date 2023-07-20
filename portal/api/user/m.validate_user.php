<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");


//fetch query of user s #start
$where_array_user_s = array("email"=>safe_post("email"));
$options_array_user_s = array();
$results_user_s = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user_s,$options_array_user_s]);
$count_results_user_s = count($results_user_s);
//fetch query of user  s #ends    
$user_meta = [];
if($count_results_user_s == 1){
    $user_meta = $results_user_s[0];
    $user_id = $user_meta["id"];
    $user_access_token = $user_meta["access_token"];
    if($user_access_token == ""){    
    $new_access_token = uniqid("wsp_").rand(22222,999999);
//update query of user s #start
$record_update_controller = new records_update_controller();
$record_type_user_s = "users";
$update_array_user_s = array(
    "access_token"=>$new_access_token
                            );
$where_array_user_s = array("id"=>$user_id);
$update_record_user_s = $record_update_controller->update_record_with_new_values_and_where([$update_array_user_s,$where_array_user_s,$record_type_user_s]);
//update query of user  s #ends    
$user_access_token = $new_access_token;
$new_user_meta = get_user_meta_with_user_id($user_id);
$user_meta = $new_user_meta[0];
}

}else{
    $new_access_token = uniqid("wsp_").rand(22222,999999);
    //insert query of user s #start
$record_insert_controller = new records_insert_controller();
$record_type_user_s = "users";
$record_type_array_user_s = array(
    // "user_name"=>safe_post("user_name"),
    // "user"=>safe_post("email"),    
    "email"=>safe_post("email"),
    // "password"=>password_hash(safe_post("password"),PASSWORD_DEFAULT),
    "role"=>"user",
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
    "access_token" => $new_access_token
                            );
$insert_record_user_s = $record_insert_controller->insert_record([$record_type_array_user_s,$record_type_user_s]);
$insert_id_user_s = $insert_record_user_s["record_id"];
//insert query of user  s #ends    
$new_user_meta = get_user_meta_with_user_id($insert_id_user_s);
// beautify_array($new_user_meta);
$user_meta = $new_user_meta[0];
}

$nest["user_name"] = $user_meta["user_name"];
$nest["email"] = $user_meta["email"];
$nest["access_token"] = $user_meta["access_token"];
$nest["id"] = $user_meta["id"];
$response_array["login_detail"] = $nest;
    $response = $response_array;
    $status_array = array("status"=>"success","code"=>"200");
   
    $response["response"] = $status_array;    
    $final_json = json_encode($response);
    print_r($final_json);

    ?>