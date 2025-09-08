<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WatchMate</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/images/logo/web_logo_tab.png">

</head>

<body>
    <header class="bg-white shadow-sm sticky-top">
        <!-- Header -->
        <div class="container-fluid py-0 border-bottom mb-1">
            <div class="row align-items-center">

                <!-- Logo -->
                <div class="col-md-2 col-3 text-start">
                    <img src="assets/images/logo/Untitled2-removebg-preview.png" alt="WatchMate Logo" class="object-fit-contain" height="90" width="90">
                </div>

                <!-- Search -->
                <div class="col-md-6 col-6">
                    <div class="input-group search-input-group col-md-4">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0" placeholder="Search watches" style="box-shadow: none;">
                    </div>
                </div>


                <div class="col-md-4 col-3 text-end d-flex justify-content-center gap-5">
                    <!-- Account Dropdown -->

                    <a href="cart.php" class="text-decoration-none text-dark">
                        <div class="header-icon text-center">
                            <i class="bi bi-bag"></i><br>Cart
                        </div>
                    </a>

                    <div class="header-icon position-relative">
                        <i class="bi bi-person"></i><br>Account
                        <div class="account-popup text-start mt-2">
                            <h6 class="fw-bold">Welcome!</h6>
                            <p class="small mb-3">Enjoy A Personalized Timekeeping Experience With WatchMate.</p>
                            <hr>
                            <div class="mt-3">
                                <button class="btn btn-warning text-uppercase w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Login/Signup
                                </button>

                            </div>

                            <!-- <div class="mt-3">
                                <button class="btn btn-warning text-uppercase w-100" data-bs-toggle="modal" data-bs-target="#adminloginModal">
                                    <i class="bi bi-person-fill me-2 text-center"></i>Admin
                                </button>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>