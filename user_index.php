<?php
session_start();
header('Location: index.php');
exit;
?>
        <a href="explore_collection.php" class="btn btn-dark mt-3">Explore Collection</a>
      </div>
    </div>


  </div>
</section>


<section class="container my-5">
  <h4 class="mb-4 fw-bold">Bestsellers</h4>
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">

    <!-- Watch Card -->
    <div class="col">
      <div class="card card-hover border-0 shadow-sm h-100">
        <img src="https://thumbs.dreamstime.com/b/wrist-watch-4858579.jpg" class="card-img-top img-fluid" alt="Watch">
        <div class="card-body px-2 py-3">
          <h6 class="card-title mb-1 fw-semibold">TITAN</h6>
          <p class="card-text text-muted small mb-2">Men's Watch Titan</p>
          <p class="fw-bold">₹ 11,999</p>
        </div>
      </div>
    </div>

    <!-- Copy and change content for more cards -->
    <div class="col">
      <div class="card card-hover border-0 shadow-sm h-100">
        <img src="https://www.titan.co.in/on/demandware.static/-/Sites-titan-master-catalog/default/dwa065c2bc/images/Titan/Catalog/90145QL01_1.jpg" class="card-img-top img-fluid" alt="Watch">
        <div class="card-body px-2 py-3">
          <h6 class="card-title mb-1 fw-semibold">Tommy Hilfiger</h6>
          <p class="card-text text-muted small mb-2">Women's Watch Multifunction Silver...</p>
          <p class="fw-bold">₹ 13,200</p>
        </div>
      </div>
    </div>
    <!-- Copy and change content for more cards -->
    <div class="col">
      <div class="card card-hover border-0 shadow-sm h-100">
        <img src="https://www.fastrack.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dwef1a0f86/images/Titan/Catalog/1688KM06_1.jpg?sw=360&sh=360" class="card-img-top img-fluid" alt="Watch">
        <div class="card-body px-2 py-3">
          <h6 class="card-title mb-1 fw-semibold">Tommy Hilfiger</h6>
          <p class="card-text text-muted small mb-2">Women's Watch Multifunction Silver...</p>
          <p class="fw-bold">₹ 13,200</p>
        </div>
      </div>
    </div>
    <!-- Copy and change content for more cards -->
    <div class="col">
      <div class="card card-hover border-0 shadow-sm h-100">
        <img src="https://www.titan.co.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dwef6ee7ae/images/Titan/Catalog/90014KC03_2.jpg?sw=600&sh=600" class="card-img-top img-fluid" alt="Watch">
        <div class="card-body px-2 py-3">
          <h6 class="card-title mb-1 fw-semibold">Tommy Hilfiger</h6>
          <p class="card-text text-muted small mb-2">Women's Watch Multifunction Silver...</p>
          <p class="fw-bold">₹ 13,200</p>
        </div>
      </div>
    </div>
    <!-- Copy and change content for more cards -->
    <div class="col">
      <div class="card card-hover border-0 shadow-sm h-100">
        <img src="https://www.titan.co.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dwce9df3ef/images/Helios/Catalog/TH1710513_1.jpg?sw=600&sh=600" class="card-img-top img-fluid" alt="Watch">
        <div class="card-body px-2 py-3">
          <h6 class="card-title mb-1 fw-semibold">Tommy Hilfiger</h6>
          <p class="card-text text-muted small mb-2">Women's Watch Multifunction Silver...</p>
          <p class="fw-bold">₹ 13,200</p>
        </div>
      </div>
    </div>


  </div>
</section>


<!-- <section class="bg-light-subtle py-5 text-center scroll-fade" id="login-section">
  <div class="container">
    <h3 class="fw-semibold mb-4">LOGIN FOR THE BEST EXPERIENCE</h3>

    <a href="#" class="btn btn-warning text-uppercase px-4 py-2 fw-medium mb-3"
      data-bs-toggle="modal" data-bs-target="#loginModal">
      Login Now
    </a>

    <div class="create_account">
      <a class="text-decoration-underline text-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Create An Account</a>
    </div>
  </div>
</section> -->




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
            <form action="register.php" method="post">
              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-person"></i>
                  </span>
                  <input type="text" name="name" class="form-control border-start-0" placeholder="Full Name" required>
                </div>
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-envelope"></i>
                  </span>
                  <input type="email" id="email" name="email" class="form-control border-start-0" placeholder="Email Address" required>
                </div>
                <div id="emailError" class="text-danger mt-1" style="display: none;">Please enter a valid email address.</div>
              </div>


              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-lock"></i>
                  </span>
                  <input type="password" name="password" id="passwordField" class="form-control border-start-0 border-end-0" placeholder="Password" required>
                  <span class="input-group-text bg-white border-start-0" id="togglePassword" style="cursor:pointer;">
                    <i class="bi bi-eye-fill"></i>
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-lock"></i>
                  </span>
                  <input type="text" name="confirm_pass" class="form-control border-start-0" placeholder="Confirm Password" required>
                </div>
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



<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-dark" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <form action="login.php" method="post">
          <!-- Email -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-envelope"></i>
              </span>
              <input type="email" id="loginemail" name="loginemail" class="form-control border-start-0" placeholder="Email Address" required>
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" id="loginPassword" name="loginPassword" class="form-control border-start-0 border-end-0" placeholder="Password" required>
              <span class="input-group-text bg-white border-start-0" onclick="toggleLoginPassword()" style="cursor:pointer;">
                <i class="bi bi-eye-fill"></i>
              </span>
            </div>
          </div>

          <!-- Login Button -->
          <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>

        <!-- Forgot / Register -->
        <div class="mt-3 text-center">

          <p class="small mt-2">Don't have an account?
            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="text-primary fw-semibold">Register</a>
          </p>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Admin Login Modal -->
<div class="modal" id="adminloginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-dark" id="loginModalLabel">login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <form action="admin/admin_login.php" method="post">
          <!-- Email -->
          <div class="mb-3">
            <h5 class="text-center mb-3">Welcome, Admin</h5>

            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-envelope"></i>
              </span>
              <input type="email" name="admin_email" class="form-control border-start-0" placeholder="Email Address" required>
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" id="adminloginPassword" name="admin_password" class="form-control border-start-0 border-end-0" placeholder="Password" required>
              <span class="input-group-text bg-white border-start-0" onclick="toggleLoginPassword()" style="cursor:pointer;">
                <i class="bi bi-eye-fill"></i>
              </span>
            </div>
          </div>

          <!-- Login Button -->
          <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>

        <!-- Forgot / Register -->

      </div>

    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>