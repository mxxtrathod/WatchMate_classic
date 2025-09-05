<?php
session_start();
$_SESSION['admin_name'] = "Admin";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">

    <div>
      <div class="mb-4">
        <h5 class="fw-bold">Welcome,</h5>
        <p class="mb-1"><?php echo htmlspecialchars($_SESSION['admin_name']); ?></p>
        <hr class="text-white">
      </div>

      <div>
        <div class="nav-link" onclick="showDashboard()">
          <span><i class="bi bi-house-door-fill me-2"></i> Dashboard</span>

        </div>
      </div>

      <div>
        <div class="nav-link" onclick="toggleMenu('watchMenu')">
          <span><i class="bi bi-watch me-2"></i> Watch</span>
          <i class="bi bi-caret-down-fill"></i>
        </div>
        <div id="watchMenu" class="submenu">
          <a href="admin_insert.php" ><i class="bi bi-plus-circle me-2"></i> Insert</a>
          <a href="admin_update.php" ><i class="bi bi-pencil-square me-2"></i> Update</a>
          <a href="#" ><i class="bi bi-trash me-2"></i> Delete</a>
        </div>

        <div class="nav-link mt-2" onclick="toggleMenu('orderMenu')">
          <span><i class="bi bi-box-seam-fill me-2"></i> Orders</span>
          <i class="bi bi-caret-down-fill"></i>
        </div>
        <div id="orderMenu" class="submenu">
          <a href="#"><i class="bi bi-clock me-2"></i> Pending</a>
          <a href="#"><i class="bi bi-truck me-2"></i> Delivered</a>
        </div>
      </div>
    </div>

    <!-- Logout -->
    <a href="../index.php" class="btn btn-danger w-100 mt-4">
      <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
  </div>
  <!-- Main Content -->
  <div class="main-content flex-grow-1">
    <div id="dashboardSection">
      <div class="container-fluid py-4">
        <div class="p-4 bg-white shadow-sm rounded mb-4">
          <div class="d-flex align-items-center">
            <i class="bi bi-shop fs-2 text-primary me-3"></i>
            <div>
              <h5 class="mb-1 fw-bold">
                Welcome back, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
              </h5>
              <p class="mb-0 text-muted">Manage and grow your business with YourApp</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Hidden Insert Form -->
    <div id="insertFormContainer" class="container my-4" style="display: none; max-width: 700px;">
      <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-gradient-primary text-white text-center py-3 rounded-top-3"
          style="background: linear-gradient(90deg, #007bff, #0056b3);">
          <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Add New Watch</h4>
        </div>
        <div class="card-body p-4">
          <form action="insert_watch.php" method="POST" enctype="multipart/form-data">

            <!-- Image Upload -->
            <div class="mb-3">
              <label class="form-label fw-semibold"><i class="bi bi-image me-2"></i> Watch Image</label>
              <input type="file" name="image" class="form-control form-control-md" required>
              <small class="text-muted">Upload a clear image of the watch (JPG, PNG ,Webp).</small>
            </div>

            <!-- Title -->
            <div class="mb-3">
              <label class="form-label fw-semibold"><i class="bi bi-tag me-2"></i> Watch Title</label>
              <input type="text" name="title" class="form-control form-control-md" placeholder="Enter watch name" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
              <label class="form-label fw-semibold"><i class="bi bi-card-text me-2"></i> Description</label>
              <textarea name="description" class="form-control form-control-md" rows="3" placeholder="Enter watch details" required></textarea>
              <small class="text-muted">Description should be more than 15 words.</small>
            </div>

            <!-- Price -->
            <div class="mb-4">
              <label class="form-label fw-semibold"><i class="bi bi-currency-dollar me-2"></i> Price</label>
              <input type="text" name="price" class="form-control form-control-md" placeholder="Enter price in $" required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-md shadow-sm">
                <i class="bi bi-check-circle me-2"></i> Add Watch
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- Table container (hidden by default) -->
    <div id="watchTableContainer" style="display:none; margin-top:20px;">
    </div>

    <!-- Edit Watch Modal -->
    <div class="modal fade" id="editWatchModal" tabindex="-1" aria-labelledby="editWatchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="editWatchModalLabel">Edit Watch</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="editWatchForm" method="POST" enctype="multipart/form-data" action="update_watch.php">
            <div class="modal-body">
              <input type="hidden" name="id" id="watch_id">
              
              <div class="mb-3">
                <label for="watch_image" class="form-label fw-bold">Image</label><br>
                <img id="current_image" src="" class="mt-2 img-fluid">
                <!-- <input type="file" class="form-control" name="image" id="watch_image"> -->
              </div>

              <div class="mb-3">
                <label for="watch_title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" name="title" id="watch_title" required>
              </div>

              <div class="mb-3">
                <label for="watch_description" class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="description" id="watch_description" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label for="watch_price" class="form-label fw-bold">Price ($)</label>
                <input type="number" class="form-control" name="price" id="watch_price" required>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save Changes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="dashboardFooter">
      <p class="lead ms-3">This is your dashboard content area.</p>
    </div>
  </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>