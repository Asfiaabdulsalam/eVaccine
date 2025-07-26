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
        WHERE br.hospital_id = 3";


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

        <!-- Sidebar Start -->
        <aside class="left-sidebar">
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
                            <a class="sidebar-link" href="pns-shifa.php" aria-expanded="false">
                                <i class="ti ti-atom"></i>
                                <span class="hide-menu">Vaccine-Reservation</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="pns-schedule.php" aria-expanded="false">
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