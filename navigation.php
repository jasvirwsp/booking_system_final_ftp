        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="index.php" class="logo logo-dark">
                            <img src="assets/images/logo/logo.png" alt="Site Logo">
                        </a>
                        <a href="index.php" class="logo logo-light">
                            <img src="assets/images/logo/logo-light.png" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.html" class="logo">
                                    <img src="assets/images/logo/logo.png" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li><a href="#about_us">About Us</a></li>
                                <li><a href="#contact_us">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <!-- <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li> -->
                            <!-- <li class="wishlist">
                                <a href="wishlist.html">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li> -->
                            
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                <?php
                                    if(isset($_SESSION["user_id"])){ ?>
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li>
                                            <a href="account.php">My Account</a>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php
                                    if(isset($_SESSION["user_id"])){ ?>
                                        <div class="login-btn">
                                        <a href="do-logout.php" class="axil-btn btn-bg-secondary sign-up-btn">Logout</a>
                                        </div>
                                  <?php  } else { ?>
                                    <span class="title">Sign In/SIgn Up</span>
                                    <div class="login-btn">
                                        <a href="login.php" class="axil-btn btn-bg-primary">Login</a>
                                    </div>
                                    <?php }
                                    ?>
                                   
                                   <?php
                                    if(!isset($_SESSION["user_id"])){ ?>
                                    <div class="singin-header-btn">
                                    <div class="reg-footer text-center">No account yet? <a href="signup.php" class="btn-link">REGISTER HERE.</a></div>
                                </div>
                                <?php } ?>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->