<?php include("header.php"); ?>
<style>
    .iframe-container {
  position: relative;
  overflow: hidden;
  width: 100%;
  padding-top: 70%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
}

/* Then style the iframe to fit in the container div with full height and width */
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
@media screen and (max-width: 650px) {
    .iframe-container {
  padding-top: 155%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
}
  
}
</style>
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
             
                        <!-- end page title --> 

                        <div class="row">

                        <div class="iframe-container">
  <iframe src="chat/index.php" class="responsive-iframe" src="chat"></iframe>
</div>


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

        
