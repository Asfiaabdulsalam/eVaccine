<?php
require('inc.connection.php');

$login = $email = $password = $Role = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {

  $email = safe_input($_POST['email']);
  $password = safe_input($_POST['password']);
  $Role = safe_input($_POST['role']);

  $sql = "SELECT * FROM `users` WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Check if password is correct
   if (password_verify($password, $user['password'])) {

  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_name'] = $user['name'];
  $_SESSION['user_email'] = $user['email'];
  $_SESSION['user_role'] = $user['role'];

  // Redirect based on role
  if ($user['role'] === 'admin') {
   header('Location: index.php');
  } elseif ($user['role'] === 'parent') {
    header('Location: ../webindex.php');
  } elseif ($user['role'] === 'hospital' && $user['email'] === 'pnsshifa@gmail.com') {
    header('Location: pns-shifa.php');
  } elseif ($user['role'] === 'hospital' && $user['email'] === 'southcity@gmail.com') {
    header('Location: south-city.php');
  } elseif ($user['role'] === 'hospital' && $user['email'] === 'aghakhan@gmail.com') {
    header('Location: agha-khan.php');
    exit;
}
 else {
    $login = "Unknown role.";
    session_unset();
    session_destroy();
  }

  exit();

} else {
  $login = "Incorrect password.";
}
  } else {
    $login = "Email not registered.";
  }
}
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>vaccine-system</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/78a5fbc7-6bd6-4c64-a8fc-3b73e001733e.png-removebg-preview.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <style>
    .row .card-body img {
      margin-top: -60px;
      margin-bottom: -60px;
      height: 250px;
      width: 250px;
      padding: 5px 0px;
    }
  </style>

</head>

<body>
  <!-- Background Blur Layer -->
  <div class="bg-img-blur position-absolute top-0 start-0 w-100 h-100"></div>

  <!-- Foreground Content -->
  <div class="page-wrapper position-relative z-1" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card shadow-sm rounded-4 mb-0">
              <div class="card-body p-4">

                <!-- Logo -->
                <div class="text-center mb-3">
                  <img src="./assets/images/logos/7e06b2c1-8c53-45c0-bd0c-e7c613a0910d-removebg-preview.png"
                    alt="Logo"
                    class="img-fluid"
                    style="max-width: 200px; height: auto;">
                </div>

                <!-- Title -->
                <p class="text-center mb-4" style="color: darkcyan; font-size: 1.1rem;"><b>Vaccination Management System</b></p>

                <!-- Login Form -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                  <?php if (!empty($login)): ?>
                    <div class="alert alert-danger py-2 px-3 small" role="alert" style="font-size: 0.85rem;">
                      <?= $login ?>
                    </div>
                  <?php endif; ?>

                  <div class="mb-3">
                    <label for="email" class="form-label">Your email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                  </div>

                  <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                      <option value="">Select Role</option>
                      <option value="admin">Admin</option>
                      <option value="hospital">Hospital</option>
                      <option value="parent">Parent</option>
                    </select>
                  </div>

                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked="">
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./register.php">Register ?</a>
                  </div>

                  <button type="submit" name="loginBtn" class="btn btn-primary w-100 py-2 fs-5 rounded-2">Sign In</button>
                </form>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>


</html>