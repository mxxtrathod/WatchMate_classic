<?php
session_start();
include 'includes/db_connection.php'; // <- Make sure this connects to your database

// Get user input safely
$email = mysqli_real_escape_string($conn, $_POST['loginemail']);
$password = mysqli_real_escape_string($conn, $_POST['loginPassword']);

// Check if email exists
$sql = "SELECT * FROM tbl_user WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  if (isset($row['password']) && $password === $row['password']) {
    $_SESSION['user_name'] = $row['name'];

    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      window.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'success',
          title: 'Login Successful',
          text: 'Welcome back, {$row['name']}!',
          timer: 1500,
          showConfirmButton: false,
          timerProgressBar: true
        });
        setTimeout(function() {
          window.location.href = 'user_index.php';
        }, 1500);
      });
    </script>";
  } else {
    // Incorrect password
    echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: 'error',
      title: 'Incorrect Password',
      text: 'Please try again.'
    }).then(() => {
      window.history.back();
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
          title: 'User Not Found',
          text: 'Please register first!',
          confirmButtonColor: '#d33',
          confirmButtonText: 'Go to Register'
        }).then(() => {
          window.location.href = 'index.php';
        });
      });
    </script>";
}
