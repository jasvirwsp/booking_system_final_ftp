<?php
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");


//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
	"record_id"=>"required"
);
$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input);

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
foreach($_POST as $parameter_key=>$parameter_value){

if(!in_array($parameter_key,$exclude_parameter_array)){
$post_parameter_array[$parameter_key] = "normal_safe_input";
}

}

$has_errors = $pass_validation->pass_user_input($post_parameter_array);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}
//Validation Ends


$array_controller = new array_resolver_controller();
$record_id = $_POST["record_id"];

foreach($_POST as $form_input_name => $form_input_value){
	// Inser Array
	if(is_array($form_input_value)){
		$form_input_value = implode(",",$form_input_value);
	}

	$updated_values = array(
	"meta_value"=>$form_input_value
	);

	$where_array = array(
	"record_id"=>$record_id,
	"meta_name"=>$form_input_name
	);

	$update_meta->update_meta_with_new_values_and_where($updated_values,$where_array);


}
$response = array("status"=>"success","message"=>"Update Success","record_id"=>$record_id);
	$response = json_encode($response);
	print_r($response);
?>
