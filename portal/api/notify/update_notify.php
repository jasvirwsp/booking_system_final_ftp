<?php
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");


$record_type = "notify";

//Permission Check
session_start();
check_record_ownership("update",$_SESSION["user_id"], $_SESSION["role"], $record_type, safe_post("record_id"));
//Permission Check

//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
	"record_id"=>"required"
);

//Select all matching post parameters
$regex_user_input = array();

$regex_input_array = array();
if($regex_user_input){
foreach($regex_user_input as $regex_input_name=>$regex_input_validations){
	$matching_inputs = preg_grep("/$regex_input_name/i",array_keys($_POST));
	foreach($matching_inputs as $meta_key_name){
		$regex_input_array[] = $meta_key_name;
		$user_input[$meta_key_name] = $regex_input_validations;
	}
}
}

$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}

//Pass all inputs against XSS and Sqli
$post_parameter_array = array();
// To exclude XSS and Sqli Protection on certain parameter.
$exclude_parameter_array = array(

);

//Get meta keys of record type
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
if($regex_input_array){
	$meta_keys_array = array_merge($meta_keys_array,$regex_input_array);
}

foreach($_POST as $parameter_key=>$parameter_value){

if(!in_array($parameter_key,$exclude_parameter_array)){
$post_parameter_array[$parameter_key] = "normal_safe_input";
}

//Check if its allowed meta_key

if(!in_array($parameter_key,$meta_keys_array)){
	$response = array("status"=>"failure","errors"=>array($parameter_key." is not a allowed meta"));
	$response = json_encode($response);
	print_r($response);
	exit();
}


}

$has_errors = $pass_validation->pass_user_input($post_parameter_array,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}
//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_updated"] = $timestamp;
//timestamps

$record_id = $_POST["record_id"];
$update_record = new records_update_controller();
//remove record id from $_POST
unset($_POST["record_id"]);

	$where_array = array(
	"record_id"=>$record_id
	);
//Hook
//before_update_notify($_POST,$where_array,$record_type);
//Hook
//Get meta keys of record type and prepare update_array for updating
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
//unset record_id key
unset($meta_keys_array[0]);
$update_record_array = array("date_updated"=>$_POST["date_updated"]);
foreach($meta_keys_array as $single_allowed_meta_key){
	if(isset($_POST[$single_allowed_meta_key])){
		if(is_array($_POST[$single_allowed_meta_key])){
			$implode_array = implode(",",$_POST[$single_allowed_meta_key]);
			$update_record_array[$single_allowed_meta_key] = $implode_array;
		}else{
	$update_record_array[$single_allowed_meta_key] = $_POST[$single_allowed_meta_key];
		}
		}
}

$update_record->update_record_with_new_values_and_where([$update_record_array,$where_array,$record_type]);
	
$response = array("status"=>"success","message"=>"Update Success","record_id"=>$record_id);
//Hook
//after_update_notify($_POST,$response,$record_type);
//Hook
	$response = json_encode($response);
	print_r($response);
?>
