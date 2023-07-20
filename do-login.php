<?php 
if(isset($_POST['access_token'])){
include("portal/wsp_rad/wsp_rad.inc.php");
   $access_token = $_POST['access_token'];

    //fetch query of users login #start
    $where_array_users_login = array("access_token"=>$access_token);
    $options_array_users_login = array();
    $results_users_login = $records_fetch_controller->fetch_record_with_where(["users",$where_array_users_login,$options_array_users_login]);
    $count_results_users_login = count($results_users_login);
//fetch query of users  login #ends
//print_r($results_users_login);

    session_start();
   $id = get_single_value($results_users_login, 'id');
   $user_name = get_single_value($results_users_login, 'user_name');
   $email = get_single_value($results_users_login, 'email');
   $created_date = get_single_value($results_users_login, 'date_created');

   $_SESSION["user_id"] = $id;
   $_SESSION["user_name"] = $user_name;
   $_SESSION["date_created"] = $created_date;
   $_SESSION['access_token'] = $access_token;

   echo "success";
} 

?>