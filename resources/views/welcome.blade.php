<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <!--Page Title-->
    <title>Yaka-Opt</title>

    <!--Meta Keywords and Description-->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" title="Favicon"/>

    <!-- Main CSS Files -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Namari Color CSS -->
    <link rel="stylesheet" href="css/namari-color.css">

    <!--Icon Fonts - Font Awesome Icons-->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Animate CSS-->
    <link href="css/animate.css" rel="stylesheet" type="text/css">

    <!--Google Webfonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status" class="la-ball-triangle-path">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!--End of Preloader-->

<div class="page-border" data-wow-duration="0.7s" data-wow-delay="0.2s">
    <div class="top-border wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"></div>
    <div class="right-border wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;"></div>
    <div class="bottom-border wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>
    <div class="left-border wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>
</div>

<div id="wrapper">

    <header id="banner" class="scrollto clearfix" data-enllax-ratio=".5">
        <div id="header" class="nav-collapse">
            <div class="row clearfix">
                <div class="col-1">

                    <!--Logo-->
                    <div id="logo">

                        <!--Logo that is shown on the banner-->
                        <!-- <img src="images/logo.png" id="banner-logo" alt="Landing Page"/> -->
                        <!--End of Banner Logo-->

                        <!--The Logo that is shown on the sticky Navigation Bar-->
                        <!-- <img src="images/logo-2.png" id="navigation-logo" alt="Landing Page"/> -->
                        <!--End of Navigation Logo-->

                    </div>
                    <!--End of Logo-->

                    <aside>
 <!-- Add Laravel login/register functionality -->
 @if (Route::has('login'))
                                @auth
                                    <li>
                                        <a href="{{ url('/dashboard') }}" class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">Dashboard</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}" class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">Log in</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}" class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">Register</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif



                        <!--Social Icons in Header-->
                        <ul class="social-icons">

                            <!-- <li>
                                <a target="_blank" title="Facebook" href="https://www.facebook.com/username">
                                    <i class="fa fa-facebook fa-1x"></i><span>Facebook</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="Google+" href="http://google.com/+username">
                                    <i class="fa fa-google-plus fa-1x"></i><span>Google+</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="Twitter" href="http://www.twitter.com/username">
                                    <i class="fa fa-twitter fa-1x"></i><span>Twitter</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="Instagram" href="http://www.instagram.com/username">
                                    <i class="fa fa-instagram fa-1x"></i><span>Instagram</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="behance" href="http://www.behance.net">
                                    <i class="fa fa-behance fa-1x"></i><span>Behance</span>
                                </a>
                            </li> -->


                        </ul>
                        <!--End of Social Icons in Header-->

                    </aside>

                    <!--Main Navigation-->
                    <nav id="nav-main">
                        <ul>
                            <li>
                                <a href="#banner">Home</a>
                            </li>
                            <li>
                                <a href="#about">About</a>
                            </li>
                            <li>
                                <a href="#gallery">Gallery</a>
                            </li>
                            <li>
                                <a href="#services">Services</a>
                            </li>
                            <li>
                                <a href="#testimonials">Testimonials</a>
                            </li>
                            <li>
                                <a href="#clients">Clients</a>
                            </li>
                    </nav>
                    <!--End of Main Navigation-->

                    <div id="nav-trigger"><span></span></div>
                    <nav id="nav-mobile"></nav>

                </div>
            </div>
        </div><!--End of Header-->

<!--Banner Content-->
<div id="banner-content" class="row clearfix">
    <div class="col-38">
        <div class="section-heading">
            <h1>AI-DRIVEN ENERGY OPTIMIZATION</h1>
            <h2>Your solution for sustainable, cost-effective, and reliable electricity management in Uganda.</h2>
        </div>
        <!--Call to Action-->
        <a href="#" class="button">LEARN MORE</a>
        <!--End Call to Action-->
    </div>
</div>
<!--End of Row-->
    </header>

    <!--Main Content Area-->
    <main id="content">

<!--Introduction-->
<section id="about" class="introduction scrollto">
    <div class="row clearfix">
        <div class="col-3">
            <div class="section-heading">
                <h3>ABOUT THE PROJECT</h3>
                <h2 class="section-title">Revolutionizing Electricity Management</h2>
                <p class="section-subtitle">The AI-Driven Predictive Power Management System helps households optimize energy usage with AI and IoT solutions.</p>
            </div>
        </div>

        <div class="col-2-3">
            <!--Icon Block-->
            <div class="col-2 icon-block icon-top wow fadeInUp" data-wow-delay="0.1s">
                <div class="icon">
                    <i class="fa fa-plug fa-2x"></i>
                </div>
                <div class="icon-block-description">
                    <h4>Smart Monitoring</h4>
                    <p>Our system uses IoT devices like smart plugs to track and monitor your electricity consumption in real time.</p>
                </div>
            </div>
            <!--End of Icon Block-->

            <!--Icon Block-->
            <div class="col-2 icon-block icon-top wow fadeInUp" data-wow-delay="0.3s">
                <div class="icon">
                    <i class="fa fa-line-chart fa-2x"></i>
                </div>
                <div class="icon-block-description">
                    <h4>Predictive Analytics</h4>
                    <p>Leverage AI-driven forecasts to anticipate usage patterns and make data-informed decisions.</p>
                </div>
            </div>
            <!--End of Icon Block-->

            <!--Icon Block-->
            <div class="col-2 icon-block icon-top wow fadeInUp" data-wow-delay="0.5s">
                <div class="icon">
                    <i class="fa fa-leaf fa-2x"></i>
                </div>
                <div class="icon-block-description">
                    <h4>Energy Sustainability</h4>
                    <p>Promote sustainability by reducing waste and conserving resources for a better environment.</p>
                </div>
            </div>
            <!--End of Icon Block-->

            <!--Icon Block-->
            <div class="col-2 icon-block icon-top wow fadeInUp" data-wow-delay="0.7s">
                <div class="icon">
                    <i class="fa fa-money fa-2x"></i>
                </div>
                <div class="icon-block-description">
                    <h4>Cost Savings</h4>
                    <p>Save money with actionable recommendations for optimizing electricity consumption and reducing outages.</p>
                </div>
            </div>
            <!--End of Icon Block-->
        </div>
    </div>
</section>
<!--End of Introduction-->

        <!--Gallery-->
        <aside id="gallery" class="row text-center scrollto clearfix" data-featherlight-gallery
                 data-featherlight-filter="a">

                <a href="images/gallery-images/gallery-image-1.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="0.1s"><img src="images/gallery-images/gallery-image-1.jpg" alt="Landing Page"/></a>
                <a href="images/gallery-images/gallery-image-2.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="0.3s"><img src="images/gallery-images/gallery-image-2.jpg" alt="Landing Page"/></a>
                <a href="images/gallery-images/gallery-image-3.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="0.5s"><img src="images/gallery-images/gallery-image-3.jpg" alt="Landing Page"/></a>
                <a href="images/gallery-images/gallery-image-4.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="1.1s"><img src="images/gallery-images/gallery-image-4.jpg" alt="Landing Page"/></a>
                <a href="images/gallery-images/gallery-image-5.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="0.9s"><img src="images/gallery-images/gallery-image-5.jpg" alt="Landing Page"/></a>
                <a href="images/gallery-images/gallery-image-6.jpg" data-featherlight="image" class="col-3 wow fadeIn"
                   data-wow-delay="0.7s"><img src="images/gallery-images/gallery-image-6.jpg" alt="Landing Page"/></a>

        </aside>
        <!--End of Gallery-->


        <!--Content Section-->
<div id="services" class="scrollto clearfix">
    <div class="row no-padding-bottom clearfix">
        <!--Content Left Side-->
        <div class="col-3">
            <!--User Testimonial-->
            <blockquote class="testimonial text-right bigtest">
                <q>"The AI-powered system transformed how we manage electricity. No more surprise outages, and we've saved so much money!"</q>
                <footer>— Jane Doe, Ugandan Household</footer>
            </blockquote>
            <!-- End of Testimonial-->
        </div>
        <!--End Content Left Side-->

        <!--Content Right Side-->
        <div class="col-3">
            <div class="section-heading">
                <h3>OUR MISSION</h3>
                <h2 class="section-title">Empowering Energy Efficiency</h2>
                <p class="section-subtitle">We strive to align with Uganda’s development goals by creating solutions that empower households and stakeholders.</p>
            </div>
            <p>The system integrates seamlessly with Umeme Yaka prepaid meters, offering real-time insights and recommendations to optimize energy use. Join us in conserving resources and achieving economic savings for a sustainable future.</p>
            <a href="#" class="button video link-lightbox">WATCH HOW IT WORKS <i class="fa fa-play" aria-hidden="true"></i></a>
        </div>
        <!--End Content Right Side-->

        <div class="col-3">
            <img src="images/smart-electricity.jpg" alt="Smart Electricity Management" />
        </div>
    </div>
</div>
<!--End of Content Section-->


<!--Testimonials-->
<aside id="testimonials" class="scrollto text-center" data-enllax-ratio=".2">
    <div class="row clearfix">
        <div class="section-heading">
            <h3>FEEDBACK</h3>
            <h2 class="section-title">What our users are saying</h2>
        </div>

        <!--User Testimonial-->
        <blockquote class="col-3 testimonial classic">
            <img src="images/user-images/user-1.jpg" alt="User"/>
            <q>"Thanks to the AI-Driven Predictive Power Management System, I've reduced my electricity bills and gained better control over my energy usage."</q>
            <footer>Mary N., Kampala Resident</footer>
        </blockquote>
        <!-- End of Testimonial-->

        <!--User Testimonial-->
        <blockquote class="col-3 testimonial classic">
            <img src="images/user-images/user-2.jpg" alt="User"/>
            <q>"The real-time insights and recommendations have made it so much easier to manage my prepaid electricity. It's a game-changer!"</q>
            <footer>Samuel T., Ugandan Household</footer>
        </blockquote>
        <!-- End of Testimonial-->

        <!--User Testimonial-->
        <blockquote class="col-3 testimonial classic">
            <img src="images/user-images/user-3.jpg" alt="User"/>
            <q>"I never realized how much energy I was wasting before. This system has helped me become more sustainable and save money."</q>
            <footer>Agnes K., Small Business Owner</footer>
        </blockquote>
        <!-- End of Testimonial-->
    </div>
</aside>
<!--End of Testimonials-->
       <!--Clients-->
<section id="clients" class="scrollto clearfix">
    <div class="row clearfix">
        <div class="col-3">
            <div class="section-heading">
                <h3>TRUST</h3>
                <h2 class="section-title">Organizations Empowered by Our System</h2>
                <p class="section-subtitle">Our solution is trusted by various organizations and stakeholders committed to sustainable energy management.</p>
            </div>
        </div>

        <div class="col-2-3">
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo1.png" alt="Company"/>
                <div class="client-overlay"><span>Green Energy Uganda</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo2.png" alt="Company"/>
                <div class="client-overlay"><span>Eco Power Solutions</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo3.png" alt="Company"/>
                <div class="client-overlay"><span>Umeme Partners</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo4.png" alt="Company"/>
                <div class="client-overlay"><span>Sustainable Tech Group</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo5.png" alt="Company"/>
                <div class="client-overlay"><span>Future Energy Initiatives</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo6.png" alt="Company"/>
                <div class="client-overlay"><span>Uganda Energy Commission</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo7.png" alt="Company"/>
                <div class="client-overlay"><span>Smart Power Advocates</span></div>
            </a>
            <a href="#" class="col-3">
                <img src="images/company-images/company-logo8.png" alt="Company"/>
                <div class="client-overlay"><span>Clean Energy Uganda</span></div>
            </a>
        </div>
    </div>
</section>
<!--End of Clients-->
    </main>
    <!--End Main Content Area-->
    <!--Footer-->
    <footer id="landing-footer" class="clearfix">
        <div class="row clearfix">

            <p id="copyright" class="col-2">Made with love by <a href="https://www.shapingrain.com">ShapingRain</a></p>

            <!--Social Icons in Footer-->
            <ul class="col-2 social-icons">
                <li>
                    <a target="_blank" title="Facebook" href="https://www.facebook.com/username">
                        <i class="fa fa-facebook fa-1x"></i><span>Facebook</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" title="Google+" href="http://google.com/+username">
                        <i class="fa fa-google-plus fa-1x"></i><span>Google+</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" title="Twitter" href="http://www.twitter.com/username">
                        <i class="fa fa-twitter fa-1x"></i><span>Twitter</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" title="Instagram" href="http://www.instagram.com/username">
                        <i class="fa fa-instagram fa-1x"></i><span>Instagram</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" title="behance" href="http://www.behance.net">
                        <i class="fa fa-behance fa-1x"></i><span>Behance</span>
                    </a>
                </li>
            </ul>
            <!--End of Social Icons in Footer-->
        </div>
    </footer>
    <!--End of Footer-->
</div>

<script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/07/06/20250107061331-AMCAOKBZ.js"></script>

<!-- Include JavaScript resources -->
<script src="js/jquery.1.8.3.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/featherlight.min.js"></script>
<script src="js/featherlight.gallery.min.js"></script>
<script src="js/jquery.enllax.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.stickyNavbar.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/images-loaded.min.js"></script>
<script src="js/lightbox.min.js"></script>
<script src="js/site.js"></script>


</body>
</html>
