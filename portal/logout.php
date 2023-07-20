<?php
include("wsp_rad/wsp_rad.inc.php");
session_start();

//update query of users users #start
$record_update_controller = new records_update_controller();
$record_type_users_users = "users";
$update_array_users_users = array(
    "status"=>"Offline now",
   "date_updated"=>generate_mysql_timestamp()
                            );
$where_array_users_users = array("id"=>$_SESSION['user_id']);
$update_record_users_users = $record_update_controller->update_record_with_new_values_and_where([$update_array_users_users,$where_array_users_users,$record_type_users_users]);
//update query of users  users #ends    

session_destroy();

$cookie->destroy("csrf");

header("Location: login.php");

?>