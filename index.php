<?php require 'includes/header.php'; ?>

<!-- Black separator strip -->
<div class="row-fluid">
    <div class="text-center h6">
        WatchMate - Elagance that endurse
    </div>
</div>

<!-- Carousel -->
<!--carousel-fade FOR SLIDING EFFECT -->
<div id="watchSlider" class="carousel-fade slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="assets/images/image slider/1.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 1"
                height=490>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/2.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 2"
                height=490>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/3.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 3"
                height=490>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/4.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 3"
                height=490>
        </div>

        <!-- Slide 5 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/5.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 3"
                height=490>
        </div>

        <!-- Slide 6 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/6.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 3"
                height=490>
        </div>

    </div>

    <!-- Prev/Next Buttons -->
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#watchSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#watchSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
</div>

<section class="container-fluid my-5">
    <div class="row align-items-center">

        <!-- Classic Trends Image -->
        <div class="col-md-6 mb-3">
            <img src="assets/images/male model.jpg" class="img-fluid w-100 rounded shadow-md object-fit-cover model-img"
                alt="Classic Trends">
        </div>

        <!-- Classic Trends Description -->
        <div class="col-md-6 mb-3 scroll-slide-right">
            <div class="p-4">
                <h2 class="fw-bold">CLASSIC</h2>
                <h4 class="text-muted mb-3">TRENDS for you</h4>
                <p class="text-secondary">
                    Discover timeless elegance with our collection of classic men's watches.
                    Crafted with precision and designed to impress, each piece complements your sophisticated style.
                    Choose from a variety of leather and metal straps, premium dials, and luxury designs that never go
                    out of fashion.
                </p>
                <a href="explore_collection.php" class="btn btn-dark mt-3">Explore Collection</a>
            </div>
        </div>


    </div>
</section>

<?php


require('includes/db_connection.php');
$sql = "SELECT * FROM watches ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);
?>


<section class="container my-5">
    <h4 class="mb-4 fw-bold">Collection</h4>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>

                <!-- Watch Card -->
                <a href="watch_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                <div class="col">
                    <div class="card card-hover border-0 shadow-sm h-100">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top img-fluid object-fit-cover"
                            alt="Watch">
                        <div class="card-body px-2 py-3">
                            <h6 class="card-title mb-1 fw-semibold text-truncate" style="max-width: 240px;"><?php echo htmlspecialchars($row['title']); ?></h6>
                            <p class="card-text text-muted small mb-2 text-truncate" style="max-width: 240px;"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="fw-bold mt-3">$<?php echo htmlspecialchars($row['price']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
    <?php endif; ?>

 


            </div>
            <div class="d-flex justify-content-end mt-2">
                <a href="explore_collection.php" class="text-right">Explore Now <i class="bi bi-arrow-right"></i></a>
            </div>
</section>

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

<?php require 'includes/footer.php'; ?>