<?php 
include("../wsp_rad/wsp_rad.inc.php");
if($wsp_auth->do_check_auth()){
  $status = "Active now";
  $status_time = date('m-d-Y h:i:s', time());

  //update query of users update #start
$record_update_controller = new records_update_controller();
$record_type_users_update = "users";
$update_array_users_update = array(
  "status"=>$status,
  "chat_status_time"=>$status_time,
   "date_updated"=>generate_mysql_timestamp()
                            );
$where_array_users_update = array("id"=>$_SESSION['user_id']);
$update_record_users_update = $record_update_controller->update_record_with_new_values_and_where([$update_array_users_update,$where_array_users_update,$record_type_users_update]);
//update query of users  update #ends    

}
  // if(isset($_SESSION['user_id'])){
  //   header("location: users.php");
  // }
  if($wsp_auth->do_check_auth()){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Chat App</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
