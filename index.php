<?php include('header.php'); ?>
    <main class="main-wrapper">
        <!-- Start Slider Area -->
        <div class="axil-main-slider-area main-slider-style-7 bg_image--8">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <div class="main-slider-content">
                            <span class="subtitle"><i class="fas fa-user"></i><?php echo isset($_SESSION['user_name']) ? 'Welcome '.$_SESSION['user_name'] : "Welcome" ;?></span>
                            <h1 class="title" style="color:#ffffff;">Book your table at Renatas Restaurant</h1>
                            <p style="color:#ffffff;">Casual fine dining experience with an inventive and locally sourced menu.</p>
                            <div class="shop-btn">
                                <?php if(isset($_SESSION["user_id"])) { ?>
                                <?php } else { ?>
                                    <a href="signup.php" class="axil-btn btn-bg-secondary right-icon">Sign Up <i class="fal fa-long-arrow-right"></i></a>
                                <?php } ?>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Slider Area -->

        <!-- Booking area -->
        <div class="axil-contact-page-area axil-section-gap pt--100 bg-vista-white footer-dark">
            <div class="container">
                <div class="axil-contact-page">
                    <div class="row row--30">
                        <div class="col-lg-8 p-5" style="background-color:#ffffff;border-radius:10px;">
                            <div class="contact-form">
                                <h3 class="title mb--20">Get your table</h3>
                                <form method="POST" action="signup.php">
                                <div class="row row--10 second_row hide_me">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="party-size">Party Size <span>*</span></label>
                                                <select class="booking_party_size" name="booking_party_size" id="party-size" required>
                                                    <?php for($x = 1;$x <= 15;$x ++) { ?>
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?> Person</option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" class="booking_duration" name="booking_duration">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="party-date">Date <span>*</span></label>
                                                <input class="booking_visit_date" type="date" name="booking_visit_date" id="party-date" required value="<?php echo get_today_date(); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="party-time">Time Hour<span>*</span></label>
                                                <select class="booking_party_time_hour" name="booking_party_time_hour" id="party-hour" required>
                                                    <?php for($x = 12;$x <= 21;$x ++) { ?>
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="party-time">Time Minutes<span>*</span></label>
                                                <select class="booking_party_time_minutes" name="booking_party_time_minutes" id="party-minute" required>
                                                <option value="00">00</option>
                                                        <option value="15">15</option>
                                                        <option value="30">30</option>
                                                        <option value="45">45</option>
                                                        <option value="60">60</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <div class="row row--10 first_row hide_me">
                                <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="party-name">Full Name <span>*</span></label>
                                                <input class="booking_name" type="text" name="booking_name" id="party-name" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="party-name">Email<span>*</span></label>
                                                <input class="booking_email" type="email" name="booking_email" id="party-email" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="party-name">Phone Number<span>*</span></label>
                                                <input class="booking_phone" type="number" name="booking_phone" id="party-phone" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="party-name">Dietery Requirements</label>
                                                <textarea rows="2" class="booking_requirements" type="text" name="booking_requirements" id="party-requirements"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row row--10 third_row">
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                        
                                            <div class="form-group mb--0 hide_me">
                                                <button name="submit" type="submit" id="submit" class="axil-btn btn-bg-primary add-booking">Book a table</button>
                                            </div>
                                      
                                     <div class="reg-footer d-none success-message"><span style="color:#088F8F;">Table Booked Successfully!</div>

                                     <p class="error-message mt--10" style="color:#ef3f70;"></p>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact-location mb--40 axil-footer-widget">
                                <h4 class="title mb--20 widget-title">Get in touch</h4>
                                <span class="address mb--20">8212 E. Glen Creek Street Orchard Park, NY 14127, United States of America</span>
                                <span class="phone">Phone: <b>+123 456 7890</b></span>
                                <span class="email">Email: <b>Hello@etrade.com</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End booking area -->
       
        <!-- Start Best Sellers Product Area  -->
        <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"> <i class="far fa-images"></i>Images</span>
                        <h2 class="title">Gallery</h2>
                    </div>
                    <div class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a>
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="assets/images/product/nft/product-18.jpg" alt="Product Images">
                                    </a>
                                </div>
                               
                            </div>
                        </div>

                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a>
                                        <img data-sal="fade" data-sal-delay="200" data-sal-duration="1500" src="assets/images/product/nft/product-19.jpg" alt="Product Images">
                                    </a>

                                </div>
                              
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a>
                                        <img data-sal="fade" data-sal-delay="300" data-sal-duration="1500" src="assets/images/product/nft/product-20.jpg" alt="Product Images">
                                    </a>
                                </div>
                              
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a>
                                        <img data-sal="fade" data-sal-delay="400" data-sal-duration="1500" src="assets/images/product/nft/product-21.jpg" alt="Product Images">
                                    </a>
                                </div>
                             
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-six">
                                <div class="thumbnail">
                                    <a>
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="assets/images/product/nft/product-22.jpg" alt="Product Images">
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                      

                    </div>
                </div>
            </div>
        </div>
        <!-- End  Best Sellers Product Area  -->
                
        <!-- Start Why Choose Area  -->
        <div class="how-to-sell-area axil-section-gap" id="about_us">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper section-title-center">
                        <h2 class="title">How it works</h2>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 row--20">
                        <div class="col">
                            <div class="service-box how-to-sell">
                                <div class="icon">
                                    <img src="./assets/images/icons/choose.png" alt="Service">
                                </div>
                                <h6 class="title">Select Table</h6>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quas expedita veritatis ipsum, culpa, asperiores.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box how-to-sell">
                                <div class="icon">
                                    <img src="./assets/images/icons/protection.png" alt="Service">
                                </div>
                                <h6 class="title">Select Date</h6>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quas expedita veritatis ipsum, culpa, asperiores.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box how-to-sell">
                                <div class="icon">
                                    <img src="./assets/images/icons/purchasing.png" alt="Service">
                                </div>
                                <h6 class="title">Visit</h6>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quas expedita veritatis ipsum, culpa, asperiores.</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box how-to-sell">
                                <div class="icon">
                                    <img src="./assets/images/icons/dancing.png" alt="Service">
                                </div>
                                <h6 class="title">Enjoy!</h6>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quas expedita veritatis ipsum, culpa, asperiores.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Why Choose Area  -->


    </main>
<?php include('footer.php'); ?>
<script>
$(document).on('change', '.booking_party_size', function(e){
var party_size = $(this).find(':selected').val();
party_size <= 2 ? $('.booking_duration').val(75) : party_size <= 6 ? $('.booking_duration').val(120) : party_size <= 14 ? $('.booking_duration').val(150) : $('.booking_duration').val(180)
})
    $(document).on('click', '.add-booking', function(e){

        e.preventDefault();

        var booking_visit_time_hour = $('.booking_party_time_hour').val();
        var booking_visit_time_minutes = $('.booking_party_time_minutes').val();
        var booking_visit_date = $('.booking_visit_date').val();
        var booking_party_size = $('.booking_party_size').val();
        var booking_duration = $('.booking_duration').val();
        var booking_name = $('.booking_name').val();
        var booking_phone = $('.booking_phone').val();
        var booking_special_requirements = $('.booking_requirements').val();
        var booking_email = $('.booking_email').val();
        var access_token = "<?php echo $_SESSION['access_token']; ?>"

        if(booking_visit_date == ""  || booking_party_size == "" || booking_name == "" || booking_phone == "" || booking_email == ""){
            $('.error-message').text('All required fields are compulsary')
        } else {
            $.ajax({
            method:'post',
            url:'portal/do_booking.php',
            data:{booking_visit_time_hour:booking_visit_time_hour,booking_visit_time_minutes:booking_visit_time_minutes,booking_visit_date:booking_visit_date,booking_party_size:booking_party_size,booking_name:booking_name,booking_phone:booking_phone,booking_special_requirements:booking_special_requirements,booking_email:booking_email},
            success: function(result){
                result['response']['status'] == 'failure' ? $('.error-message').text(result['response']['message']) : ($('.add-booking').parent().addClass('d-none')+$('.hide_me').addClass('d-none')+$('.success-message').removeClass('d-none')+$('.error-message').text(''));
            }
        })

        }
    })
</script>