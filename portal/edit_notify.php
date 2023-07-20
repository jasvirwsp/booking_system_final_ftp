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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("notify")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_notify_rad6388836685cd4" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("notify_id");
        $record_type = "notify";
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
<div class="form-group ic_notify_user_id col-md-6 d-inline-block">
         <label class="label_notify_user_id" for="notify_user_id">User Id</label>
        <input type="text" class="form-control notify_user_id" placeholder="User Id" name="notify_user_id" value="<?php echo get_single_value($rec_meta,"notify_user_id"); ?>">
            </div>
<div class="form-group ic_notify_party_size col-md-6 d-inline-block">
         <label class="label_notify_party_size" for="notify_party_size">Party Size</label>
        <input type="text" class="form-control notify_party_size" placeholder="Party Size" name="notify_party_size" value="<?php echo get_single_value($rec_meta,"notify_party_size"); ?>">
            </div>
<div class="form-group ic_notify_reminder_status col-md-6 d-inline-block">
         <label class="label_notify_reminder_status" for="notify_reminder_status">Reminder Status</label>
        <input type="text" class="form-control notify_reminder_status" placeholder="Reminder Status" name="notify_reminder_status" value="<?php echo get_single_value($rec_meta,"notify_reminder_status"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_notify" value="Update Notify" form_id="rad6388836685cd4"> 
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
var update_button_class_notify= ".update_notify"; // .classname
var form_id_notify = "#form_update_notify";
var update_api_url_notify = "api/notify/update_notify.php"; // /api/update.php
 var form_id_parameter_name_notify = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_notify,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_notify = form_id_notify + "_" + $(this).attr(form_id_parameter_name_notify);

    	 $.post(update_api_url_notify,$(form_to_process_notify).serializeArray(),function(data){
        var response_json_notify = data;

if(response_json_notify["status"] == "failure"){
  var get_errors_notify = response_json_notify["errors"];
 
    var errors_returned_notify = "";
  $(get_errors_notify).each(function(index,value){
            errors_returned_notify = errors_returned_notify + " => " + value;
    });

    swal("Error",errors_returned_notify, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_notify)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_notify = response_json_notify["record_id"];
var customized_content_notify = document.createElement("div");
customized_content_notify.innerHTML = "<a href='edit_notify.php?cache="+Math.random()+"&notify_id="+entry_id_notify+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='notify.php?cache="+Math.random()+"#add_notify' class='btn btn-sm btn-warning mt-1'>Add New notify</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_notify,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>