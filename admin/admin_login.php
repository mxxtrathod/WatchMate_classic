<?php
session_start();
require('../includes/db_connection.php');


// Get user input
$email = mysqli_real_escape_string($conn, $_POST['admin_email']);
$password = mysqli_real_escape_string($conn, $_POST['admin_password']);

$sql = "SELECT * FROM tbl_admin WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  if ($password === $row['password']) {
    $_SESSION['admin_email'] = $row['email']; // store admin session

    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    window.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: 'success',
      title: 'Login Successful',
      text: 'Welcome, Admin!',
      timer: 1500,
      showConfirmButton: false,   // hide OK button
      timerProgressBar: true
    });

    // Redirect after x seconds
    setTimeout(function() {
      window.location.href = '../admin/admin_dashboard.php';
      }, 1500);
    });
    </script>";
  } else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      window.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'warning',
          title: 'OOOPS...!',
          text: 'Invalid Password!'
        }).then(() => {
          history.back();
        });
      });
    </script>";
  }
} else {
  echo "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'warning',
        title: 'Admin Not Found',
        text: 'No such admin exists!'
      }).then(() => {
        window.location.href = '../index.php';
      });
    });
  </script>";
}
