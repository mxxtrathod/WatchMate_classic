<?php
require 'includes/db_connection.php';

// Fetch form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_pass = $_POST['confirm_pass'];


// Check if email already exists
$check_sql = "SELECT * FROM tbl_user WHERE email = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'error',
        title: 'Email Already Exists',
        text: 'The email you entered is already in use.',
        confirmButtonText: 'Try Again'
      }).then(() => {
        window.history.back();
      });
      });
    </script>
    ";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();



// Insert into database
$sql = "INSERT INTO tbl_user (name, email, password, confirm_pass)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $password, $confirm_pass);

if ($stmt->execute()) {
  echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: 'success',
      title: 'Registration Successfully',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php';
      }
    });
  });
</script>
";
} else {
  echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Registration Failed',
        text: '" . $stmt->error . "',
        confirmButtonText: 'Try Again'
      }).then(() => {
        window.history.back();
      });
    </script>
    ";
}

$stmt->close();
$conn->close();
