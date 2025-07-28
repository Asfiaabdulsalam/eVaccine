<?php
include('inc.connection.php');

$sql = "SELECT 
            br.*, 
            u.name AS parent_name, 
            c.name AS child_name, 
            v.name AS vaccine_name, 
            h.name AS hospital_name
        FROM booking_requests br
        LEFT JOIN users u ON br.parent_id = u.id
        LEFT JOIN children c ON br.child_id = c.id
        LEFT JOIN vaccines v ON br.vaccine_id = v.id
        LEFT JOIN hospitals h ON br.hospital_id = h.id
        WHERE br.hospital_id = 1";


$result = mysqli_query($conn, $sql);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>agha-khan</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!--  App Topstrip -->
<div class="app-topstrip py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between"
     style="background-color: #b6e2e4; align-items: center; height: 70px;">  
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./webindex.php" class="text-nowrap logo-img">
          <img src="assets/images/logos/7e06b2c1-8c53-45c0-bd0c-e7c613a0910d-removebg-preview.png" alt="" />
        </a>
      </div>              
      <!-- Sliding Text -->
      <div class="flex-grow-1 justify-content-end">
       <div class="text-slide-container" style="width: 100%; max-width: 1300px; overflow: hidden; position: relative;">
        <div class="text-slide-content"
          style="white-space: nowrap; display: inline-block; animation: slideText 20s linear infinite; padding-left: 50px;">
          <span style="font-size: 18px; font-weight: 600; color: #025f66; margin-right: 90px;">
            Welcome to the Admin Panel — Efficiently Manage E-Vaccination Records with Confidence and Control.
          </span>
        </div>
      </div>
    </div>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">               
        <li class="nav-item dropdown">
          <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Profile</p>
              </a>
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-mail fs-6"></i>
                <p class="mb-0 fs-3">My Account</p>
              </a>
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-list-check fs-6"></i>
                <p class="mb-0 fs-3">My Task</p>
              </a>
              <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
    <style>
      @keyframes slideText {
        0% { transform: translateX(70%); }   /* start slightly more to the right */
        100% { transform: translateX(-100%); }
      }

      .brand-logo img{
        height: 170px;
        margin-bottom: -30px;
        margin-left: -40px;
        margin-top: -30px;
        padding: 10px 10px;
      }
      </style>
        <!-- Sidebar Start -->
        <aside class="left-sidebar" style="margin-top: 6px;">
            <!-- Sidebar scroll-->
            <div>

                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="south-city.php" aria-expanded="false">
                                <i class="ti ti-atom"></i>
                                <span class="hide-menu">Vaccine-Reservation</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="south-schedule.php" aria-expanded="false">
                                <i class="ti ti-atom"></i>
                                <span class="hide-menu">Schedule</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->

            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row" style="margin-top: -30px;">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">VACCINE RESERVATION</h4>
                                            <!-- <p class="card-subtitle">
                        Ample Admin Vs Pixel Admin
                      </p> -->
                                        </div>

                                    </div>
                                    <div class="table-responsive mt-4">
                                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-3 text-muted">Parent_name</th>
                                                    <th scope="col" class="px-3 text-muted">Child_name</th>
                                                    <th scope="col" class="px-3 text-muted">Vaccine_name</th>
                                                    <th scope="col" class="px-3 text-muted">Hospital_name</th>
                                                    <th scope="col" class="px-3 text-muted">Preferred_date</th>
                                                    <th scope="col" class="px-3 text-muted">Status</th>
                                                    <th scope="col" class="px-3 text-muted">Requested_At</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td class="px-3"><?php echo $row['parent_name']; ?></td>
                                                        <td class="px-3"><?php echo $row['child_name']; ?></td>
                                                        <td class="px-3"><?php echo $row['vaccine_name']; ?></td>
                                                        <td class="px-3"><?php echo $row['hospital_name']; ?></td>
                                                        <td class="px-3"><?php echo $row['preferred_date']; ?></td>
                                                        <td class="px-3"><?php echo $row['status']; ?></td>
                                                        <td class="px-3"><?php echo $row['requested_at']; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="./assets/js/dashboard.js"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>