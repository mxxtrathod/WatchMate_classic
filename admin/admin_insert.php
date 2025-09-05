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
    <title>Insert</title>
    <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

</head>

<body>

    <div class="d-flex">

        <?php
        require('../includes/sidebar.php');

        ?>

        <div class="main-content">

        </div>
        <!-- Hidden Insert Form -->
        <div id="insertFormContainer" class="container my-4" style="max-width: 700px;">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white text-center py-3 rounded-top-3"
                    style="background: linear-gradient(90deg, #007bff, #0056b3);">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Add New Watch</h4>
                </div>
                <div class="card-body p-4">
                    <form id="insertWatchForm" method="POST" enctype="multipart/form-data">

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

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>

</body>

</html>