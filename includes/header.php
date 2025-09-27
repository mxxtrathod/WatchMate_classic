<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WatchMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/images/logo/web_logo_tab.png">

</head>

<body>
    <header class="bg-white shadow-sm sticky-top">
        <!-- Header -->
        <div class="container-fluid py-3 border-bottom mb-1">
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

                    <a href="index.php" class="text-decoration-none text-dark me-3">
                        <div class="header-icon text-center">
                            <i class="bi bi-house"></i><br>Home
                        </div>
                    </a>

                    <a href="explore_collection.php" class="text-decoration-none text-dark me-3">
                        <div class="header-icon text-center">
                            <i class="bi bi-box-seam"></i><br>Products
                        </div>
                    </a>

                    <a href="cart.php" class="text-decoration-none text-dark me-3">
                        <div class="header-icon text-center position-relative">
                            <i class="bi bi-bag"></i>
                            <?php 
                            $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
                            if ($cartCount > 0): 
                            ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                    <?php echo $cartCount > 99 ? '99+' : $cartCount; ?>
                                </span>
                            <?php endif; ?>
                            <br>Cart
                        </div>
                    </a>

                    <div class="header-icon position-relative">
                        <i class="bi <?php echo isset($_SESSION['user_name']) ? 'bi-person-fill' : 'bi-person'; ?>"></i><br><?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Account'; ?>
                        <div class="account-popup text-start mt-2">
                            <?php if (isset($_SESSION['user_name'])): ?>
                                <h6 class="fw-bold mb-1">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h6>
                                <p class="small mb-3">Glad to see you back.</p>
                                <a href="logout.php" class="btn btn-outline-dark w-100">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </a>
                            <?php else: ?>
                                <h6 class="fw-bold">Welcome!</h6>
                                <p class="small mb-3">Enjoy A Personalized Timekeeping Experience With WatchMate.</p>
                                <hr>
                                <div class="mt-3">
                                    <button class="btn btn-warning text-uppercase w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        Login/Signup
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>