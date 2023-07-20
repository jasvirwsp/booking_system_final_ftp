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
                                    
                                    <h4 class="page-title">Edit <?php echo beautify_meta_name(title_case("section")); ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- Form Row Starts -->
        <form method="post" action="" id="form_update_section_rad64660d8b849db" class="w-100">
        <div class="row">        
        <?php $rec_id = safe_get("section_id");
        $record_type = "section";
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
<div class="form-group ic_section_name col-md-6 d-inline-block">
         <label class="label_section_name" for="section_name">Name</label>
        <input type="text" class="form-control section_name" placeholder="Name" name="section_name" value="<?php echo get_single_value($rec_meta,"section_name"); ?>">
            </div>
       <div class="form-group col-md-12">
       
        <input type="submit" class="btn btn-success btn-sm update_section" value="Update Section" form_id="rad64660d8b849db"> 
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
var update_button_class_section= ".update_section"; // .classname
var form_id_section = "#form_update_section";
var update_api_url_section = "api/section/update_section.php"; // /api/update.php
 var form_id_parameter_name_section = "form_id";
    //Update Operation
    	   $(document).on("click",update_button_class_section,function(e){
e.preventDefault();
//Processing
swal("Processing","Please Wait","warning");
//Processing
    		  var form_to_process_section = form_id_section + "_" + $(this).attr(form_id_parameter_name_section);

    	 $.post(update_api_url_section,$(form_to_process_section).serializeArray(),function(data){
        var response_json_section = data;

if(response_json_section["status"] == "failure"){
  var get_errors_section = response_json_section["errors"];
 
    var errors_returned_section = "";
  $(get_errors_section).each(function(index,value){
            errors_returned_section = errors_returned_section + " => " + value;
    });

    swal("Error",errors_returned_section, {
      icon: "error"
    });
}else{
    		
        //Reset Form
    		//$(form_to_process_section)[0].reset();

        

    		 // Other functions to execute on success
    		   //Customized buttons
var entry_id_section = response_json_section["record_id"];
var customized_content_section = document.createElement("div");
customized_content_section.innerHTML = "<a href='edit_section.php?cache="+Math.random()+"&section_id="+entry_id_section+"' class='btn btn-sm btn-warning mt-1'>Keep Editing</a> <a href='section.php?cache="+Math.random()+"#add_section' class='btn btn-sm btn-warning mt-1'>Add New section</a> <!-- <a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a>--><br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
swal({
    title: "Updated",
    text: "Choose next action",
  content: customized_content_section,
  buttons: false,
  icon : 'success',
});
//Customized buttons


}
           });

    	   });
           
        
        </script>
<?php include("footer.php"); ?>