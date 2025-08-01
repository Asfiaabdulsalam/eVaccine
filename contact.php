<?php
require('inc.connection.php');

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $parent_name = $_POST['parent_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $insert = "INSERT INTO parent_requests (parent_name, email, phone, message) 
             VALUES ('$parent_name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $insert)) {
        $success = "Your message has been sent successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Medicio Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/logo.jpg" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medicio
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


    <style>
        .btn {
            background-color: #3FBBC0;
            color: white;
        }

        .btn:hover {
            background-color: #76d0d6ff;
            color: white;
        }

        .loading,
        .error-message,
        .sent-message {
            display: none;
            /* hidden by default */
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .error-message {
            color: #fff;
            background: #ed3c0d;
            padding: 10px;
        }

        .sent-message {
            color: #fff;
            background: #18d26e;
            padding: 10px;
        }

        .text-center.mb-2 button {
            background: #3FBBC0;
            border: none;
            padding: 10px 25px;
            border-radius: 4px;
            color: #fff;
        }

        .text-center.mb-2 button:hover {
            background: #76d0d6ff;
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="branding d-flex align-items-center">

            <div class="container position-relative d-flex align-items-center justify-content-end">
                <a href="index.html" class="logo d-flex flex-column align-items-center me-auto">
                    <img src="admin/assets/images/logos/78a5fbc7-6bd6-4c64-a8fc-3b73e001733e.png-removebg-preview.png" alt="" style="height: 100px; width: auto;">
                    <span class="sitename mt-1">Safe Dose</span>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="webindex.php#hero" class="active">Home</a></li>
                        <li><a href="webindex.php#about" class="active">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="webindex.php#register-child">Register-child</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

                <a class="cta-btn" href="webindex.php#appointment">Make an Appointment</a>
                <a class="cta-btn" href="admin/login.php">Sign in</a>
            </div>


        </div>

    </header>

    <main class="main">

        <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>"Have questions? Contact us today – we're here to help!""Have questions? Contact us today – we're here to help!"</p>
            </div><!-- End Section Title -->

            <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                <iframe style="border:0; width: 100%; height: 370px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.7617420036386!2d67.05919639999999!3d24.871985799999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33eeca8432bf5%3A0x81dece3730c9b1c5!2sAptech%20Computer%20Education%20Tariq%20Road!5e0!3m2!1sen!2s!4v1753879457747!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-6 ">
                         <div class="row gy-4">

                <div class="col-lg-12">
                  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Address</h3>
                    <p>Aptect Tariq Raod Karachi</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="col-md-6">
                  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="300">
                    <i class="bi bi-telephone"></i>
                    <h3>Call Us</h3>
                    <p>+1 5589 55488 55</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="col-md-6">
                  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                    data-aos-delay="400">
                    <i class="bi bi-envelope"></i>
                    <h3>Email Us</h3>
                    <p>Aptech@gmail.com</p>
                  </div>
                </div><!-- End Info Item -->

              </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="contact.php" method="post">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" id="parent_name" name="parent_name" class="form-control" placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone no" required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center mb-2">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit" name="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                        <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
                        <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section>

    </main>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Soft Dose</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Aptect Tariq Road</p>
                        <p><strong>Email:</strong> <span>Aptech@gmail.com</span></p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>

                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>


            </div>
        </div>
        <div class="container text-center py-3 mt-3 border-top">
            <p class="mb-0">&copy; 2025 <strong>Safe Dose</strong>. All Rights Reserved.</p>
        </div>


    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>