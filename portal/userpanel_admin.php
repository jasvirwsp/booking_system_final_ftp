<?php include("header.php"); ?>
<style>
    .booking-div {
        display: flex;
        justify-content: space-between;
    }

    .details-div {
        display: flex;
        justify-content: space-between;
        background: #183672;
        margin: 0px;
        padding: 15px 10px;
        border-radius: 5px;
        color: #ffffff;
    }

    .details-div a {
        font-weight: 600;
        text-decoration: none;
        color: #ffffff;
    }

    .modal-open .select2-container--open {
        z-index: 999999 !important;
        width: 100% !important;
    }
</style>

<body>
<?php 
$colors_array = [];
function get_color($booking_id){
    global $colors_array;
if(isset($colors_array[$booking_id])){
    return $colors_array[$booking_id];
}else{
    $colors_array[$booking_id] = generate_random_color();
    return $colors_array[$booking_id];
}
}
?>
    <!-- Begin page -->
    <div id="wrapper" data-barba="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("left_sidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page" data-barba="container" data-barba-namespace="home">
            <div class="content">

                <!-- Topbar Start -->
                <?php include("topbar.php"); ?>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Welcome, <?php echo get_single_value($user_meta, "user_name", "title"); ?>
                                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_booking"><i class="fe-plus"></i> Add <?php echo beautify_meta_name(title_case("booking")); ?></button> <a href="userpanel_admin.php" class="btn btn-warning text-dark btn-sm"><i class="fe-refresh-cw"></i></a> -->
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-sm-12 bg-dark mb-3 rounded">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-white p-2 rounded text-center">
                                        <span class="mr-2"><?php echo beautify_date(get_today_date(), "beauty"); ?></span>
                                        <span class="current_time text-warning"><?php echo get_current_time(); ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Col 1 -->

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-responsive">
                                <tr class="bg-dark text-white">
                                    <td>Table</td>
                                    <td>Covers</td>
                                    <?php
                                    $start_time_setting = "12:00";
                                    $end_time_setting = "21:30";

                                    $timeIntervals = timeRanges($start_time_setting, $end_time_setting, 15);
                                    foreach ($timeIntervals as $single_interval) {
                                        echo "<td>".$single_interval ." - ". add_time_to_time_without_am_pm($single_interval,"minutes",15)."</td>";
                                    }
                                    ?>
                                </tr>
                                
                                    <?php 
                                    //fetch query of desk s #start
    $where_array_desk_s = array("desk_name != ?"=>"");
    $options_array_desk_s = array();
    $results_desk_s = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_s,$options_array_desk_s]);
    $count_results_desk_s = count($results_desk_s);
    //Lets loop through 
                            foreach($results_desk_s as $single_result_desk_s){
                                $rec_id_desk_s = $single_result_desk_s["record_id"];                               
 ?>
 <tr>
<td><?php echo $single_result_desk_s["desk_name"]; ?></td>
                                    <td><?php echo $single_result_desk_s["desk_size"]; ?></td>
                                    <?php
                                    $start_time_setting = "12:00";
                                    $end_time_setting = "21:30";

                                    $timeIntervals = timeRanges($start_time_setting, $end_time_setting, 15);
                                    $bookings_meta_array = []; 
                                    foreach ($timeIntervals as $single_interval) {
     
    //fetch query of booking_desk  #start
    $where_array_booking_desk_ = array("booking_desk_desk_id"=>$rec_id_desk_s,"CONCAT(',',booking_desk_slots,',') LIKE ?" => "%,".$single_interval.",%","booking_desk_date"=>get_today_date());
    $options_array_booking_desk_ = array();
    $results_booking_desk_ = $records_fetch_controller->fetch_record_with_where(["booking_desk",$where_array_booking_desk_,$options_array_booking_desk_]);
    $count_results_booking_desk_ = count($results_booking_desk_);
//fetch query of booking_desk   #ends    

 
//fetch query of booking_desk  d #ends
   
if($count_results_booking_desk_ == 1){
    $booking_status_color = "#".get_color($results_booking_desk_[0]["booking_desk_booking_id"]);
    if($results_booking_desk_[0]["booking_desk_status"] == "Unconfirmed"){
        $booking_status_color = "#f7b84b";
    }
    $booking_meta = [];
    if(isset($bookings_meta_array[$results_booking_desk_[0]["booking_desk_booking_id"]])){
        $booking_meta =  $bookings_meta_array[$results_booking_desk_[0]["booking_desk_booking_id"]];
    }else{
        $bookings_meta_array[$results_booking_desk_[0]["booking_desk_booking_id"]] = get_rec_meta_by_rec_id("booking",$results_booking_desk_[0]["booking_desk_booking_id"]);
        $booking_meta =  $bookings_meta_array[$results_booking_desk_[0]["booking_desk_booking_id"]];
    }
    
    // $colspan = $results_booking_desk_[0]["booking_desk_duration"] / 15;
    ?>
    <td onclick="window.location='edit_booking.php?booking_id=<?php echo $results_booking_desk_[0]["booking_desk_booking_id"]; ?>'" data-toggle="tooltip" data-placement="top" data-html="true" style="cursor:pointer;background-color: <?php echo $booking_status_color; ?>!important;" title="Name : <?php echo get_single_value($booking_meta,"booking_name"); ?><br/> Phone No : <?php echo get_single_value($booking_meta,"booking_phone"); ?><br/>Dietary : <?php echo get_single_value($booking_meta,"booking_special_requirements"); ?><br/>Booking Status : <?php echo $results_booking_desk_[0]["booking_desk_status"]; ?><br>Booking ID : <?php echo $results_booking_desk_[0]["booking_desk_booking_id"]; ?><br>Party Size : <?php echo $results_booking_desk_[0]["booking_desk_party_size"]; ?><br>Duration : <?php echo $results_booking_desk_[0]["booking_desk_duration"]; ?> Min"></td>
    <?php 
}else{
    ?>
    <td></td>
    <?php
}
                                    }
                                    ?>
                                    </tr>
       <?php } 
//fetch query of desk  s #ends    

?>
                                    
                                
                            </table>
                        </div>
                    </div>
                </div> <!-- container -->
                <!-- Add booking Start-->

            </div>
            <!-- Add booking Ends-->


            <!-- Modal -->


        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">

            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <?php include("core_scripts.php"); ?>

    <script>
        $(document).ready(function() {
            $('#select_user').select2({
                dropdownParent: $('.ic_booking_user_id')
            });
        });

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });

        $(document).on("change", ".js-switch", function() {
            //   swal("Please wait");
            var party_size = $(this).attr("party_size");
            if ($(this).is(":checked")) {
                var status = "on";
                $.get("private_functions.php?fn=update_desk&party_size=" + party_size + "&status=" + status, {}, function(data) {
                    // swal.close();
                });
            } else {
                var status = "off";
                $.get("private_functions.php?fn=update_desk&party_size=" + party_size + "&status=" + status, {}, function(data) {
                    // swal.close();
                });
            };
        });

        setInterval(() => {
            $.get("current_time.php", {},
                function(data, textStatus, jqXHR) {
                    // console.log(data);
                    $(".current_time").text(data);
                }
            );
        }, 1000);


        //Insert variables
        var insert_button_class_booking = ".insert_booking"; // .classname
        var form_id_booking = "#form_booking"; // #entry_form
        var insert_api_url_booking = "api/booking/m.do_booking_web.php"; // /api/insert.php
        var form_id_parameter_name = "form_id";

        //Insert Operation
        $(document).on("click", insert_button_class_booking, function(e) {
            e.preventDefault();
            //Processing
            swal("Processing", "Please Wait", "warning");
            //Processing
            var form_to_process_booking = form_id_booking + "_" + $(this).attr(form_id_parameter_name);

            $.post(insert_api_url_booking, $(form_to_process_booking).serializeArray(), function(data) {

                var response_json_booking = data;

                if (response_json_booking["response"]["status"] == "failure") {
                    var get_errors_booking = response_json_booking["response"]["message"];

                    swal("Error", get_errors_booking, {
                        icon: "error"
                    });

                } else {


                    //Reset Form
                    // $(form_to_process_booking)[0].reset();

                    //Focus to first input
                    $(form_to_process_booking + " input[type=text]").first().focus();

                    //To show updated values on same page
                    // $(updated_data_container_class).load(updated_data_file_url);


                    // Other functions to execure on success
                    swal("Booking Successfully Added", "", "success").then(function() {
                        location.reload();
                    });

                    //Customized buttons

                }



            }); // .post function ends

        }); //Insert function ends



        //Insert variables
        var insert_button_class_user = ".insert_user"; // .classname
        var form_id_user = "#form_user"; // #entry_form
        var insert_api_url_user = "api/user/insert_user.php"; // /api/insert.php


        //To show updated values on same page
        // var updated_data_container_class = "."; // .classname
        // var updated_data_element_class = "." // .classname

        //Insert Operation
        $(document).on("click", insert_button_class_user, function(e) {
            e.preventDefault();
            var form_to_process_user = form_id_user;

            $.post(insert_api_url_user, $(form_to_process_user).serializeArray(), function(data) {

                var response_json_user = data;

                if (response_json_user["status"] == "failure") {
                    var get_errors_user = response_json_user["errors"];
                    var errors_returned_user = "";
                    $(get_errors_user).each(function(index, value) {
                        errors_returned_user = errors_returned_user + " => " + value;

                    });
                    swal("Error", errors_returned_user, {
                        icon: "error"
                    });

                } else {


                    //Reset Form
                    // $(form_to_process_user)[0].reset();

                    //Focus to first input
                    $(form_to_process_user + " input[type=text]").first().focus();

                    //To show updated values on same page
                    // $(updated_data_container_class).load(updated_data_file_url);


                    // Other functions to execure on success
                    //Reload page on success

                    //             swal("Added Successfully.", {
                    //   icon: "success"
                    // }).then(function(){
                    //     location.href = "userpanel_admin.php#add_booking";
                    // });
                    location.reload();
                }



            }); // .post function ends

        }); //Insert function ends


        $(document).on("change", ".update_status", function() {
            var booking_id = $(this).attr("record_id");
            var stt = $(this).val();
            window.location = "userpanel_admin.php?update_status=true&status=" + stt + "&booking_id=" + booking_id;

        });
    </script>
    <?php include("footer.php"); ?>