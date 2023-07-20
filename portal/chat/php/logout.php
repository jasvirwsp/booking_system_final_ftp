<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $status_time = date('Y-m-d h:i:s');
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}', chat_status_time = '{$status_time}' WHERE id = {$_GET['logout_id']}");
            if($sql){
                // session_unset();
                // session_destroy();
                 header("location: ../../userpanel.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>