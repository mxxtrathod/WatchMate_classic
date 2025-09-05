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
    <title>Delete</title>
    <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

</head>

<body>
    <!-- Sidebar -->
    <?php require('../includes/sidebar.php'); ?>


    <div class="main-content">
        <div class="container-fluid py-1">
                <div class="p-2 bg-white shadow-sm rounded-3 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-trash fs-2 text-primary me-3"></i>
                        <div>
                            <h5 class="mt-2 fw-bold">
                                Delete Watch
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">

            <?php
            require('watch_list_delete.php');
            ?>

        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <!-- Header -->
                <div class="modal-header bg-gradient bg-danger text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="deleteModalLabel">
                        <!-- <i class="bi bi-exclamation-triangle-fill me-2"></i>  -->
                        Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="fs-5 mb-0">Are you sure you want to delete this watch?</p>
                    <small class="text-muted">This action cannot be undone.</small>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="button" id="confirmDelete" class="btn btn-danger px-4">
                        <i class="bi bi-trash3-fill me-1"></i> Delete
                    </button>
                </div>
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