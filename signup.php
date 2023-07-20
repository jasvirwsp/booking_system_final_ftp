<?php
session_start();
if(isset($_SESSION["user_id"])){
    die("error in process");
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Table Booking</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/vendor/sal.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/vendor/base.css">
    <link rel="stylesheet" href="assets/css/style.min.css">

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="index.php" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="login.php" class="axil-btn btn-bg-secondary sign-up-btn">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                
                </div>
            </div>
            
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Create an Account</h3>
                        <form class="singin-form">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control username" name="username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control password" name="password">
                            </div>
<?php if(isset($_POST['add-booking-guest'])) { 
    ?>
                            <span class="title-highlighter highlighter-primary2">Party Size  &nbsp&nbsp<u><?php echo $_POST['booking_party_size']; ?> Person</u></span>
                            <span class="title-highlighter highlighter-primary2">Date  &nbsp&nbsp<u> <?php echo date('d M Y', strtotime($_POST['booking_visit_date'])); ?></u></span>
                            <span class="title-highlighter highlighter-primary2">Time  &nbsp&nbsp<u> <?php echo $_POST['booking_visit_time']; ?></u></span>
<?php } ?>
                            <p class="error-message" style="color:#ef3f70;"></p>
                            <?php if(isset($_POST['add-booking-guest'])) { 
    ?>
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn create-account-with-booking">Confirm Booking</button>
                            </div>
                           
                            <?php } else { ?>
                                <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn create-account">Create Account</button>
                            </div>
                          <?php  } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/sal.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/counterup.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>
<script>
$(document).on("click",".create-account",function(e) {
    e.preventDefault();

    var username = $('.username').val();
    var email = $('.email').val();
    var password = $('.password').val();
if(username == "" || username == "" || email == ""){
    $('.error-message').text('required fields empty!');
} else {
    $.ajax({
        type: "POST",
        data: {user_name:username,password:password,email:email},
        url: "portal/api/user/m.signup.php", 
        success: function(result){
console.log(result)
result['response']['code'] == 200 ? $.ajax({ type: "POST", url: "portal/api/user/m.validate_user.php", data: {email:email}, success: function(response){ response['response']['code'] == 200 ? $.ajax({ type: "POST", url: "do-login.php", data: {access_token:response['login_detail']['access_token']}, success: function(output) { output == "success" ? window.location.href = 'index.php' : alert('errors in login')  } }) : alert('errors in validate')  } }) : $('.error-message').text(result['response']['message'])
    

             }
        });
    }
});

$(document).on("click",".create-account-with-booking",function(event) {
    event.preventDefault();

    var username = $('.username').val();
    var email = $('.email').val();
    var password = $('.password').val();
if(username == "" || username == "" || email == ""){
    $('.error-message').text('required fields empty!');
} else {

    var booking_visit_time = "<?php echo isset($_POST['booking_visit_time']) ? $_POST['booking_visit_time'] : "" ?>";
        var booking_visit_date = "<?php echo isset($_POST['booking_visit_date']) ? $_POST['booking_visit_date'] : "" ?>";
        var booking_party_size = "<?php  echo isset($_POST['booking_party_size']) ? $_POST['booking_party_size'] : "" ?>";
        var booking_duration = "<?php  echo isset($_POST['booking_duration']) ? $_POST['booking_duration'] : "" ?>";

    $.ajax({
        type: "POST",
        data: {user_name:username,password:password,email:email},
        url: "portal/api/user/m.signup.php", 
        success: function(result){
console.log(result)
result['response']['code'] == 200 ? $.ajax({ type: "POST", url: "portal/api/user/m.validate_user.php", data: {email:email}, success: function(response){ response['response']['code'] == 200 ? $.ajax({ type: "POST", url: "do-login.php", data: {access_token:response['login_detail']['access_token']}, success: function(output) { output == "success" ? 

            $.ajax({
            method:'post',
            url:'portal/api/booking/m.insert_booking.php',
            data:{booking_visit_time:booking_visit_time,booking_visit_date:booking_visit_date,booking_party_size:booking_party_size,access_token:response['login_detail']['access_token'],booking_status:'confirm',booking_special_requirements:"Nothing",booking_duration:booking_duration},
            success: function(result){
                result['response']['status'] == 'failure' ? $('.error-message').text(result['response']['message']) : window.location.href = 'account.php' 
                "";
            }
        })

   // window.location.href = 'index.php'
    
    : alert('errors in login')  } }) : alert('errors in validate')  } }) : $('.error-message').text(result['response']['message'])
    

             }
        });
    }
});
</script>