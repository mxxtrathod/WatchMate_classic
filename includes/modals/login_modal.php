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
