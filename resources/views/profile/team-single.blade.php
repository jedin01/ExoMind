<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<!-- Page Title -->
    <title>Restraint - Yoga & Meditation HTML Template</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset(\'/assets/img/favicon.png\') }}">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Sora:wght@100..800&display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="{{ asset(\'/assets/css/bootstrap.min.css\') }}" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="{{ asset(\'/assets/css/slicknav.min.css\') }}" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="{{ asset(\'/assets/css/swiper-bundle.min.css\') }}">
	<!-- Font Awesome Icon Css-->
	<link href="{{ asset(\'/assets/css/all.min.css\') }}" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="{{ asset(\'/assets/css/animate.css\') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="{{ asset(\'/assets/css/magnific-popup.css\') }}">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="{{ asset(\'/assets/css/mousecursor.css\') }}">
	<!-- Main Custom Css -->
	<link href="{{ asset(\'/assets/css/custom.css\') }}" rel="stylesheet" media="screen">
</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset(\'/assets/img/loader.svg\') }}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="./">
						<img src="{{ asset(\'/assets/img/logo.svg\') }}" alt="Logo">
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item submenu"><a class="nav-link" href="./">Home</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/index') }}">Home - Main</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/index-video') }}">Home - Video</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/index-slider') }}">Home - Slider</a></li>
                                    </ul>
                                </li>                                
                                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Pages</a>
                                    <ul>                                        
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/service-single') }}">Service Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/blog-single') }}">Blog Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/team') }}">Our Team</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/team-single') }}">Team Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/pricing') }}">Pricing Plan</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/testimonials') }}">Testimonials</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/image-gallery') }}">Image Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/video-gallery') }}">Video Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/faqs') }}">FAQs</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/404') }}">404</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact Us</a></li>
                                <li class="nav-item highlighted-menu"><a class="nav-link" href="{{ url('/book-appointment') }}">Book Appointment</a></li>                   
                            </ul>
                        </div>
                        
                        <!-- Header Contact Btn Start -->
                        <div class="header-contact-btn">
                            <a href="tel:761853398" class="header-contact-now"><i class="fa-solid fa-phone-volume"></i>761-853-398</a>
                            <a href="{{ url('/book-appointment') }}" class="btn-default">Get Started</a>
                        </div>
                        <!-- Header Contact Btn End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
	<!-- Header End -->

    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Brooklyn simmons</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/team') }}">team</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Brooklyn simmons</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Team Single Start -->
    <div class="page-team-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Team Single Box Start -->
                    <div class="page-team-single-box">
                        <!-- Team Member Info Box Start -->
                        <div class="team-member-info-box">
                            <!-- Team Member Image Start -->
                            <div class="team-member-image">
                                <figure class="image-anime">
                                    <img src="{{ asset(\'/assets/img/team-2.jpg\') }}" alt="">
                                </figure>

                                <!-- Member Social List Start -->
                                <div class="member-social-list">
                                    <h3>Follow On Social :</h3>
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>                                    								
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Member Social List End --> 
                            </div>
                            <!-- Team Member Image End -->

                            <!-- Team Member Content Start -->
                            <div class="team-member-content">
                                <!-- Member Content Header Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">About <span>me</span></h2>
                                    <p class="wow fadeInUp">Brooklyn Simmons is a dedicated Yoga and Meditation Instructor passion for guiding individuals toward holistic well-being. With years of experience in mindfulness practices, breathwork, and energy healing, she helps students cultivate inner peace, balance, and self-awareness.</p>

                                    <p class="wow fadeInUp" data-wow-delay="0.2s">Her approach combines traditional yoga techniques with modern meditation practices, creating a transformative experience for beginners and advanced practitioners alike.</p>
                                </div>
                                <!-- Member Content Header End -->

                                <!-- Member Info List Start -->
                                <div class="member-info-list wow fadeInUp" data-wow-delay="0.4s">
                                    <ul>
                                        <li>Name : <span>Darlene Robertson</span></li>
                                        <li>Experience : <span>16 years</span></li>
                                        <li>Position : <span>Yoga Therapist</span></li>
                                        <li>Phone : <span>+91 - 568 852 890</span></li>
                                        <li>E-mail : <span>domain@gmail.com</span></li>
                                        <li>Address : <span>123 High Street LA</span></li>
                                    </ul>
                                </div>
                                <!-- Member Info List End -->   
                                 
                                <!-- Member About List Start -->
                                <div class="member-about-list wow fadeInUp" data-wow-delay="0.6s">
                                    <ul>
                                        <li>Guiding You to Inner Peace</li>
                                        <li>Helping You Find Balance</li>
                                        <li>Experts in Mindfulness</li>
                                        <li>Leaders in Breathwork</li>
                                    </ul>
                                </div>
                                <!-- Member About List End -->
                            </div>
                            <!-- Team Member Content End -->
                        </div>
                        <!-- Team Member Info Box End -->

                        <!-- Team Member About Start -->
                        <div class="team-member-about">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Personals <span>info</span></h2>
                                <p class="wow fadeInUp">Brooklyn Simmons is a passionate Yoga and Meditation Instructor dedicated to helping individuals achieve balance, mindfulness, and overall well-being. With a deep-rooted love for holistic healing, she has spent years mastering various yoga disciplines, breathwork techniques, and meditation practices to guide her students toward inner peace and self-discovery.</p>

                                <p class="wow fadeInUp" data-wow-delay="0.2 s">Her journey into yoga and meditation began as a personal quest for healing and transformation, which soon evolved into a lifelong mission to inspire and uplift others. Brooklyn specializes in chakra balancing, mindfulness meditation, and restorative yoga, creating a supportive and nurturing environment for students of all levels.</p>
                            </div>
                            <!-- Section Title End -->                            
                        </div> 
                        <!-- Team Member About End -->

                        <!-- Team Member Skill Box Start -->
                        <div class="team-member-Skill-box">
                            <div class="team-member-Skill-feature">
                                <!-- Member Feature Content Start -->
                                <div class="member-feature-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">My <span>feature</span></h2>
                                        <p class="wow fadeInUp">Brooklyn Simmons is a dedicated Yoga and Meditation Instructor passion for guiding individuals toward holistic well-being.</p>
                                    </div>
                                    <!-- Section Title End -->

                                    <!-- Member About List Start -->
                                    <div class="member-about-list wow fadeInUp" data-wow-delay="0.2s">
                                        <ul>
                                            <li>Certified Expert in Yoga Practices</li>
                                            <li>Passionate About Meditation</li>
                                            <li>Guiding Your Mind and Body</li>
                                            <li>Helping You Achieve Inner Peace</li>
                                        </ul>
                                    </div>
                                    <!-- Member About List End -->
                                    
                                </div>
                                <!-- Member Feature Content End -->

                                <div class="team-member-skill-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">My <span>skills</span></h2>
                                    </div>
                                    <!-- Section Title End -->

                                    <!-- Team Skills List Start -->
                                    <div class="team-skills-list">
                                        <!-- Skills Progress Bar Start -->
                                        <div class="skills-progress-bar">
                                            <!-- Skill Item Start -->
                                            <div class="skillbar" data-percent="85%">
                                                <div class="skill-data">
                                                    <div class="skill-title">Mindfulness</div>
                                                    <div class="skill-no">85%</div>
                                                </div>
                                                <div class="skill-progress">
                                                    <div class="count-bar"></div>
                                                </div>
                                            </div>
                                            <!-- Skill Item End -->
                                        </div>
                                        <!-- Skills Progress Bar End -->

                                        <!-- Skills Progress Bar Start -->
                                        <div class="skills-progress-bar">
                                            <!-- Skill Item Start -->
                                            <div class="skillbar" data-percent="95%">
                                                <div class="skill-data">
                                                    <div class="skill-title">Relaxation</div>
                                                    <div class="skill-no">95%</div>
                                                </div>
                                                <div class="skill-progress">
                                                    <div class="count-bar"></div>
                                                </div>
                                            </div>
                                            <!-- Skill Item End -->
                                        </div>
                                        <!-- Skills Progress Bar End -->
                                    </div>
                                    <!-- Team Skills List End -->
                                </div>
                            </div>

                            <!-- Team Contact Form Start -->
                            <div class="team-contact-form contact-us-form">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">Send us a <span>message</span></h2>
                                </div>
                                <!-- Section Title End -->

                                <!-- Contact Form Start -->
                                <div class="contact-form">
                                    <!-- Contact Form Start -->
                                    <form id="contactForm" action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="row">                                
                                            <div class="form-group col-md-6 mb-4">
                                                <input type="text" name="fname" class="form-control" id="fname" placeholder="First name" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
        
                                            <div class="form-group col-md-6 mb-4">
                                                <input type="text" name="lname" class="form-control" id="lname" placeholder="Last name" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
        
                                            <div class="form-group col-md-6 mb-4">
                                                <input type="email" name ="email" class="form-control" id="email" placeholder="E-mail" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
        
                                            <div class="form-group col-md-6 mb-4">
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
        
                                            <div class="form-group col-md-12 mb-5">
                                                <textarea name="message" class="form-control" id="message" rows="3" placeholder="Write Message..."></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
        
                                            <div class="col-md-12">
                                                <button type="submit" class="btn-default">book An appointment</button>
                                                <div id="msgSubmit" class="h3 hidden"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Contact Form End -->
                                </div>
                                <!-- Contact Form End -->
                            </div>
                            <!-- Team Contact Form End -->
                        </div>
                        <!-- Team Member Skill Box End -->
                    </div>
                    <!-- Page Team Single Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Team Single End -->


    <!-- Footer Main Start -->
    <footer class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Footer Header Start -->
                    <div class="footer-header">
                        <!-- Footer About Start -->
                        <div class="footer-about">
                            <div class="footer-logo">
                                <img src="{{ asset(\'/assets/img/footer-logo.svg\') }}" alt="">
                            </div>
                            <div class="about-footer-content">
                                <p>Holistic practices for inner peace, focus, and overall well-being.</p>
                            </div>
                        </div>
                        <!-- Footer About End -->
                        
                        <!-- Footer Social Links Start -->
                        <div class="footer-social-links">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Links End -->
                    </div>
                    <!-- Footer Header End -->
                </div>

                <div class="col-lg-2 col-md-3">
                    <!-- Footer Links Start -->
                    <div class="footer-links">
                        <h3>Quick link</h3>
                        <ul>
                            <li><a href="{{ url('/index') }}">Home</a></li>
                            <li><a href="{{ url('/about') }}">About us</a></li>
                            <li><a href="{{ url('/services') }}">Services</a></li>
                            <li><a href="{{ url('/blog') }}">Blogs</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->
                </div>

                <div class="col-lg-2 col-md-4">
                    <!-- Footer Links Start -->
                    <div class="footer-links">
                        <h3>services</h3>
                        <ul>
                            <li><a href="{{ url('/service-single') }}">Beginner yoga classes</a></li>
                            <li><a href="{{ url('/service-single') }}">Stress relief sessions</a></li>
                            <li><a href="{{ url('/service-single') }}">Mindful meditation</a></li>
                            <li><a href="{{ url('/service-single') }}"> Restorative Yoga</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->
                </div>

                <div class="col-lg-3 col-md-5">
                    <!-- Footer Contact Links Start -->
                    <div class="footer-links footer-contact-links">
                        <h3>Contact</h3>
                        <ul>
                            <li><a href="tel:761852398">(0) - 0761-852-398</a></li>
                            <li><a href="info@domainname.com">info@domainname.com</a></li>
                            <li>123 High Street LN1 1AB United Kingdom</li>
                        </ul>
                    </div>
                    <!-- Footer Contact Links End -->
                </div>
                
                <div class="col-lg-5">
                    <!-- Footer Newsletter Box Start -->
                    <div class="footer-newsletter-box">
                        <!-- Footer Newsletter Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Subscribe for Yoga Tips and Inspiration</h2>
                        </div>
                        <!-- Footer Newsletter Title End -->

                        <!-- Newsletter Form start -->
                        <div class="newsletter-form">
                            <form id="newsletterForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="mail" placeholder="Enter Your Email" required>
                                    <button type="submit" class="newsletter-btn"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Newsletter Form end -->
                    </div>
                    <!-- Footer Newsletter Box End -->
                </div>
                
                <div class="col-lg-12">
                    <!-- Footer Copyright Section Start -->
                    <div class="footer-copyright">
                        <!-- Footer Copyright Text Start -->
                        <div class="footer-copyright-text">
                            <p>Copyright © 2025 All Rights Reserved.</p>
                        </div>
                        <!-- Footer Copyright Text End -->
                            
                        <!-- Footer Privacy Policy Start -->
                        <div class="footer-privacy-policy">
                            <ul>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Term's & condition</a></li>
                                <li><a href="#">help</a></li>
                            </ul>
                        </div>
                        <!-- Footer Privacy Policy End -->
                    </div>
                    <!-- Footer Copyright Section End -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Main End -->

    <!-- Jquery Library File -->
    <script src="{{ asset(\'/assets/js/jquery-3.7.1.min.js\') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset(\'/assets/js/bootstrap.min.js\') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset(\'/assets/js/validator.min.js\') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset(\'/assets/js/jquery.slicknav.js\') }}"></script>
    <!-- Swiper js file -->
    <script src="{{ asset(\'/assets/js/swiper-bundle.min.js\') }}"></script>
    <!-- Counter js file -->
    <script src="{{ asset(\'/assets/js/jquery.waypoints.min.js\') }}"></script>
    <script src="{{ asset(\'/assets/js/jquery.counterup.min.js\') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset(\'/assets/js/jquery.magnific-popup.min.js\') }}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset(\'/assets/js/SmoothScroll.js\') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset(\'/assets/js/parallaxie.js\') }}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset(\'/assets/js/gsap.min.js\') }}"></script>
    <script src="{{ asset(\'/assets/js/magiccursor.js\') }}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset(\'/assets/js/SplitText.js\') }}"></script>
    <script src="{{ asset(\'/assets/js/ScrollTrigger.min.js\') }}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset(\'/assets/js/jquery.mb.YTPlayer.min.js\') }}"></script>
    <!-- Wow js file -->
    <script src="{{ asset(\'/assets/js/wow.min.js\') }}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset(\'/assets/js/function.js\') }}"></script>
</body>
</html>
