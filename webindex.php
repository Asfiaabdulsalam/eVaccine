<?php
require('inc.connection.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: admin/login.php");
  exit;
}

$success = '';
$error = '';

$parent_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register_child'])) {
  $child_name = safe_input($_POST['child_name']);
  $dob = safe_input($_POST['dob']);
  $gender = safe_input($_POST['gender']);
  $blood_group = safe_input($_POST['blood_group']);

  $sql = "INSERT INTO children (parent_id, name, date_of_birth, gender, blood_group)
          VALUES ('$parent_id', '$child_name', '$dob', '$gender', '$blood_group')";

  if (mysqli_query($conn, $sql)) {
    $success = "Child registered successfully.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }
}


//  Booking Request Form Submission ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_booking'])) {
  $child_id = safe_input($_POST['child_id']);
  $vaccine_id = safe_input($_POST['vaccine_id']);
  $hospital_id = safe_input($_POST['hospital_id']);
  $preferred_date = safe_input($_POST['preferred_date']);
  $status = 'Pending';

  $parent_id = $_SESSION['user_id'];

  $sql = "INSERT INTO booking_requests (parent_id, child_id, vaccine_id, hospital_id, preferred_date, status)
          VALUES ('$parent_id', '$child_id', '$vaccine_id', '$hospital_id', '$preferred_date', '$status')";

  if (mysqli_query($conn, $sql)) {
    $success = "booking request submmited successfully.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }
}


// Fetch children, vaccines, hospitals for dropdowns
$children = [];
$child_result = mysqli_query($conn, "SELECT id, name FROM children WHERE parent_id = $parent_id");
while ($row = mysqli_fetch_assoc($child_result)) {
  $children[] = $row;
}

$vaccines = [];
$vaccine_result = mysqli_query($conn, "SELECT id, name FROM vaccines");
while ($row = mysqli_fetch_assoc($vaccine_result)) {
  $vaccines[] = $row;
}

$hospitals = [];
$hospital_result = mysqli_query($conn, "SELECT id, name FROM hospitals");
while ($row = mysqli_fetch_assoc($hospital_result)) {
  $hospitals[] = $row;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - soft dose</title>
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
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#about" class="active">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#register-child">Register-child</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn" href="#appointment">Make an Appointment</a>
        <a class="cta-btn" href="admin/login.php">Sign in</a>
      </div>


    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-item active">
          <img src="assets/img/2df3d422-133f-43ff-bd56-db49c73b6253.jpg" alt="">
          <div class="container">
            <h2>Welcome to Soft Dose</h2>
            <p>At Soft Dose, we are dedicated to providing reliable and high-quality healthcare services tailored to each
              patient's needs. Whether it’s preventive care, diagnosis, or treatment, our expserienced team is here to
              guide you every step of the way. Your health is our top priority.</p>
            <a href="#about" class="btn-get-started">About Us</a>
          </div>
        </div><!-- End Carousel Item -->
        <div class="carousel-item">
          <img src="assets/img/3f8b6c59-8a70-48e7-aa6e-5ad883d46d87.jpg" alt="">
          <div class="container">
            <h2>Welcome to Soft Dose</h2>
            <p>At Soft Dose, we are dedicated to providing reliable and high-quality healthcare services tailored to each
              patient's needs. Whether it’s preventive care, diagnosis, or treatment, our expserienced team is here to
              guide you every step of the way. Your health is our top priority.</p>
            <a href="#about" class="btn-get-started">About Us</a>
          </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
          <img src="assets/img/c0a26ca2-705d-4b47-975c-595d8b8832a6.jpg" alt="">
          <div class="container">
            <h2>Welcome to Soft Dose</h2>
            <p>At Soft Dose, we are dedicated to providing reliable and high-quality healthcare services tailored to each
              patient's needs. Whether it’s preventive care, diagnosis, or treatment, our expserienced team is here to
              guide you every step of the way. Your health is our top priority.</p>
            <a href="#about" class="btn-get-started">About Us</a>
          </div>
        </div><!-- End Carousel Item -->

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-heartbeat icon"></i></div>
              <h4><a href="" class="stretched-link">Child's Heartbeat and Clarification About Vaccines</a></h4>
              <p>A child’s heartbeat is a natural and continuous process that reflects the health of the heart. If a
                child's heartbeat is abnormal. </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-pills icon"></i></div>
              <h4><a href="" class="stretched-link">Vaccination Services at Medicio</a></h4>
              <p>At Medicio, we provide safe, certified, and internationally standardized vaccination services for both
                children and adults. Our goal is to deliver timely and effective vaccines to help every individual live
                a healthy life.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-thermometer icon"></i></div>
              <h4><a href="" class="stretched-link">Vaccination and Temperature Monitoring</a></h4>
              <p>Vaccination plays a vital role in protecting children and adults from harmful infectious diseases.
                Before administering any vaccine, it is essential to check the patient's body temperature using a
                medical thermometer to ensure they are not experiencing fever or illness.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-dna icon"></i></div>
              <h4><a href="" class="stretched-link">DNA & Genetic Health Awareness</a></h4>
              <p>The DNA icon represents the foundation of life — our genetic code. In modern medicine, DNA plays a
                crucial role in diagnosing hereditary diseases, developing personalized treatments, and advancing
                vaccine technologies. </p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>In an emergency? Need help now?</h3>
              <p> If you or someone around you is facing a medical emergency, immediate help is available. Don't
                wait—call emergency services or visit the nearest hospital right away. Our team is prepared to provide
                urgent care for injuries, sudden illness, or life-threatening conditions. Your safety is our top
                priority.


              </p>
              <a class="cta-btn" href="#appointment">Make an Appointment</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
      </div><!-- End Section Title -->



      <!-- Stats Section -->
      <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
              <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="fas fa-user-md flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1"
                    class="purecounter"></span>
                  <p>Doctors</p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="far fa-hospital flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1"
                    class="purecounter"></span>
                  <p>Departments</p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="fas fa-flask flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1"
                    class="purecounter"></span>
                  <p>Research Labs</p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="fas fa-award flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                    class="purecounter"></span>
                  <p>Awards</p>
                </div>
              </div>
            </div><!-- End Stats Item -->

          </div>

        </div>

      </section><!-- /Stats Section -->


      <section class="section light-background" id="register-child">
        <div class="container section-title" data-aos="fade-up">
          <h2>Register Child</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <form method="POST">
            <div class="row">
              <!-- Child Name -->
              <div class="col-md-4 form-group">
                <input type="text" name="child_name" class="form-control" placeholder="Child Name" required>
              </div>

              <!-- Date of Birth -->
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <input type="date" name="dob" class="form-control" required>
              </div>

              <!-- Gender -->
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <select name="gender" class="form-select" required>
                  <option disabled selected value="">Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>

            <!-- Blood Group -->
            <div class="row mt-3">
              <div class="col-md-6 form-group">
                <select name="blood_group" class="form-select" required>
                  <option disabled selected value="">Select Blood Group</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
              <button class="btn" type="submit" name="register_child">Register Child</button>
            </div>
          </form>
        </div>
      </section>


      <!-- Appointment Section -->
      <section class="section light-background" id="appointment">
        <div class="container section-title" data-aos="fade-up">
          <h2>Book a Vaccine Appointment</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <form method="POST">
            <div class="row">
              <div class="col-md-4 form-group">
                <select name="child_id" class="form-select" required>
                  <option value="">Select Child</option>
                  <?php foreach ($children as $child): ?>
                    <option value="<?= $child['id'] ?>"><?= htmlspecialchars($child['name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-4 form-group mt-3 mt-md-0">
                <select name="vaccine_id" class="form-select" required>
                  <option value="">Select Vaccine</option>
                  <?php foreach ($vaccines as $vaccine): ?>
                    <option value="<?= $vaccine['id'] ?>"><?= htmlspecialchars($vaccine['name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-4 form-group mt-3 mt-md-0">
                <select name="hospital_id" class="form-select" required>
                  <option value="">Select Hospital</option>
                  <?php foreach ($hospitals as $hospital): ?>
                    <option value="<?= $hospital['id'] ?>"><?= htmlspecialchars($hospital['name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-6 form-group">
                <input type="datetime-local" name="preferred_date" class="form-control" required>
              </div>
            </div>

            <div class="text-center mt-4">
              <button class="btn" type="submit" name="submit_booking">Submit Appointment</button>
            </div>
          </form>
        </div>
      </section><!-- /Appointment Section -->

      <!-- Tabs Section -->
      <section id="tabs" class="tabs section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>HOSPITALS</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row">
            <div class="col-lg-3">
              <ul class="nav nav-tabs flex-column">
                <li class="nav-item">
                  <a class="nav-link active show" data-bs-toggle="tab" href="#tabs-tab-1">South City </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-2">Agha Khan </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-3">PNS Shifa</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-9 mt-4 mt-lg-0">
              <div class="tab-content">
                <div class="tab-pane active show" id="tabs-tab-1">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>South City</h3>
                      <p class="fst-italic">Ground Floor, South City Hospital
                        Timings: 9:00 AM to 6:00 PM (daily, except weekends)</p>
                      <p>Nature of Service:
                        Various types of vaccines are provided at private charges depending on availability, and a
                        vaccination card is issued by the hospital – however, it is not registered or certified by
                        NADRA.</p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-tab-2">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Agha Khan</h3>
                      <p class="fst-italic">The hospital operates with approximately 560 beds, including private,
                        semi‑private, general wards, as well as ICU, CCU, and NICU units. On average, patient stays
                        around 4 days— among the lowest in the region
                        Wikipedia.
                      </p>
                      <p>There are 17 main operating theatres, plus additional surgical day-care suites across
                        departments, including OB/GYN day‑care units
                        Wikipedia.</p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-tab-3">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>PNS shifa</h3>
                      <p class="fst-italic">The hospital currently accommodates over 800 beds and treats hundreds of
                        thousands of patients annually including both military personnel and civilians.</p>
                      <p>Open to both service personnel and civilian patients. Consultation fees for specialist clinics
                        are around PKR 2,000, with appointments available Monday–Friday evenings. </p>
                    </div>

                  </div>
                </div>
                <div class="tab-pane" id="tabs-tab-4">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Pediatrics</h3>
                      <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis
                        delectus</p>
                      <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus
                        aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi
                        asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-tab-5">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Ophthalmologists</h3>
                      <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                      <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut
                        quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae
                        molestiae voluptate vel</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </section><!-- /Tabs Section -->
      <!-- Faq Section -->
      <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Frequently Asked Questions</h2>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row justify-content-center">

            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

              <div class="faq-container">

                <div class="faq-item">
                  <h3>Which vaccines are necessary for my child?</h3>
                  <div class="faq-content">
                    <p>According to the routine immunization schedule, the following vaccines are necessary for every
                      child:
                      <br>
                      BCG (for tuberculosis) , Hepatitis B , Polio (OPV/IPV) , DTP (Diphtheria, Tetanus, Pertussis) ,
                      Hib (Haemophilus influenzae type b)
                      MMR (Measles, Mumps, Rubella) , Rotavirus , Pneumococcal , Typhoid , Chickenpox , Hepatitis A
                      (optional)
                    </p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                  <h3>At what age should the first vaccine be given?</h3>
                  <div class="faq-content">
                    <p>The first vaccines—BCG, OPV zero dose, and Hepatitis B—should be given immediately after birth or
                      within the first 24 hours.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                  <h3> What should I do if a vaccine dose is missed?</h3>
                  <div class="faq-content">
                    <p>If a vaccine dose is missed, don’t worry. Contact your doctor as soon as possible. The missed
                      dose can be administered according to a catch-up schedule. Being late doesn’t mean the vaccine
                      becomes ineffective.

                    </p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                  <h3> Is it normal for a child to have fever after vaccination?</h3>
                  <div class="faq-content">
                    <p>Yes, mild fever, tiredness, or pain/swelling at the injection site is common after vaccination.
                      These are signs that the immune system is responding to the vaccine.

                    </p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                  <h3>Are vaccines safe for children with allergies?</h3>
                  <div class="faq-content">
                    <p>Most vaccines are safe even for children with allergies. However, if your child has a known
                      allergy to specific substances (like eggs or gelatin), inform your doctor before vaccination.

                    </p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                  <h3>Is the vaccination certificate required for school admission?</h3>
                  <div class="faq-content">
                    <p>Yes, most schools require a child’s immunization record or vaccination certificate at the time of
                      admission. It is important to maintain proper documentation.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

              </div>

            </div><!-- End Faq Column-->

          </div>

        </div>

      </section><!-- /Faq Section -->

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