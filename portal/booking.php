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

                <h4 class="page-title"><?php echo beautify_meta_name(title_case("booking")); ?> 
                <!-- <a href="booking.php<?php echo (safe_get("show_all") == "true") ? "" : "?show_all=true"; ?>" class="btn btn-dark btn-sm"><?php echo (safe_get("show_all") == "true") ? "Only Waiting" : "Show All"; ?></a>  -->
                </h4>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <!-- RAD Featured Table-->

          <?php

          //Configurations
          $record_type = "booking";
          //Permission Check
          check_record_type_ownership($user_role, $record_type);
          //Permission Check
          $show_date_column = true;
          $enable_export_tools = false;
          $show_view_button = false;
          $enable_footer_stats = false;
          $enable_show_all_fields = false;
          $enable_serial_no = false;
          $serial_no_start = 1;
          $serial_header_text = "#";
          //Search
          $search_by_columns = "all"; //you can also put "all" or array.
          $enable_date_filter = false;
          //Columns
          $columns_to_list = array('booking_name','booking_email','booking_phone','booking_visit_time','booking_visit_date','booking_party_size','booking_special_requirements','booking_status','booking_duration','booking_leave_time');  // You can set it to "all", array("meta_name","another_meta_name"), blank
          if (safe_get("show_all_fields") == "yes") {
            $columns_to_list = "all";
          }
          $columns_to_exclude = array("booking_is_manual");
          //Action Buttons
          $edit_button_url = "edit_booking.php?booking_id=";
          $view_button_url = "view_booking.php?booking_id=";
          $delete_button_class = "delete_booking";
          //Records
          $per_page = 20;
          //Offset settings
          if (isset($_GET["override_limit"])) {
            $per_page = safe_get("override_limit");
          }
          $offset = 0;
          $page = 1;
          if (isset($_GET["page"])) {
            $page = safe_get("page");
            if ($page > 0) {
              $offset = ($page - 1) * $per_page;
            }
          }

          //Get record meta keys
          $meta_keys_array_name = "meta_keys_of_" . $record_type;
          $meta_keys_array =  $$meta_keys_array_name;


          //Initial records query 
          $where_array = array("record_id != ?" => ""); // You can change it as per required
          if (safe_get("show_all") == true) {
            $where_array = array("record_id != ?" => ""); // You can change it as per required
          }
          $options_array = array("orderBy" => "record_id DESC", "limit" => $per_page, "offset" => $offset);

          //End Configurations


          //Search By Columns
          if ($search_by_columns == "all") {
            $search_by_columns = $meta_keys_array;
          }
          ?>

          <!-- by>s>this,keyword>i -->

          <div id="accordion" class="w-100 mb-3 d-none">
            <div class="card mb-0">
              <div class="card-header" id="headingOne">
                <h4 class="m-0">
                  <a class="text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                    <i class="mdi mdi-table-search mr-1 text-primary"></i>
                    Search Records
                  </a>
                </h4>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">


                  <!-- Row Starts -->
                  <div class="row">
                    <!-- Col 1 -->
                    <div class="col-sm-3">
                      <form method="get" action="" id="form_search_rad5c40c114c0d28">
                        <div class="form-group d-inline-block">
                          <label for="search_by">Search By</label>
                          <select required class="form-control db_auto_chose reset_me" name="search_by" db_auto_chose_value="<?php echo safe_get('search_by'); ?>">
                            <option value="">Select Search By</option>
                            <?php
                            //Pass thru Function for search titles
                            function pass_thru_search($single_column)
                            {

                              $response_array = array();

                              if (isset($response_array[$single_column])) {

                                $return_value = $response_array[$single_column];

                                return $return_value;
                              }
                            }
                            //Pass thru Function for search titles
                            ?>
                            <?php foreach ($search_by_columns as $single_column) {
                            ?>
                              <option value="<?php echo $single_column; ?>"><?php echo pass_thru_search($single_column) ?: beautify_meta_name_and_exclude_rec($single_column); ?></option>
                            <?php
                            } ?>

                          </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group d-inline-block">
                        <label for="search_keyword">Search Keyword</label>
                        <input type="text" class="form-control reset_me" placeholder="Keyword" name="search_keyword" value="<?php echo safe_get('search_keyword'); ?>">
                      </div>
                    </div>
                    <!-- Date Filter    -->
                    <?php if ($enable_date_filter) { ?>
                      <div class="col-sm-3">
                        <div class="form-group d-inline-block">
                          <label for="search_start_date">Start Date</label>
                          <input type="date" class="form-control reset_me" placeholder="Start Date" name="search_start_date" value="<?php echo safe_get('search_start_date'); ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group d-inline-block">
                          <label for="search_end_date">End Date</label>
                          <input type="date" class="form-control reset_me" placeholder="End Date" name="search_end_date" value="<?php echo safe_get('search_end_date'); ?>">
                        </div>
                      </div>
                    <?php } ?>
                    <!-- Date Filter    -->
                    <div class="form-group col-sm-12">
                      <input type="submit" class="btn btn-secondary btn-sm insert_search" value="SEARCH" form_id="rad5c40c114c0d28">

                      <input type="button" class="btn btn-secondary btn-sm reset_form" value="RESET FILTERS" form_id="rad5c40c114c0d28">
                    </div>
                    </form>


                  </div>
                  <!-- Col 1 ends-->
                </div>
                <!-- Row Ends -->
              </div>
            </div>
          </div>





          <table class="table table-striped <?php if (safe_get('show_all_fields') == 'yes') {
                                              echo 'table-responsive';
                                            } ?>" id="list_table_booking">
            <?php


            //set columns
            $selected_columns = array($meta_keys_array[0], $meta_keys_array[1]); // if columns_to_list is blank select first two automatically
            if ($columns_to_list == "all") {
              $selected_columns = $meta_keys_array;
            }
            if (is_array($columns_to_list)) {
              $selected_columns = $columns_to_list;
            }

            ?>
            <thead class="bg-dark">
              <tr>
                <!-- <th><i status="unchecked" class="fe-check-circle text-info h4 select_all_to_delete"></i> <i class="fe-trash delete_selected h4 text-danger"></th> -->
                <?php
                //Pass thru Function for titles
                function pass_thru_title($single_column)
                {

                  $response_array = array("record_id" => "ID", "booking_user_id" => "Customer Name");

                  if (isset($response_array[$single_column])) {

                    $return_value = $response_array[$single_column];

                    return $return_value;
                  }
                }
                //Pass thru Function for titles
                ?>
                <!-- Enable Serial -->
                <?php if ($enable_serial_no) { ?>
                  <th><?php echo $serial_header_text; ?></th>
                <?php } ?>
                <!-- Enable Serial -->
                <?php
                foreach ($selected_columns as $single_column) {
                  if (in_array($single_column, $columns_to_exclude)) {
                    continue;
                  }
                ?>
                  <th><?php echo pass_thru_title($single_column) ?: beautify_meta_name_and_exclude_rec($single_column); ?></th>
                <?php
                }
                ?>
                <?php if ($show_date_column) { ?>
                  <th>Date Created</th>
                <?php } ?>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //Check if search query is reqeusted
              if (isset($_GET["search_by"])) {
                $search_by = safe_get("search_by");
                $search_keyword = safe_get("search_keyword");

                //Search by String from other rec_type and fetch result ID. 
                // if($search_by == "meta_key"){
                //   //fetch query of users s #start
                //   $where_array_rec_type_s = array("column_name LIKE ?"=>"%".$search_keyword."%");
                //   $options_array_rec_type_s = array();
                //   $results_rec_type_s = $records_fetch_controller->fetch_record_with_where(["rec_type",$where_array_rec_type_s,$options_array_rec_type_s]);
                //   $count_results_rec_type_s = count($results_rec_type_s);
                //  //fetch query of users  s #ends    
                //  $search_keyword = $results_rec_type_s[0]["id"];
                //  }

                $where_array = array($search_by . " LIKE ?" => "%" . $search_keyword . "%");
                $options_array = array("orderBy" => "record_id DESC");

                if ($search_by == "record_id") {
                  $where_array = array("record_id" => $search_keyword);
                  $options_array = array("limit" => 1);
                }

                //For equal queries , if you want to set some search parameter to equal instead of like
                $equal_value_search_array = array();
                if (in_array($search_by, $equal_value_search_array)) {
                  $where_array = array($search_by => $search_keyword);
                  $options_array = array();
                }
                //For equal queries

                // For searching exact value from comma separated values example search 'a' in 'a,b,c'
                $seach_from_comma_separated_value = array();
                if (in_array($search_by, $seach_from_comma_separated_value)) {
                  // $where_array = array($search_by=>$search_keyword);
                  $where_array = array("CONCAT(','," . $search_by . ",',') LIKE ?" => "%," . $search_keyword . ",%");
                  $options_array = array();
                }
                // For searching exact value from comma separated values example search 'a' in 'a,b,c'

                if (isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")) {
                  $start_date = safe_get("search_start_date");
                  $end_date = safe_get("search_end_date");
                  $options_array = array("between" => "date(date_created)," . $start_date . "," . $end_date);
                }
              }

              //Advance search with multi parameter
              if (isset($_GET["advance_search"])) {
                unset($_GET["advance_search"]);
                foreach ($_GET as $search_key => $search_value) {
                  if ($search_value != "") {
                    $where_array[$search_key] = $search_value;
                  }
                }
              }
              //Advance search with multi parameter

              $total_records = $records_fetch_controller->fetch_count_by_record_type_and_where_array([$record_type, $where_array]);
              $list_records = $records_fetch_controller->fetch_record_with_where([$record_type, $where_array, $options_array]);
              $count_list_records = count($list_records);
              if ($count_list_records == 0) {
                $zero_records = "<h4 class='text-center'>No Data Found</h4>";
              }


              //Pass thru custom functions
              //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
              //  if($dynamic_value){
              //Return Value
              //   return "test ".$dynamic_value;
              //Return colored span
              //  return "<span class='p-1 bg-success d-block text-white text-center'>".$dynamic_value."</span>";
              //Return colored hyperlink
              //  return "<a href='javascript:void(0);' class='p-1 bg-success d-block text-white text-center'>".$dynamic_value."</a>";
              // }
              //}
              function booking_user_id($single_column, $dynamic_value, $record_id, $data_array)
              {
                if ($dynamic_value) {
                  return get_user_meta_value_with_user_id($dynamic_value, "user_name");
                }
              }

              //Pass thru custom functions
              //Pass thru Function
              function pass_thru($single_column, $dynamic_value, $record_id, $data_array)
              {
                // Ex $allowed_columns = array("dummy_column");
                $allowed_columns = array("booking_user_id");

                if (in_array($single_column, $allowed_columns)) {

                  $return_value = $single_column($single_column, $dynamic_value, $record_id, $data_array);

                  return $return_value;
                }
              }
              //Pass thru Function

              //Loop list records
              $do_total_array = array(); //add columns here
              $totals_array = array();
              foreach ($list_records as $single_record) {
                $dynamic_buttons = array();
                $record_id = $single_record["record_id"];

              ?>
                <tr>
                  <!-- <td><div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input multi_delete" id="checkmeout_<?php echo $record_id; ?>" record_id="<?php echo $record_id; ?>">
    <label class="custom-control-label" for="checkmeout_<?php echo $record_id; ?>"></label>
</div></td> -->
                  <?php
                  //Enable Serial
                  if ($enable_serial_no) {
                  ?>
                    <td><?php echo $serial_no_start + (($page - 1) * $per_page);
                        $serial_no_start++; ?></td>
                    <?php
                  }
                  //Enable Serial
                  foreach ($selected_columns as $single_column) {
                    //Do total
                    if (in_array($single_column, $do_total_array)) {
                      $exclude_from_pass_thru = array();
                      if (in_array($single_column, $exclude_from_pass_thru)) {
                        $totals_array[$single_column] = $totals_array[$single_column] + $single_record[$single_column];
                      } else {
                        $totals_array[$single_column] = $totals_array[$single_column] + (pass_thru($single_column, $single_record[$single_column], $record_id, $single_record) ?: $single_record[$single_column]);
                      }
                    };
                    //Do total
                    if (in_array($single_column, $columns_to_exclude)) {
                      continue;
                    }
                    if ($single_column == "record_id") {
                    ?>
                      <td class="<?php echo $single_column; ?> <?php echo $single_column . "_" . $record_id; ?>"><?php echo pass_thru($single_column, $record_id, $record_id, $single_record) ?: $record_id; ?></td>
                    <?php
                      continue;
                    }
                    ?>
                    <td class="<?php echo $single_column; ?> <?php echo $single_column . "_" . create_slug($single_record[$single_column]); ?>"><?php echo pass_thru($single_column, $single_record[$single_column], $record_id, $single_record) ?: title_case($single_record[$single_column]); ?></td>
                  <?php  }

                  if ($show_date_column) {
                  ?>
                    <td><?php echo humanize_date($single_record["date_created"]); ?></td>
                  <?php
                  }
                  ?>
                  <td>
                    <!--Dyanamic buttons -->
                    <?php
                    //Dynamic Buttons Array
                    //Title,Href,CSS Classes,Icon,Tooltip,Target,attributes

                    // $dynamic_buttons[] = ["", "booking.php?search_by=booking_user_id&search_keyword=" . $single_record["booking_user_id"], "btn btn-sm mb-1 btn-info", "fe-activity", "Bookings", "_self", []];
                    //Dynamic Buttons Array

                    //Loop Buttons
                    foreach ($dynamic_buttons as $single_button) {
                      //If has attributes, prepare sxtring
                      if ($single_button[6]) {
                        $attribute_string = "";
                        foreach ($single_button[6] as $attr_name => $attr_value) {
                          $attribute_string = $attribute_string . $attr_name . "=" . "$attr_value" . " ";
                        }
                        $attribute_string = trim($attribute_string);
                      }
                      //If has attributes, prepare string
                    ?>
                      <a target="<?php echo $single_button[5]; ?>" class="<?php echo $single_button[2] ?: "btn btn-sm w-100 mb-1 btn-info"; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $single_button[4] ?: $single_button[0]; ?>" href="<?php echo $single_button[1] ?>" <?php echo $attribute_string; ?>><i class="<?php echo $single_button[3] ?>"></i> <?php echo $single_button[0] ?></a>
                    <?php
                    }
                    // loop  buttons ends
                    ?>
                    <!--Dyanamic buttons -->
                    <?php if ($show_view_button) { ?>
                      <a class="btn btn-warning btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo $view_button_url . $record_id; ?>"><i class="fe-eye"></i></a>
                    <?php } ?>

                    <a class="btn btn-success btn-sm  mb-1" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo $edit_button_url . $record_id; ?>" record_id="<?php echo $record_id; ?>"><i class="fe-edit"></i></a>

                    <!-- <a class="btn btn-info btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="View/f -->
                    <a class="btn btn-danger btn-sm  mb-1 <?php echo $delete_button_class; ?>" data-toggle="tooltip" data-placement="top" title="Delete" href=javascript:void(0)" record_id="<?php echo $record_id; ?>"><i class="fe-trash-2"></i></a>


                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <?php
          if ($zero_records) {
            echo $zero_records;
          }
          ?>

          <?php
          //Only show pagination if search is not queried
          if (!isset($_GET["search_by"])) {
            if (!isset($_GET["override_limit"])) {
          ?>
              <!-- Row Starts -->
              <div class="row">
                <!-- Col 1 -->
                <div class="col-sm-6">
                  <?php if ($page > 1) {
                    $prev_page = $page - 1;
                  ?>
                    <a href="?page=<?php echo $prev_page; ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
                  <?php } ?>
                  <?php
                  //Total Records for pagination        
                  $this_page_records = $page * $per_page;

                  if ($total_records > $this_page_records) {
                    $next_page = $page + 1;
                  ?>
                    <a href="?page=<?php echo $next_page; ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i> Next</a>
                  <?php
                  }
                  ?>

                </div>
                <!-- Col 1 ends-->

                <!-- Col 2 -->
                <div class="col-sm-6">
                  Total Records : <strong><?php echo $total_records; ?></strong> . Limit : <strong><?php echo $per_page; ?> Per Page </strong>
                  <?php if ($total_records > $this_page_records) { ?>
                    <a href="?override_limit=0" class="btn btn-info btn-sm"><i class="fa fa-list" aria-hidden="true"></i> View All</a> <a href="?override_limit=0&show_all_fields=yes" class="btn btn-info btn-sm"><i class="fa fa-list" aria-hidden="true"></i> View All with All Fields</a><?php } ?>
                </div>
                <!-- Col 2 ends -->
            <?php }
          } ?>
              </div>
              <!-- Row Ends -->
              <?php if ($enable_export_tools) { ?>
                <div class="row">
                  <!-- Col 1 -->
                  <div class="col-sm-12">
                    <p><strong>Export Tools</strong></p>
                    <a href="javascript:void" class="btn btn-secondary btn-sm export_to_csv_booking"><i class="fa fa-download" aria-hidden="true"></i> CSV</a>
                    <a href="javascript:void" class="btn btn-secondary btn-sm export_to_xls_booking"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
                    <a href="javascript:void" class="btn btn-secondary btn-sm print_table_booking"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                    <?php
                    if ($enable_show_all_fields) {
                      if (!isset($_GET["show_all_fields"])) { ?>
                        <a href="booking.php?show_all_fields=yes" class="btn btn-secondary btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Show All Fields</a>
                    <?php }
                    } ?>
                  </div>
                  <!-- Col 1 ends -->
                </div>
                <!-- Row Ends -->
              <?php } ?>


              <!-- RAD Featured Table-->

              <?php if ($enable_footer_stats) { ?>
                <!-- Horizontal Card 3 Column -->
                <div class="card text-white bg-dark mb-3 mt-3">
                  <div class="card-header bg-dark">Stats</div>
                  <div class="card-body">
                    <!-- Row Starts -->
                    <div class="row">
                      <!-- Col 1 -->
                      <div class="col-sm-4">
                        <h5 class="card-title">Stat : </h5>
                        <p class="card-text">0</p>
                      </div>
                      <!-- Col 1 ends-->

                      <!-- Col 2 -->
                      <div class="col-sm-4">
                        <h5 class="card-title">Stat : </h5>
                        <p class="card-text">0</p>
                      </div>
                      <!-- Col 2 ends -->

                      <!-- Col 3 -->
                      <div class="col-sm-4">
                        <h5 class="card-title">Stat : </h5>
                        <p class="card-text">0</p>
                      </div>
                      <!-- Col 3 ends -->
                    </div>
                    <!-- Row Ends -->
                  </div>
                </div>
                <!-- Horizontal Card 3 Column -->
              <?php } ?>
              <!-- end row -->

        </div> <!-- container -->

      </div> <!-- content -->
      <!-- Add booking Start-->
      <div class="modal fade" id="add_booking" tabindex="-1" role="dialog" aria-labelledby="add_booking_LongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo beautify_meta_name(title_case("booking")); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- desk_id>s>opt1/opt2,visit_time>i,user_id>i --&gt<!-- Form Row Starts -->
              <form method="post" action="" id="form_booking_rad637f1db99593a" class="w-100">
                <div class="row">
                  <div class="form-group ic_booking_user_id col-md-6 d-inline-block">
                    <label class="booking_user_id" for="booking_user_id">User Id</label>
                    <select class="form-control booking_user_id" name="booking_user_id">
                      <option value="">Select</option>
                    </select>
                  </div>


                  <div class="form-group ic_booking_party_size col-md-6 d-inline-block">
                    <label class="booking_party_size" for="booking_party_size">Party Size</label> </br>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="booking_party_size" value="2">2
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="booking_party_size" value="3">3
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="booking_party_size" value="4">4
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="booking_party_size" value="5-8">5-8
                      </label>
                    </div>
                  </div>

                  <div class="form-group ic_booking_duration col-md-6 d-inline-block">
         <label class="booking_duration" for="booking_duration">Duration</label>
        <input type="text" class="form-control booking_duration" placeholder="Duration"  name="booking_duration">
            </div>   

            <div class="form-group ic_booking_desk_id col-md-6 d-inline-block">
         <label class="booking_desk_id" for="booking_desk_id">Desk Id</label>
        <input type="text" class="form-control booking_desk_id" placeholder="Desk Id"  name="booking_desk_id">
            </div>

            <div class="form-group ic_booking_leave_time col-md-6 d-inline-block">
         <label class="booking_leave_time" for="booking_leave_time">Leave Time</label>
        <input type="text" class="form-control booking_leave_time" placeholder="Leave Time"  name="booking_leave_time">
            </div> 

                  <div class="form-group ic_booking_special_requirements col-md-6 d-inline-block">
                    <label class="booking_special_requirements" for="booking_special_requirements">Special Requirements</label>
                    <input type="text" class="form-control booking_special_requirements" placeholder="Special Requirements" name="booking_special_requirements">
                  </div>


                  <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-success btn-sm insert_booking" value="Add Booking" form_id="rad637f1db99593a">
                  </div>
              </form>
            </div>
            <!-- Form Row Ends -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Add booking Ends-->

    <!-- Quick Edit Modal for booking Start-->
    <div class="modal fade" id="quick_edit_modal_booking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo beautify_meta_name(title_case("booking")); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body ic_age_modal">
            <form method="post" action="" id="form_update_booking_quick_edit" class="w-100">
              <input type="hidden" name="record_id" value="" class="quick_edit_booking_record_id">
              <div class="modal_input_loader_booking">

              </div>
              <div class="form-group col-md-12">

                <input type="submit" class="btn btn-success btn-sm update_booking" value="Update <?php echo beautify_meta_name(title_case("booking")); ?>" form_id="quick_edit">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Quick Edit Modal booking Ends-->


  </div>

  <!-- ============================================================== -->
  <!-- End Page content -->
  <!-- ============================================================== -->


  </div>
  <!-- END wrapper -->
  <?php include("core_scripts.php"); ?>

  <script>
    <?php
    //Search Filters Conditional changes
    $search_filters_array = array(
      // array(
      //   "filter_name" => "person_city",
      //   "type" => "text",
      //   "class" => "auto_suggestions_plumber_city",
      //   "default_value" => "",
      //   "attributes" => array(
      //     "autocomplete" => "off"
      //   )
      // ),

    );

    ?>
    $("select[name=search_by]").change(function() {
      var search_by_value = $(this).val();
      var initial_search_keyword_classes = "form-control reset_me ";
      var allowed_filters_array = new Array();
      <?php
      foreach ($search_filters_array as $single_search_condition) {
        $explode_search_filter_names = explode(",", $single_search_condition["filter_name"]);
        $search_filters_names_string = "";
        foreach ($explode_search_filter_names as $single_filter_name) {
      ?>
          //Push to array
          allowed_filters_array.push("<?php echo $single_filter_name; ?>");
        <?php
          $search_filters_names_string = $search_filters_names_string . 'search_by_value == "' . $single_filter_name . '" || ';
        }
        $search_filters_names_string = rtrim($search_filters_names_string, "|| ");
        ?>

        if (<?php echo $search_filters_names_string; ?>) {

          //Set Type
          $("input[name=search_keyword]").attr("type", "<?php echo $single_search_condition["type"]; ?>");
          //Set Class
          $("input[name=search_keyword]").attr("class", initial_search_keyword_classes + "<?php echo $single_search_condition["class"]; ?>");
          //Set Value
          $("input[name=search_keyword]").val("<?php echo $single_search_condition["default_value"]; ?>");
          //Set Attributes
          <?php foreach ($single_search_condition["attributes"] as $single_search_attr_name => $single_search_attr_value) { ?>
            $("input[name=search_keyword]").attr("<?php echo $single_search_attr_name; ?>", "<?php echo $single_search_attr_value; ?>");
          <?php } ?>
        }

      <?php } ?>
      //If not available in filters, then keep defaults
      if (allowed_filters_array.indexOf(search_by_value) == "-1") {
        //Set Type
        $("input[name=search_keyword]").attr("type", "text");
        //Set Class
        $("input[name=search_keyword]").attr("class", initial_search_keyword_classes);
        //Set Value
        $("input[name=search_keyword]").val("");
      }
      //If not available in filters, then keep defaults

      //Focus on search keyword
      $("input[name=search_keyword]").focus();
    });

    //Search Filters Conditional changes



    //Insert variables
    var insert_button_class_booking = ".insert_booking"; // .classname
    var form_id_booking = "#form_booking"; // #entry_form
    var insert_api_url_booking = "api/booking/insert_booking.php"; // /api/insert.php
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

        if (response_json_booking["status"] == "failure") {
          var get_errors_booking = response_json_booking["errors"];
          var errors_returned_booking = "";
          $(get_errors_booking).each(function(index, value) {
            errors_returned_booking = errors_returned_booking + " => " + value;

          });
          swal("Error", errors_returned_booking, {
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


          //Customized buttons
          var entry_id_booking = response_json_booking["record_id"];
          var customized_content_booking = document.createElement("div");
          customized_content_booking.innerHTML = "<a href='edit_booking.php?booking_id=" + entry_id_booking + "' class='btn btn-sm btn-warning mt-1'>Edit Booking</a> <a href='#' onclick='location.reload()' class='btn btn-sm btn-warning mt-1'>Add New Booking</a> <!--<a href='#' class='btn btn-sm btn-success mt-1'>Another Action</a> <a href='#' class='btn btn-sm btn-info mt-1'>Another Action</a> --><br><br><a href='#' onclick='var loc = location.href.replace(location.hash,\"\");window.location.assign(loc);' class='btn btn-sm btn-danger'>Close & Refresh</a> <a href='#' onclick='swal.close()' class='btn btn-sm btn-danger'>X</a>";
          swal({
            title: "Success",
            text: "Choose next action",
            content: customized_content_booking,
            buttons: false,
            icon: 'success',
          });
          //Customized buttons

        }



      }); // .post function ends

    }); //Insert function ends

    //Featured Tabel Javascript
    //Reset Form
    $(".reset_form").click(function() {
      var form_id = $(this).attr("form_id");
      $("#form_search_" + form_id + " .reset_me").val("");
    });


    //Export and print codes
    var records_table_id = "#list_table_booking";
    $(".export_to_csv_booking").click(function() {
      $(records_table_id).tableToCSV();
    });

    $(".export_to_xls_booking").click(function() {
      $(records_table_id).tableExport({
        filename: 'records.xls',
        escape: 'false'
      });
    });

    function beforeprinttable() {
      $(records_table_id + " th:last-child," + records_table_id + " td:last-child").hide();
    };

    function afterprinttable() {
      setInterval(function() {
        $(records_table_id + " th:last-child," + records_table_id + " td:last-child").show();
      }, 1000);
    };

    $(".print_table_booking").click(function() {
      $(records_table_id).printThis({
        beforePrint: beforeprinttable(),
        afterPrint: afterprinttable()
      });
    });

    // Delete Operation

    var delete_record_button_class_booking = ".delete_booking"; // .classname
    var primary_record_key_attribute_name_booking = "record_id"; //Name of attribute of particular record to edit/update/view/delete.
    var delete_api_url_booking = "api/booking/delete_booking.php"; // /api/delete.php

    $(document).on("click", delete_record_button_class_booking, function(e) {
      e.preventDefault();


      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var record_id_booking = $(this).attr(primary_record_key_attribute_name_booking);

            $.post(delete_api_url_booking, {
              "record_id": record_id_booking
            });


            swal("Processing", {
              icon: "success",
              timer: 1000
            }).then(function() {
              location.reload();
            });

          }
        });
    });
    //Featured Tabel Ends

    //Multi select
    // Select/unselect all items
    $(".select_all_to_delete").click(function() {
      var availble_items_length = $(".multi_delete").length;

      if (availble_items_length > 0) {

        var status = $(this).attr("status");
        if (status == "unchecked") {
          $(".multi_delete").prop("checked", true);
          $(this).attr("status", "checked");
        } else {
          $(".multi_delete").prop("checked", false);
          $(this).attr("status", "unchecked");
        }
      } else {
        swal("Oops", "No Item to select", "info")
      }
    });
    //ends

    //Delete selected items
    $(".delete_selected").click(function(e) {
      e.preventDefault();
      var selected_items_length = $(".multi_delete:checked").length;
      if (selected_items_length > 0) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

              var selected_to_delete_array = $(".multi_delete:checked").map(function() {
                return $(this).attr("record_id");
              }).get();
              var api_url = "api/booking/delete_booking.php"; //Replace with correct API url

              swal("Deleting Selected Entries", {
                icon: "warning",
              });

              $.post(api_url, {
                "record_id": selected_to_delete_array
              }, function() {

                swal("Deletion Success", {
                  icon: "success",
                });
                setTimeout(function() {
                  location.reload();
                }, 1000)

              });

            }
          });

      } else {
        swal("Oops", "No Item Selected", "info");

      }

    });
    //Delete selected items ends
    //Multi select ends

    //Apply Datatables to mobile only
    $(document).ready(function() {
      $(document).ready(function() {
        var isMobile = true;

        if (isMobile) {
          $('#list_table_booking').DataTable({
            paging: false,
            info: false,
            responsive: {
              details: true
            },
            order: [[0, 'desc']],
            "language": {
              "search": "Search Table"
            }

          });
        }
      });

    });
    //Apply Datatables to mobile only



    //Quick Edit Code for booking starts
    $(".quick_edit_booking").click(function() {
      var quick_edit_booking_record_type = 'booking';
      var quick_edit_booking_record_id = $(this).attr("record_id");
      $(".quick_edit_booking_record_id").val(quick_edit_booking_record_id);
      var quick_edit_booking_input_name = $(this).attr("quick_edit_input_name");
      $("#quick_edit_modal_booking").modal("show");
      $(".modal_input_loader_booking").load("edit_" + quick_edit_booking_record_type + ".php?" + quick_edit_booking_record_type + "_id=" + quick_edit_booking_record_id + " .ic_" + quick_edit_booking_input_name);
    });


    //Update Variables for booking
    var qe_update_button_class_booking = ".update_booking"; // .classname
    var qe_form_id_booking = "#form_update_booking";
    var qe_update_api_url_booking = "api/booking/update_booking.php"; // /api/update.php
    var qe_form_id_parameter_name_booking = "form_id";
    //Update Operation
    $(document).on("click", qe_update_button_class_booking, function(e) {
      e.preventDefault();
      var qe_form_to_process_booking = qe_form_id_booking + "_" + $(this).attr(qe_form_id_parameter_name_booking);

      $.post(qe_update_api_url_booking, $(qe_form_to_process_booking).serializeArray(), function(data) {
        var qe_response_json_booking = data;

        if (qe_response_json_booking["status"] == "failure") {
          var qe_get_errors_booking = qe_response_json_booking["errors"];

          var errors_returned_booking = "";
          $(qe_get_errors_booking).each(function(index, value) {
            errors_returned_booking = errors_returned_booking + " => " + value;
          });

          swal("Error", errors_returned_booking, {
            icon: "error"
          });
        } else {

          //Reset Form
          //$(qe_form_to_process_booking)[0].reset();



          // Other functions to execute on success
          //Customized buttons
          var qe_customized_content_booking = document.createElement("div");
          qe_customized_content_booking.innerHTML = "<a href='javascript:void(0)' onClick='location.reload()' class='btn btn-sm btn-warning mt-1'>Refresh Changes</a> <br><br><a href='javascript:void(0)' onclick='swal.close()' class='btn btn-sm btn-danger'>Close Box</a>";
          swal({
            title: "Updated",
            text: "Choose next action",
            content: qe_customized_content_booking,
            buttons: false,
            icon: 'success',
          });
          //Customized buttons


        }
      });

    });
    //Quick Edit Code for booking ends 
  </script>
  <?php include("footer.php"); ?>