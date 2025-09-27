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

