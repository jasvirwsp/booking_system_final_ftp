<?php include('header.php'); ?>

    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Account</li>
                            </ul>
                            <h1 class="title">Profile</h1>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start My Account Area  -->
        <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp">
                    <div class="axil-dashboard-author">
                        <div class="media">
                            <!-- <div class="thumbnail">
                                <img src="./assets/images/product/author1.png" alt="Hello Annie">
                            </div> -->
                            <div class="media-body">
                                <h5 class="title mb-0">Welcome <?php echo $_SESSION["user_name"]; ?></h5>
                                <span class="joining-date">Member Since <?php echo date("M Y", strtotime($_SESSION["date_created"])); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-4">
                            <aside class="axil-dashboard-aside">
                                <nav class="axil-dashboard-nav">
                                    <div class="nav nav-tabs" role="tablist">
                                        <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard" role="tab" aria-selected="true"><i class="fas fa-th-large"></i>Dashboard</a>                                      
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account" role="tab" aria-selected="false"><i class="fas fa-user"></i>Account</a>
                                        <a class="nav-item nav-link" href="do-logout.php"><i class="fal fa-sign-out"></i>Logout</a>
                                    </div>
                                </nav>
                            </aside>
                        </div>
                        <div class="col-xl-9 col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                    <div class="axil-dashboard-overview">
                                        <div class="welcome-text">Your Bookings</div>
                                        <div class="axil-dashboard-order">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Table Size</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Satus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //fetch query of booking fetch #start
    $where_array_booking_fetch = array("booking_user_id"=>$_SESSION['user_id']);
    $options_array_booking_fetch = array();
    $results_booking_fetch = $records_fetch_controller->fetch_record_with_where(["booking",$where_array_booking_fetch,$options_array_booking_fetch]);
    $count_results_booking_fetch = count($results_booking_fetch);
    //Lets loop through 
                            foreach($results_booking_fetch as $single_result_booking_fetch){
                                $rec_id_booking_fetch = $single_result_booking_fetch["record_id"];                               
 ?>
<tr>
                                                        <th scope="row"><?php echo $single_result_booking_fetch["booking_party_size"]; ?> person</th>
                                                        <td><?php echo date('d M Y', strtotime($single_result_booking_fetch["booking_visit_date"])); ?></td>
                                                        <td><?php echo $single_result_booking_fetch["booking_visit_time"]; ?></td>
                                                        <td><?php echo title_case($single_result_booking_fetch["booking_status"]); ?></td>
                                                    </tr>
       <?php } 
//fetch query of booking  fetch #ends    

                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    </div>
                                </div>
                               
                                
                                <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                    <div class="axil-dashboard-address">
                                        <p class="notice-text">The following addresses will be used on the checkout page by default.</p>
                                        <div class="row row--30">
                                            <div class="col-lg-6">
                                                <div class="address-info mb--40">
                                                    <div class="addrss-header d-flex align-items-center justify-content-between">
                                                        <h4 class="title mb-0">Shipping Address</h4>
                                                        <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <ul class="address-details">
                                                        <li>Name: Annie Mario</li>
                                                        <li>Email: annie@example.com</li>
                                                        <li>Phone: 1234 567890</li>
                                                        <li class="mt--30">7398 Smoke Ranch Road <br>
                                                        Las Vegas, Nevada 89128</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="address-info">
                                                    <div class="addrss-header d-flex align-items-center justify-content-between">
                                                        <h4 class="title mb-0">Billing Address</h4>
                                                        <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <ul class="address-details">
                                                        <li>Name: Annie Mario</li>
                                                        <li>Email: annie@example.com</li>
                                                        <li>Phone: 1234 567890</li>
                                                        <li class="mt--30">7398 Smoke Ranch Road <br>
                                                        Las Vegas, Nevada 89128</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
//fetch query of users fetch #start
$where_array_users_fetch = array("id"=>$_SESSION['user_id']);
$options_array_users_fetch = array();
$results_users_fetch = $records_fetch_controller->fetch_record_with_where(["users",$where_array_users_fetch,$options_array_users_fetch]);
$count_results_users_fetch = count($results_users_fetch);
//fetch query of users  fetch #ends    



                                ?>
                                <div class="tab-pane fade" id="nav-account" role="tabpanel">
                                    <div class="col-lg-9">
                                        <div class="axil-dashboard-account">
                                            <form class="account-details-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control user_name" value="<?php echo get_single_value($results_users_fetch, 'user_name'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control email" value="<?php echo get_single_value($results_users_fetch, 'email'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="text" class="form-control user_contact_no" value="<?php echo get_single_value($results_users_fetch, 'user_contact_no'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group mb--40">
                                                            <label>Address</label>
                                                            <textarea class="form-control user_address"><?php echo get_single_value($results_users_fetch, 'user_address'); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group mb--0">
                                                            <input type="submit" class="axil-btn update_user" value="Save Changes">
                                                        </div>
                                                    </div>
                                                    <p class="error-message mt--10" style="color:#ef3f70;"></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Account Area  -->
    </main>
    <?php include('footer.php'); ?>
    <script>
        $(document).on('click', '.update_user', function(e){

            e.preventDefault();

            var user_name = $('.user_name').val();
            var email = $('.email').val();
            var user_contact_no = $('.user_contact_no').val();
            var user_address = $('.user_address').val();
            var access_token = "<?php echo $_SESSION['access_token']; ?>";

            $.ajax({
                method:"POST",
                url:"portal/api/user/m.update_user.php",
                data:{access_token:access_token,user_name:user_name,email:email,user_contact_no:user_contact_no,user_address:user_address},
                success: function(result){
                    result['response']['code'] == 401 ? $('.error-message').text(result['response']['message']) : $('.error-message').html('<span style="color:#00813b;">'+result['response']['message']+'</span>')
                }
            })

        })
    </script>