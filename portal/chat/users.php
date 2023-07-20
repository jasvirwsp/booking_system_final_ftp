<?php 
include("../wsp_rad/wsp_rad.inc.php");
$wsp_auth->do_check_auth();
$_SESSION['user_id'];

?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
//fetch query of users fetch #start
$where_array_users_fetch = array("id"=>$_SESSION['user_id']);
$options_array_users_fetch = array();
$results_users_fetch = $records_fetch_controller->fetch_record_with_where(["users",$where_array_users_fetch,$options_array_users_fetch]);
$count_results_users_fetch = count($results_users_fetch);
//fetch query of users  fetch #ends    



            // $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = {$_SESSION['user_id']}");
            // if(mysqli_num_rows($sql) > 0){
            //   $row = mysqli_fetch_assoc($sql);
            // }
          ?>
          <img src="https://wspclients.com/psn_jasvir/uploads/upload_63888a7b082fd7811_group_2_(2).png" alt="">
          <div class="details">
            <span><?php echo get_single_value($results_users_fetch, 'user'); ?></span>
            <p><?php echo get_single_value($results_users_fetch, 'status'); ?></p>
          </div>
        </div>
        <!--<a href="php/logout.php?logout_id=<?php echo get_single_value($results_users_fetch, 'id'); ?>" class="logout">End Chat</a>-->
      </header>
      <div class="search">
        <span class="text">Select a user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
