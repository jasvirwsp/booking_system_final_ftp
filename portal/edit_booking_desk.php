<?php include("header.php"); ?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <!-- ========== Left Sidebar Start ========== -->
           <?php include("left_sidebar.php"); ?>
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("booking_desk")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_booking_desk_rad648b162f7ce0b" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("booking_desk_id");
        $record_type = "booking_desk";
        //Permission Check
        check_record_ownership("fetch",$user_id, $user_role, $record_type, $rec_id);
        //Permission Check
        $rec_meta = get_rec_meta_by_rec_id($record_type,$rec_id); 
        $rec_meta_count = count($rec_meta);
        if($rec_meta_count == "0"){
            echo "No Details Found for Record ID";            
            exit();
            
        }
        ?>
        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
    <input type="hidden" class="form-control booking_desk_booking_id" name="booking_desk_booking_id" value="<?php echo get_single_value($rec_meta,"booking_desk_booking_id"); ?>">
    <!-- <input type="hidden" class="form-control booking_desk_desk_id" name="booking_desk_desk_id" value="<?php echo get_single_value($rec_meta,"booking_desk_desk_id"); ?>"> -->
    <div class="form-group ic_booking_desk_desk_id col-md-6 d-inline-block">
             <label class="booking_desk_desk_id" for="booking_desk_desk_id">Desk</label>
            <select class="form-control db_auto_chose" name="booking_desk_desk_id" db_auto_chose_value="<?php echo get_single_value($rec_meta,"booking_desk_desk_id"); ?>">
                   <?php 
                   //fetch query of desk s #start
$where_array_desk_s = array("desk_name != ?"=>"");
$results_desk_s = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_s]);
$count_results_desk_s = count($results_desk_s);

//Lets loop through washing machine
                        foreach($results_desk_s as $single_result_desk_s){
?>
<option value="<?php echo $single_result_desk_s["record_id"];?>"><?php echo beautify_meta_name($single_result_desk_s["desk_name"]);?> - <?php echo get_value_with_id("section>name",$single_result_desk_s["desk_section"],""); ?></option>
                           <?php
                        } 
//fetch query of desk  s #ends    

?>
                                                   </select>
                </div>        
<!-- <div class="form-group ic_booking_desk_start_time col-md-6 d-inline-block">
         <label class="label_booking_desk_start_time" for="booking_desk_start_time">Start Time</label>
        <input type="text" class="form-control booking_desk_start_time" placeholder="Start Time" name="booking_desk_start_time" value="<?php echo get_single_value($rec_meta,"booking_desk_start_time"); ?>">
            </div>
<div class="form-group ic_booking_desk_end_time col-md-6 d-inline-block">
         <label class="label_booking_desk_end_time" for="booking_desk_end_time">End Time</label>
        <input type="text" class="form-control booking_desk_end_time" placeholder="End Time" name="booking_desk_end_time" value="<?php echo get_single_value($rec_meta,"booking_desk_end_time"); ?>">
            </div>
<div class="form-group ic_booking_desk_duration col-md-6 d-inline-block">
         <label class="label_booking_desk_duration" for="booking_desk_duration">Duration</label>
        <input type="text" class="form-control booking_desk_duration" placeholder="Duration" name="booking_desk_duration" value="<?php echo get_single_value($rec_meta,"booking_desk_duration"); ?>">
            </div>
<div class="form-group ic_booking_desk_party_size col-md-6 d-inline-block">
         <label class="label_booking_desk_party_size" for="booking_desk_party_size">Party Size</label>
        <input type="text" class="form-control booking_desk_party_size" placeholder="Party Size" name="booking_desk_party_size" value="<?php echo get_single_value($rec_meta,"booking_desk_party_size"); ?>">
            </div> -->
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_booking_desk" value="Update Booking Desk" form_id="rad648b162f7ce0b"> 
        </div>
        </form>
        </div>
        <!-- Form Row Ends -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <?php include("core_scripts.php");?>

        <script>
                
        //Auto chose select values
        $(".db_auto_chose").each(function(){  
        var db_auto_chose_name = $(this).attr("name");
        var db_auto_chose_value = $(this).attr("db_auto_chose_value");
        $(this).val(db_auto_chose_value);
        });

        //Update Variables
var update_button_class_booking_desk= ".update_booking_desk"; // .classname
var form_id_booking_desk = "#form_update_booking_desk";
var update_api_url_booking_desk = "api/booking_desk/update_booking_desk.php"; // /api/update.php
 var form_id_parameter_name_booking_desk = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_booking_desk,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_booking_desk = form_id_booking_desk + "_" + $(this).attr(form_id_parameter_name_booking_desk);

    	 $.post(update_api_url_booking_desk,$(form_to_process_booking_desk).serializeArray(),function(data){
        var response_json_booking_desk = data;

if(response_json_booking_desk["status"] == "failure"){
  var get_errors_booking_desk = response_json_booking_desk["errors"];
 
    var errors_returned_booking_desk = "";
  $(get_errors_booking_desk).each(function(index,value){
            errors_returned_booking_desk = errors_returned_booking_desk + " => " + value;
    });

    swal("Error",errors_returned_booking_desk, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_booking_desk)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_booking_desk = response_json_booking_desk["record_id"];
var customized_content_booking_desk = document.createElement("div");
customized_content_booking_desk.innerHTML = "<a href='edit_booking_desk.php?cache="+Math.random()+"&booking_desk_id="+entry_id_booking_desk+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='booking_desk.php?cache="+Math.random()+"#add_booking_desk' class='btn btn-sm btn-warning mt-1'>Add New booking_desk</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_booking_desk,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>