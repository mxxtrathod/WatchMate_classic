<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
require('includes/db_connection.php');
require('includes/header.php');

// Check if ID exists
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM watches WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $watch = $result->fetch_assoc();
    } else {
        echo "<div class='container mt-5'><h4>Watch not found!</h4></div>";
        require('includes/footer.php');
        exit;
    }
} else {
    echo "<div class='container mt-5'><h4>Invalid Watch ID!</h4></div>";
    require('includes/footer.php');
    exit;
}
?>

<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
            <img src="uploads/<?php echo htmlspecialchars($watch['image']); ?>" alt="<?php echo htmlspecialchars($watch['title']); ?>" class="img-fluid rounded mb-3 detail-watch" id="mainImage">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3"><?php echo htmlspecialchars($watch['title']); ?></h2>
            <p class="mb-4"><?php echo htmlspecialchars($watch['description']); ?></p>
            <!-- <p class="text-muted mb-4">ID: <?php echo $watch['id']; ?></p> -->
            <div class="mb-3">
                <span class="h6">MRP :</span>
                <span class="h4 me-2"> $<?php echo htmlspecialchars($watch['price']); ?></span>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
            </div>
            <div class="d-flex gap-3 mt-5">
    
                <a href="cart.php?action=add&id=<?php echo $watch['id']; ?>" class="btn btn-outline-dark px-5 py-2">
                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                </a>

                <button class="btn px-5 py-2" style="background-color:#e89c34; color:#000; font-weight:500;">
                    BUY NOW
                </button>

            </div>
            <div class="mt-5  py-2">
                <div class="row text-center">
                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-truck fa-2x mb-2"></i>
                        <p class="mb-0">Free shipping <br> Countrywide</p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-watch fa-2x mb-2"></i>
                        <p class="mb-0">Serviced <br>Across India</p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-box-seam fa-2x mb-2"></i>
                        <p class="mb-0">Easy <br> Return </p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-wallet2 fa-2x mb-2"></i>
                        <p class="mb-0">Pay on<br>Delivery</p>
                    </div>
                </div>
            </div>

        </div>

        <section class="bg-light-subtle py-5 text-center scroll-fade" id="login-section">
            <div class="container">
                <h3 class="fw-semibold mb-4">LOGIN FOR THE BEST EXPERIENCE</h3>

                <a href="#" class="btn btn-warning text-uppercase px-4 py-2 fw-medium mb-3" data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    Login Now
                </a>

                <div class="create_account">
                    <a class="text-decoration-underline text-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Create
                        An Account</a>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header with Close Button -->
            <div class="modal-header border-0">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <!-- Left Side Image -->
                    <div class="col-md-6 d-none d-md-block">
                        <img src="https://fossil.scene7.com/is/image/FossilPartners/FS6111_onmodel?$sfcc_onmodel_large$"
                            class="rounded object-fit-cover shadow-md h-100 w-100" alt="Watch">
                    </div>

                    <!-- Right Side Form -->
                    <div class="col-md-6 p-4">
                        <h3 class="fw-bold text-dark mb-3 text-center">Register Now</h3>

                        <!-- FORM START -->
                        <form action="register.php" method="post" id="registerForm">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-start-0"
                                        placeholder="Full Name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" id="email" name="email" class="form-control border-start-0"
                                        placeholder="Email Address" required>
                                </div>
                                <div id="emailError" class="text-danger mt-1" style="display: none;">Please enter a
                                    valid email address.</div>
                            </div>


                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="passwordField"
                                        class="form-control border-start-0 border-end-0" placeholder="Password"
                                        required>
                                    <span class="input-group-text bg-white border-start-0" id="togglePassword"
                                        style="cursor:pointer;">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="text" name="confirm_pass" id="confirm_pass"
                                        class="form-control border-start-0" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <!-- Warning message placeholder -->
                            <div id="passwordWarning" class="text-danger mt-1" style="display: none;">
                                Passwords do not match!
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Sign Up</button>
                        </form>
                        <!-- FORM END -->

                        <small class="text-muted d-block mt-3 text-center">
                            By continuing, I agree with WatchMate's
                            <a href="#">Terms Of Use</a> and <a href="#">Privacy Policy</a>.
                        </small>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Combined Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- Modal Header with Stylish Tabs -->
            <div class="modal-header border-0 flex-column align-items-start">
                <h5 class="fw-bold text-dark mb-3">Login</h5>

                <!-- Stylish Tabs -->
                <ul class="nav nav-pills custom-tabs mb-1" id="loginTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#userLogin"
                            type="button" role="tab">User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#adminLogin"
                            type="button" role="tab">Admin</button>
                    </li>
                </ul>
                <!-- Close Button -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>

            <!-- Modal Body with Tabs -->
            <div class="modal-body p-4">
                <div class="tab-content" id="loginTabContent">

                    <!-- User Login Form -->
                    <div class="tab-pane fade show active" id="userLogin" role="tabpanel">
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-envelope"></i></span>
                                    <input type="email" name="loginemail" class="form-control border-start-0"
                                        placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-lock"></i></span>
                                    <input type="password" name="loginPassword" id="loginPassword"
                                        class="form-control border-start-0 border-end-0" placeholder="Password"
                                        required>
                                    <span class="input-group-text bg-white border-start-0" style="cursor:pointer;"
                                        onclick="togglePassword('loginPassword',this)"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Login</button>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="small">Don't have an account? <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#registerModal" class="text-primary fw-semibold">Register</a></p>
                        </div>
                    </div>

                    <!-- Admin Login Form -->
                    <div class="tab-pane fade" id="adminLogin" role="tabpanel">
                        <h5 class="text-center mb-3">Welcome, Admin</h5>
                        <form action="admin/admin_login.php" method="post">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-envelope"></i></span>
                                    <input type="email" name="admin_email" class="form-control border-start-0"
                                        placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-lock"></i></span>
                                    <input type="password" id="adminPassword" name="admin_password"
                                        class="form-control border-start-0 border-end-0" placeholder="Password"
                                        required>
                                    <span class="input-group-text bg-white border-start-0"
                                        onclick="togglePassword('adminPassword',this)" style="cursor:pointer;"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Login</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php require('includes/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>