
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

<style>
    #orders a:hover {
        /* box-shadow: none !important; */
        background-color: none  !important;
        color: black !important;
    }
</style>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">

        <div>
            <div class="mb-4">
                <h5 class="fw-bold">Welcome,</h5>
                <p class="mb-1">Admin</p>
                <hr class="text-white">
            </div>

            <div>
                <div class="nav-link admin_dashboard">
                  <a href="../admin/admin_dashboard.php"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a> 
                </div>
            </div>

            <div>
                <div class="nav-link" onclick="toggleMenu('watchMenu')">
                    <span><i class="bi bi-watch me-2"></i> Watch</span>
                    <i class="bi bi-caret-down-fill"></i>
                </div>
                <div id="watchMenu" class="submenu">
                    <a href="../admin/admin_insert.php"><i class="bi bi-plus-circle me-2"></i> Insert</a>
                    <a href="../admin/admin_update.php"><i class="bi bi-pencil-square me-2"></i> Update</a>
                    <a href="../admin/admin_delete.php"><i class="bi bi-trash me-2"></i> Delete</a>
                </div>
 
                <div class="nav-link mt-2" id="orders">
  <a href="../admin/orders.php" class="text-decoration-none text-white">
    <i class="bi bi-box-seam-fill me-2"></i> Orders
  </a>
  <!-- <i class="bi bi-caret-down-fill"></i> -->
</div>
                <!-- <div id="orderMenu" class="submenu">
                    <a href="#"><i class="bi bi-clock me-2"></i> Pending</a>
                    <a href="#"><i class="bi bi-truck me-2"></i> Delivered</a>
                </div> -->
            </div>
        </div>

        <!-- Logout -->
        <a href="../admin/admin_logout.php" class="btn btn-danger w-100 mt-4">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>

      <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>