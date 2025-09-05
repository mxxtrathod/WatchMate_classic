<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update</title>
  <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

</head>

<body>
  <!-- Sidebar -->
  <?php require('../includes/sidebar.php'); ?>


  <div class="main-content">
    <div class="container-fluid py-1">
      <div class="p-2 bg-white shadow-sm rounded-3 mb-3">
        <div class="d-flex align-items-center">
          <i class="bi bi-pencil-square fs-2 text-primary me-3"></i>
          <div>
            <h5 class="mt-2 fw-bold">
              Update Watch
            </h5>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <?php
      require('watch_list.php');
      ?>

    </div>
  </div>

  <!-- Edit Watch Modal -->
  <div class="modal fade" id="editWatchModal" tabindex="-1" aria-labelledby="editWatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
          <h5 class="modal-title fw-bold" id="editWatchModalLabel">
            <i class="bi bi-pencil-square me-2"></i> Edit Watch
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Form -->
        <form id="editWatchForm" method="POST" enctype="multipart/form-data" action="update_watch.php">
          <div class="modal-body">
            <input type="hidden" name="id" id="watch_id">

            <!-- Image -->
            <div class="mb-3">
              <label for="watch_image" class="form-label fw-semibold d-block">
                <i class="bi bi-image me-1 text-primary"></i>Current Image
              </label>
              <img id="current_image" src="" class="img-fluid">
              <input type="file" class="form-control mt-3" name="image" id="watch_image">
            </div>

            <!-- Title -->
            <div class="mb-3">
              <label for="watch_title" class="form-label fw-semibold">
                <i class="bi bi-type me-1 text-primary"></i> Title
              </label>
              <input type="text" class="form-control rounded-3 shadow-sm" name="title" id="watch_title" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
              <label for="watch_description" class="form-label fw-semibold">
                <i class="bi bi-card-text me-1 text-primary"></i> Description
              </label>
              <textarea class="form-control rounded-3 shadow-sm" name="description" id="watch_description" rows="3" required></textarea>
            </div>

            <!-- Price -->
            <div class="mb-3">
              <label for="watch_price" class="form-label fw-semibold">
                <i class="bi bi-currency-dollar me-1 text-success"></i> Price ($)
              </label>
              <input type="number" class="form-control rounded-3 shadow-sm" name="price" id="watch_price" required>
            </div>
          </div>

          <!-- Footer -->
          <div class="modal-footer border-0 justify-content-between">
            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
              <i class="bi bi-x-circle me-1"></i> Cancel
            </button>
            <button type="submit" class="btn btn-success px-4">
              <i class="bi bi-check2-circle me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>