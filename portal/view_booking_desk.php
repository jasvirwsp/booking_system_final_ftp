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
<?php 
  $record_type_booking_desk = "booking_desk";
  $record_human_booking_desk = beautify_meta_name($record_type_booking_desk);
  $record_id_booking_desk = safe_get("booking_desk_id");
  $record_meta_booking_desk =get_rec_meta_by_rec_id($record_type_booking_desk,$record_id_booking_desk);

  $columns_to_list_booking_desk = "all";
  $columns_to_exclude_booking_desk = array("");
  
  //Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type_booking_desk;
$meta_keys_array =  $$meta_keys_array_name;

//set columns
$selected_columns_booking_desk = array($meta_keys_array[0],$meta_keys_array[1]); // if columns_to_list_booking_desk is blank select first two automatically
if($columns_to_list_booking_desk == "all"){
    $selected_columns_booking_desk = $meta_keys_array;
}
if(is_array($columns_to_list_booking_desk)){
    $selected_columns_booking_desk = $columns_to_list_booking_desk;
}

  ?>
  <!-- start page title -->
  <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title"><?php echo $record_human_booking_desk; ?> <!-- Button trigger modal -->
</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
<h3 class="text-center"><?php echo $record_human_booking_desk; ?> ID : <?php echo $record_id_booking_desk; ?> <a href="edit_<?php echo $record_type_booking_desk; ?>.php?<?php echo $record_type_booking_desk; ?>_id=<?php echo $record_id_booking_desk; ?>" class="btn btn-secondary btn-sm">Edit <?php echo $record_human_booking_desk; ?></a> <a href="javascript:void(0)" class="print_table btn btn-warning btn-sm"> Print</a></h3>

                        <table class="table table-striped mb-0 booking_desks_table">
                                            <thead>
                                            <tr>                                               
                                                <th colspan="2" class="text-center"><?php echo $record_human_booking_desk; ?> Details</th>
                                                         
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
//Pass thru Function for titles
function pass_thru_title($single_column){
  
  $response_array = array();

  if(isset($response_array[$single_column])){  

    $return_value = $response_array[$single_column];
  
    return $return_value;
}
  }
  //Pass thru Function for titles

  
//Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //   return "test ".$dynamic_value;
  // }
  

  
  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id,$data_array){
    // Ex $allowed_columns = array("dummy_column");
    $allowed_columns = array();
  
    if(in_array($single_column,$allowed_columns)){  
  
      $return_value = $single_column($single_column,$dynamic_value,$record_id,$data_array);  
    
      return $return_value;
  }
    }
    //Pass thru Function
?>

                                            <?php
    foreach($selected_columns_booking_desk as $single_column_booking_desk){
        if(in_array($single_column_booking_desk,$columns_to_exclude_booking_desk)){
            continue;
        }
        if($single_column_booking_desk == "record_id"){
         continue;
        }
?>

 <tr>
                                            
                                            <td>
                                            <?php echo pass_thru_title($single_column_booking_desk) ?: beautify_meta_name_and_exclude_rec($single_column_booking_desk); ?>  </td>
                                            <td>
                                            <?php echo pass_thru($single_column_booking_desk,get_single_value($record_meta_booking_desk,$single_column_booking_desk),$record_id,$record_meta_booking_desk) ?: beautify_meta_name(get_single_value($record_meta_booking_desk,$single_column_booking_desk));?>
                                                </td>
                                        </tr>

  <?php  } ?>
                                           
                                           
                                           
                                            </tbody>
                                        </table>




                        
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
       


function beforeprinttable(){
  $(records_table_id+" th:last-child,"+ records_table_id + " td:last-child").hide();
};

function afterprinttable(){
setInterval(function(){
  $(records_table_id + " th:last-child,"+ records_table_id + " td:last-child").show();
},1000);
};

$(".print_table").click(function(){
$(".booking_desks_table").printThis();
});

        </script>
<?php include("footer.php"); ?>